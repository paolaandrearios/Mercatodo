<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        $this->middleware(function($request, $next){
            if(!is_null(Auth::user())) {
                return app(\Illuminate\Auth\Middleware\EnsureEmailIsVerified::class)->handle($request, $next);
            }
            return $next($request);
        });
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): view
    {
        return view('client.index');
    }
}
