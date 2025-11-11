<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
