<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting; 
use App\Governorate;
use App\Category;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();
        return view('management.setting.index' , compact('settings'));
    }

    public function agreement()
    {
        $governorates = Governorate::all();
        $sub_categories = Category::where('parent_cat_id','!=', 0)->get();
        $settings = Setting::first();
        return view('web.agreement' , compact('settings','governorates','sub_categories'));
    }

    public function aboutUs()
    {
        $governorates = Governorate::all();
        $sub_categories = Category::where('parent_cat_id','!=', 0)->get();
        $settings = Setting::first();
        return view('web.aboutUs' , compact('settings','governorates','sub_categories'));
    }

    public function contactUs()
    {
        $governorates = Governorate::all();
        $sub_categories = Category::where('parent_cat_id','!=', 0)->get();
        $settings = Setting::first();
        return view('web.contactUs' , compact('settings','governorates','sub_categories'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $settings=Setting::find($request->id);
        $settings->id = $settings->id;
        $settings->name = $request->name;
        $settings->version = $request->version;
        $settings->post_time = $request->post_time;
        $settings->advertise_time = $request->advertise_time;
        $settings->agreement = $request->agreement;
        $settings->about_us = $request->about_us;
        $settings->address = $request->address;
        $settings->phone = $request->phone;
        $settings->email = $request->email;
        $settings->facebook = $request->facebook;
        $settings->twitter = $request->twitter;
        $settings->save();
        $settings = Setting::all();
        return view('management.setting.index' , compact('settings'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $settings = Setting::all();
        return view('management.setting.edit' , compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
