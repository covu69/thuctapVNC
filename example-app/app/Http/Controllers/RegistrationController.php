<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('admin.create');
    }

    public function insert(Request $request)
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
        DB::table('users')->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phone' => $request->input('phone'),
            'role' => '0',
            'created_at' => now(),
        ]);

        return view('admin.login');
    }
}
