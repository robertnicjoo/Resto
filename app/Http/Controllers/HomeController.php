<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('mainpage');
    }

    public function index()
    {
        return view('home');
    }

    public function mainpage()
    {
        return view('welcome');
    }
}
