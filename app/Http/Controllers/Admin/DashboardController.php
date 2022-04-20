<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use function view;

class DashboardController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"],
        ];
        return view('contents.home', ['breadcrumbs' => $breadcrumbs]);
    }
}
