<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Governorate;

class GovernorateController extends Controller
{
    public function index()
    {
        $governorate = Governorate::all();
        return response()->json($governorate);
    }

    public function show(category $category)
    {
   
    }

    public function store(Request $request)
    {
     


    }
}
