<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
