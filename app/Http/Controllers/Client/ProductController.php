<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

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
        return view('client.index');
    }
}
