<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Kiểm tra nếu Nhân Viên đã đăng nhập
        if (Auth::check()) {
            // Kiểm tra xem Nhân Viên có quyền truy cập không
            $user = User::find(Auth::id());
            if (in_array($user->role->name, $roles)) {
                return $next($request);
            }
        }

        // Nếu không có quyền, chuyển hướng hoặc xử lý theo ý của bạn
        abort(403, 'Unauthorized');
    }
}
