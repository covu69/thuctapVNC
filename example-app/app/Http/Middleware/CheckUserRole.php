<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        $postId = $request->route('id'); // Đảm bảo bạn đã đặt tên cho tham số trong route

        if ($user->role == 1) {
            // Người dùng có vai trò admin
            // Kiểm tra quyền truy cập dựa trên bài viết và vai trò
            $post = DB::table('posts')->find($postId);
            if ($post && ($post->user_id == $user->id)) {
                return $next($request); // Cho phép truy cập
            }
        }

        return abort('404'); // Hoặc chuyển hướng về trang chính nếu không có quyền.
    }
}
