<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): view
    {
        return view('admin.users.index');
    }
}
