<?php

namespace App\Http\Controllers;


class ManagementController extends Controller
{
    public function index(){
    	// here we write the route
    	return view('management.index');
    }
}
