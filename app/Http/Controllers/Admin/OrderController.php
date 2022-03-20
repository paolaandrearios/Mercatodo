<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;


class OrderController extends Controller
{
    public function show(): view
    {
        return view('admin.orders.index');
    }
}
