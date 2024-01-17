<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckRole;
use App\Mail\MailableClass;
use App\Mail\randPassword;
use App\Mail\YourMailableClass;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller
{

    public function home()
    {
        return view('admin.homepage');
    }

    public function index()
    {
        return view('admin.login');
    }

    public function check(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Tạo token mới
            $token = Str::random(10);

            // Lưu token vào session để sử dụng trong tương lai, nếu cần
            session(['access_token' => $token]);
            // Lưu token vào cơ sở dữ liệu
            DB::table('login_user')->insert([
                'user_id' => $user->id,
                'token' => $token,
            ]);

            // Kiểm tra và chuyển hướng dựa vào vai trò
            if ($user->role == 1 && is_null($user->deleted_at)) {
                return redirect()->route('dashboard');
            } else {
                return redirect('/');
            }
        } else {
            return back()->with('error', 'Invalid email or password');
        }
    }

    public function logout(Request $request)
    {
        // Lấy token từ session
        $token = $request->session()->get('access_token');

        // Xóa dòng dữ liệu từ bảng login_user với token trung nhau
        DB::table('login_user')->where('token', $token)->delete();

        // Đăng xuất người dùng
        Auth::guard('web')->logout();

        // Invalidate session
        $request->session()->invalidate();

        // Chuyển hướng về trang chính
        return redirect('/');
    }




    public function profile()
    {
        $id = auth::id();
        $data = DB::table('users')->where('id', $id)->first();
        return view('admin.profile', [
            'user' => $data
        ]);
    }



    public function forgetPassword()
    {
        return view('forget-password');
    }


    // theo link token
    public function guimk(Request $request)
    {
        $email = $request->validate([
            'email' => 'required|email',
        ]);

        $emailExists = DB::table('users')
            ->where('email', $request->email)
            ->whereNull('deleted_at')
            ->exists();

        if (!$emailExists) {
            return redirect()->route('forgetPassword')->with('error', 'Email không tồn tại trong hệ thống.');
        }

        $length = 64;
        $token = Str::random($length);

        try {
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);

            Mail::to($request->email)->send(new MailableClass($token));
        } catch (\Exception $e) {
            log::error($e->getMessage());
            return redirect()->route('forgetPassword')->with('error', 'Có lỗi xảy ra khi gửi email đặt lại mật khẩu.');
        }

        return redirect()->route('forgetPassword')->with('success', 'Email đặt lại mật khẩu đã được gửi thành công.');
    }

    public function resetPassword(Request $request, $token)
    {
        $passwordReset = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->first();

        if (!$passwordReset) {
            return redirect()->route('forgetPassword')->with('error', 'Token đặt lại mật khẩu không tồn tại.');
        }

        // Kiểm tra xem token có hết hạn hay không
        $createdAt = Carbon::parse($passwordReset->created_at);
        $expirationTime = $createdAt->addMinutes(2); // Thời gian hết hạn là 2 phút

        if (now() > $expirationTime) {
            // Nếu token đã hết hạn, xóa token và hiển thị thông báo
            DB::table('password_reset_tokens')->where('token', $token)->delete();
            return redirect()->route('forgetPassword')->with('error', 'Token đặt lại mật khẩu đã hết hạn.');
        }

        // Nếu token hợp lệ, cho phép người dùng đặt lại mật khẩu
        return view('newPassword', ['token' => $token]);
    }

    public function reset_Password(Request $request)
    {
        $request->validate([
            'password' => [
                'required',
                'min:10',             // Tối thiểu 10 ký tự
                'regex:/[a-z]/',      // Ít nhất một chữ thường
                'regex:/[A-Z]/',      // Ít nhất một chữ hoa
                'regex:/[0-9]/',      // Ít nhất một số
                'regex:/[@$!%*#?&]/', // Ít nhất một ký tự đặc biệt
            ],
            'email' => 'required|email|exists:users',
            'password_confirmation' => 'required|same:password'
        ]);

        // Kiểm tra xem token có tồn tại trong cơ sở dữ liệu hay không
        $passwordResetToken = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])->first();

        if (!$passwordResetToken) {
            return redirect()->route('resetPassword');
        }

        // Cập nhật mật khẩu của người dùng và trường reset_password_status thành 1
        User::where('email', $request->email)->update(['password' => Hash::make($request->password), 'reset_password_status' => 1]);
        // Xóa token reset mật khẩu khỏi cơ sở dữ liệu
        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();
        // Lấy ID của người dùng đã cập nhật mật khẩu
        $userId = User::where('email', $request->email)->value('id');

        // Xóa tất cả các dòng trong bảng login_user có user_id tương ứng
        DB::table('login_user')->where('user_id', $userId)->delete();
        return redirect()->route('login');
    }
    // end link token

    // theo rand
    public function mk_rand(Request $request)
    {
        // dd($request->all()); 
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = DB::table('users')
            ->where('email', $request->email)
            ->whereNull('deleted_at')
            ->first();

        if (!$user) {
            return redirect()->route('forgetPassword')->with('error', 'Email không tồn tại trong hệ thống.');
        }
        $rendom_password = Str::random(10);

        try {

            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'password' => Hash::make($rendom_password),
                ]);
            // Xóa tất cả các dòng trong bảng login_user có user_id tương ứng
            DB::table('login_user')
                ->where('user_id', $user->id)
                ->delete();

            DB::commit(); // Hoàn tất giao dịch nếu không có lỗi
            Mail::to($request->email)->send(new randPassword($rendom_password));
        } catch (\Exception $e) {
            log::error($e->getMessage());
            return redirect()->route('forgetPassword')->with('error', 'Có lỗi xảy ra khi gửi email đặt lại mật khẩu.');
        }

        return redirect()->route('forgetPassword')->with('success', 'Email đặt lại mật khẩu đã được gửi thành công.');
    }

    //end rand

    // change password
    public function showChangePasswordForm()
    {
        $id = auth::id();
        $data = DB::table('users')->where('id', $id)->first();
        return view('changePassword', [
            'user' => $data
        ]);
    }


    public function changePassword(Request $request)
    {
        // Validate the input
        $request->validate([
            'password' => [
                'required',
                'min:10',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'password_confirmation' => 'required|same:password'
        ]);

        // Kiểm tra xác thực đăng nhập
        if (Auth::check()) {
            $user = Auth::user();

            // Kiểm tra mật khẩu hiện tại của người dùng
            if (Hash::check($request->input('current_password'), $user->password)) {
                // Thực hiện truy vấn để cập nhật mật khẩu
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['password' => Hash::make($request->input('password')), 'reset_password_status' => 1]);
                //
                $request->session()->flush();
                // Đăng xuất người dùng sau khi thay đổi mật khẩu
                Auth::logout();

                // Quay lại trang đăng nhập
                return redirect('login')->with('success', 'Mật khẩu đã được thay đổi. Vui lòng đăng nhập lại.');
            } else {
                return back()->with('error', 'Mật khẩu hiện tại không đúng.');
            }
        }

        return redirect('login');
    }


    // end



    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
