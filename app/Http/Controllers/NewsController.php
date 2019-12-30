<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('news');
    }
}