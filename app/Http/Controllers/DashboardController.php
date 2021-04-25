<?php

namespace App\Http\Controllers;


class DashboardController extends Controller
{

	public function index(){
    	// here we write the route
    	return view('dashboard.index');
    }

}
