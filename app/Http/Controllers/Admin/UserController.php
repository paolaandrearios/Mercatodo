<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    public function __construct()
    {
    }

    public function index(): view
    {
        return view('admin.users.index');
    }
}
