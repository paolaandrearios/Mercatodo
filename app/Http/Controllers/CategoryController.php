<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;


class CategoryController extends Controller
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
        return view('categories.index');
    }
}
