<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Request;

class AdminHomeController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['title'] = "Admin Page - Admin - Online Store";
        return view('admin.home.index')->with('viewData', $viewData);
    }
}