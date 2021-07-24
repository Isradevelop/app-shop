<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class TestController extends Controller
{
    function welcome(){
        $categories = Category::has('products')->get();
        return view('welcome')->with(compact('categories'));
    }
}
