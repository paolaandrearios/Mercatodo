<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class ExportController extends Controller
{
    public function show(): view
    {
        return view('admin.products.export');
    }
}
