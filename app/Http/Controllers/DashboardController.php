<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function example()
    {   
        $user = Auth::user();
        return view('example',compact('user'));
    }
}
