<?php

// app/Http/Middleware/LanguageMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

class LanguageMiddleware
{
    public function handle($request, Closure $next)
    {
        $defaultLocale = Config::get('app.locale');
        $validLocales = Config::get('app.valid_locales', ['vi']);

        $locale = Session::get('locale', $defaultLocale);

        // Kiểm tra xem $locale có trong danh sách ngôn ngữ hợp lệ không
        if (!in_array($locale, $validLocales)) {
            $locale = $defaultLocale; // Sử dụng giá trị mặc định nếu không hợp lệ
        }

        app()->setLocale($locale);

        return $next($request);
    }
}

