<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view('about');
    }
}