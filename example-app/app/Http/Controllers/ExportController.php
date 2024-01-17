<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Exports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ExportController extends Controller
{
    public function export_checkbox(Request $request)
    {

        $selectedIds =  $request->selectedIds;
        $data = User::whereIn('id', $selectedIds)->get();

        // Thực hiện xuất dữ liệu ra tệp Excel sử dụng Maatwebsite/Laravel-Excel
        return Excel::download(new UsersExport($data), 'exported_data.xlsx');
    }

    public function processForm(Request $request)
    {
        $inputData = $request->input('search'); // Thay 'fieldname' bằng tên trường trong form

        // Lưu dữ liệu vào session
        session(['inputData' => $inputData]);

        // Chuyển hướng người dùng đến form đích
        return redirect()->route('destinationForm');
    }
    public function exportDataToExcel(Request $request)
    {
        // dd($request->input('search'));
        $searchTerm = $request->input('search'); // Lấy điều kiện tìm kiếm từ request
        $data =  User::where('name', 'like', '%' . $searchTerm . '%')
            ->orwhere('email', 'like', '%' . $searchTerm . '%')->get();
        //     ->where(function ($query) use ($searchTerm){
        //       $query->where('name','like','%'. $searchTerm .'%')
        //       ->orwhere('email','like','%'.$searchTerm.'%');
        //   })->get(); // Thực hiện truy vấn tìm kiếm dữ liệu
        //   dd($data);
        return Excel::download(new UsersExport($data), 'exported_data.xlsx');
    }

    // public function import_ex(Request $request)
    // {
    //     Excel::import(new UsersImport, $request->file('excel_file'));
    //     return redirect()->route('user');
    // }
    public function importExcel(Request $request)
    {
        if ($request->hasFile('excel_file')) {
            $file = $request->file('excel_file');

            // Sử dụng thư viện Maatwebsite/Laravel-Excel để đọc tệp Excel
            $data = Excel::toArray(new UsersImport, $file);

            $errorRows = [];
            $successRows = [];

            foreach ($data[0] as $row) {
                // Kiểm tra lỗi cho từng dòng và lưu vào $errorRows nếu có lỗi
                if ($this->hasError($row)) {
                    $errorRows[] = $row;
                } else {
                    // Xử lý dòng đúng ở đây
                    $this->processRow($row);
                    $successRows[] = $row;
                }
            }

            // Lưu trữ thông báo lỗi và các dòng đúng trong Session
            if (!empty($errorRows)) {
                session()->flash('error', 'Có dòng không hợp lệ trong tệp Excel.');
                session()->flash('errorRows', $errorRows);
            }
            if (!empty($successRows)) {
                session()->flash('success', 'Các dòng đã được import thành công.');
            }

            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Vui lòng chọn tệp Excel để tải lên.');
        }
    }


    private function hasError($row)
    {
        // Định nghĩa các rules cho validation
        $rules = [
            'name' => 'required',
            'password' => [
                'required',
                'min:10',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'email' => 'required|email',
            'phone' => 'required|integer',
        ];

        // Định nghĩa các thông báo lỗi tùy chỉnh nếu cần
        $customMessages = [
            'name.required' => 'Name field is required.',
            'phone.required' => ' Number already exists',
            'password.required' => 'Password field is required.',
            'password.regex' => 'Mật khẩu tối thiểu 8 ký tự, có ít nhất 1 chữ thường, 1 chữ in hoa, 1 số và 1 ký tự đặc biệt',
            'email.required' => 'Email field is required.',
            'email.email' => 'Email field must be email address.'
        ];

        // Kiểm tra dữ liệu dựa trên rules và customMessages
        $validator = Validator::make($row, $rules, $customMessages);

        // Kiểm tra xem có lỗi không
        if ($validator->fails()) {
            // Nếu có lỗi, trả về true để chỉ định rằng dòng này có lỗi
            return true;
        }

        // Nếu không có lỗi, trả về false để chỉ định rằng dòng này không có lỗi
        return false;
    }

    private function processRow($row)
    {
        // Tìm dòng hiện tại trong cơ sở dữ liệu bằng một trường duy nhất ( email)
        $existingRecord = User::where('email', $row['email'])->first();

        if ($existingRecord) {
            // Nếu đã tìm thấy dòng hiện tại, so sánh các trường với dữ liệu từ tệp Excel
            // và cập nhật các trường khác nhau
            if (isset($row['password']) && !empty($row['password']) && $existingRecord->password != $row['password']) {
                $existingRecord->password = $row['password'];
            }
            if ($existingRecord->phone != $row['phone']) {
                $existingRecord->phone = $row['phone'];
            }

            if ($existingRecord->role != $row['role']) {
                $existingRecord->role = $row['role'];
            }
            if ($existingRecord->name != $row['name']) {
                $existingRecord->name = $row['name'];
            }

            // Lưu thay đổi
            $existingRecord->save();
        } else {
            // Nếu không tìm thấy dòng hiện tại, tạo một bản ghi mới
            User::create([
                'name' => $row['name'],
                'phone' => $row['phone'],
                'email' => $row['email'], // Ví dụ: trường duy nhất để tìm dòng hiện tại
                'password' => $row['password'],
                'role' => $row['role']

            ]);
        }
    }
}
