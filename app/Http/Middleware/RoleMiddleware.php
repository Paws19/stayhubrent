<?php

namespace App\Http\Middleware;

use App\Models\Account;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next , string $role): Response
    {
         // Check if logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Get logged-in account
        $account = Auth::user();

        // Make sure the logged-in user is an Account
        if (!$account instanceof Account) {
            Auth::logout();

            return redirect()->route('login');
        }

        // Check role
        if ($account->role !== $role) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
