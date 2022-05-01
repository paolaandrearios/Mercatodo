<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function show(): view
    {
        return view('admin.products.export');
    }
}
