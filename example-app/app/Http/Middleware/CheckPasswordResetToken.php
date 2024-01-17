<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CheckPasswordResetToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(session('access_token'));
        if (Auth::user() != null) {
            $user = User::findOrFail(Auth::user()->id);

            $loginUser = DB::table('users')
                ->join('login_user', 'users.id', '=', 'login_user.user_id')
                ->where('users.id', $user->id)
                ->where('login_user.token', session('access_token'))
                ->first();

            if ($loginUser) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect()->route('login');
            }
        }

        return $next($request);
    }
}
