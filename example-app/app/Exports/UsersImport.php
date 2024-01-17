<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithHeadingRow
{
    use Importable;

    // public function rules(): array
    // {
    //     return [
    //         'name' => 'required|unique:users',
    //         'password' => [
    //             'required',
    //             'min:10',             // must be at least 10 characters in length
    //             'regex:/[a-z]/',      // must contain at least one lowercase letter
    //             'regex:/[A-Z]/',      // must contain at least one uppercase letter
    //             'regex:/[0-9]/',      // must contain at least one digit
    //             'regex:/[@$!%*#?&]/', // must contain a special character
    //         ],
    //         'email' => 'required|email|unique:users',
    //         'phone' => 'required|integer',
    //         'password_confirmation' => 'required|same:password'
    //     ];
    // }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => Hash::make($row['password']),
            'phone' => $row['phone'],
            'role' => $row['role'],
        ]);
    }
}
