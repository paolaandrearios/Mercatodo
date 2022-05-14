<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class EnsureUserActive
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if(!is_null($request->user())) {
            if (!$request->user() ||
                !$request->user()->isActive()) {
                Auth::logout();

                return Redirect::guest(URL::route('login'))
                    ->withErrors(['msg' => __('validation.user.inactive')]);
            }
        }

        return $next($request);
    }
}
