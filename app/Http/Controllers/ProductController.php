<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    /**
     * ProductController constructor.
     */

    public function __construct()
    {
    }

    /**
     * @return Application|Factory|View
     */

    public function index(): view
    {
        return view('products.index');
    }

}
