<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class DashboardController extends Controller
{
    public function view()
    {
        $blogs = (new Blog)->getAllBlogs();

        return view('dashboard', compact('blogs'));
    }
}
