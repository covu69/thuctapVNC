<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use PhpParser\Node\Expr\New_;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{
  public function index(Request $request)
  {
    $itemsPerPage = $request->input('itemsPerPage', 10);

    // Get the currently authenticated user
    $loggedInUserId = Auth::id();

    // Retrieve users with role = 0 and excluding the currently logged-in user
    $users = DB::table('users')
      ->select('*')
      ->where('deleted_at', null)
      ->where('role', 0)
      ->where('id', '!=', $loggedInUserId)
      ->paginate($itemsPerPage);

    return view('admin.user.userlist', compact('users', 'itemsPerPage'))->with('i', (request()->input('page', 1) - 1) * 5);
  }

  public function search(Request $request)
  {
    $loggedInUserId = Auth::id();
    $data = $request->input('search');
    $itemsPerPage = $request->input('itemsPerPage', 10);
    $users = DB::table('users')
      ->select('*')
      ->where('deleted_at', null)
      ->where(function ($query) use ($loggedInUserId) {
        $query->where('role', 0)
          ->orWhere('id', $loggedInUserId);
      })
      ->where(function ($query) use ($data) {
        $query->where('name', 'like', '%' . $data . '%')
          ->orwhere('email', 'like', '%' . $data . '%');
      })
      // ->toSql();
      // dd($users);
      ->paginate($itemsPerPage);
    if ($users) {
      return view('admin.user.userlist', compact('users', 'data', 'itemsPerPage'))->with('i', (request()->input('page', 1) - 1) * 5);
    } else {
      return abort('404');
    }
  }

  public function useradd()
  {
    return view('admin.user.adduser');
  }
  public function add(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|unique:users',
      'password' => [
        'required',
        'min:10',             // must be at least 10 characters in length
        'regex:/[a-z]/',      // must contain at least one lowercase letter
        'regex:/[A-Z]/',      // must contain at least one uppercase letter
        'regex:/[0-9]/',      // must contain at least one digit
        'regex:/[@$!%*#?&]/', // must contain a special character
      ],
      'email' => 'required|email|unique:users',
      'phone' => 'required|integer',
      'password_confirmation' => 'required|same:password'
    ], [
      'name.required' => 'Name field is required.',
      'phone.required' => ' Number already exists',
      'password.required' => 'Password field is required.',
      'password.regex' => 'Mật khẩu tối thiểu 8 ký tự, có ít nhất 1 chữ thường, 1 chữ in hoa, 1 số và 1 ký tự đặc biệt',
      'email.required' => 'Email field is required.',
      'email.email' => 'Email field must be email address.'
    ]);
    $input = $request->all();

    DB::table('users')->insert([
      'name' => $input['name'],
      'email' => $input['email'],
      'password' => Hash::make($input['password']),
      'phone' => $input['phone'],
      'role' => '0',
      'created_at' => now(),
    ]);

    return redirect()->route('user');
  }

  public function edit(Request $request, $id)
  {
    // $data = DB::table('users')->where('id', $id)->first();
    // return view('admin.user.edituser', [
    //   'user' => $data
    // ]);

    // Lấy người dùng hiện tại
    $currentUser = Auth::user();

    // Lấy thông tin người dùng cần chỉnh sửa
    $user = DB::table('users')->where('id', $id)->first();

    // Kiểm tra xem người dùng có quyền truy cập
    if ($user) {
      if ($user->id == $currentUser->id || $user->role == 0) {
        return view('admin.user.edituser', ['user' => $user]);
      } else {
        // Nếu không có quyền, bạn có thể chuyển hướng hoặc trả về lỗi 403
        return abort(403, 'Unauthorized');
      }
    } else {
      // Xử lý trường hợp không tìm thấy người dùng với ID cung cấp
      // Ví dụ: return lỗi 404
      return abort(404, 'User not found');
    }
  }

  public function update(Request $request, int $id)
  {
    $validatedData = $request->validate([
      'name' => 'required|unique:users,name,' . $id,
      'email' => 'required|email|unique:users,email,' . $id,
      'phone' => 'required|integer',
      'password' => [
        'nullable',
        'min:10',
        'regex:/[a-z]/',
        'regex:/[A-Z]/',
        'regex:/[0-9]/',
        'regex:/[@$!%*#?&]/',
      ],
    ]);

    // Lấy dữ liệu từ request
    $data = [
      'name' => $request->input('name'),
      'email' => $request->input('email'),
      'phone' => $request->input('phone'),
      'updated_at' => now(),
    ];

    // Kiểm tra xem mật khẩu mới có được cung cấp không
    if ($request->filled('password')) {
      // Băm mật khẩu mới và thêm vào dữ liệu
      $data['password'] = Hash::make($request->input('password'));
    }

    // Kiểm tra xem người dùng có tồn tại không trước khi cập nhật
    $existingUser = DB::table('users')->where('id', $id)->first();
    if ($existingUser) {
      // Cập nhật dữ liệu người dùng trong cơ sở dữ liệu
      DB::table('users')->where('id', $id)->update($data);

      // Chuyển hướng sau khi cập nhật
      return redirect()->route('user');
    }
  }

  public function destroy(string $id)
  {
    // Get the authenticated user's ID
    $authUserId = Auth::user()->id;

    // Find the user by their ID
    $user = DB::table('users')->where('id', $id)->first();

    // Check if the user was found
    if (!$user) {
      return redirect()->route('user')->with('error', 'Không thể tìm thấy người dùng để xóa.');
    }

    // Check if the authenticated user is authorized to delete the user
    if ($user->role == 1 && $user->id !== $authUserId) {
      abort(404);
    }


    DB::table('users')
      ->where('id', $id)
      ->update(['deleted_at' => now()]);

    return redirect()->route('user')->with('success', 'Người dùng đã được xóa thành công.');
  }

  public function deleteSelectd(Request $request)
  {
    $ids =  $request->ids;

    DB::table('users')->wherein('id', $ids)->update([
      'deleted_at' => now(),
    ]);
    return redirect()->route('user');
  }
}
