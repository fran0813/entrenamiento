<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Logic that determines where to send the user
        if($request->user()->hasRole('Admin')){
            return redirect('/admin/');
        }
        if($request->user()->hasRole('User')){
            return redirect('/user/');
        }
    }
}
