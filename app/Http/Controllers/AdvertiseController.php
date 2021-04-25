<?php

namespace App\Http\Controllers;


use App\Advertise;
use App\Setting;
use Illuminate\Http\Request;

class AdvertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       
        $advertises = Advertise::all();
        return view('management.advertises.index' , compact('advertises' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $settings = Setting::find(1);
        $advertise_time = ($settings->advertise_time);
        return view('management.advertises.create', compact('advertise_time'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        if($request->id)
        {
            $advertises=Advertise::find($request->id);
            if($advertises->picture_id)
            {
                unlink('upload/advertise_imgs/' . $advertises->picture_id );
            }
        }
        else
        {
            $advertises= new Advertise;
        }

        if($request->picture_url){
            $img_name ='cat_' . time() . '.' . $request->picture_url->getClientOriginalExtension() ;

            
            $advertises->picture_id =  $img_name;          
            $request->picture_url->move(public_path('/upload/advertise_imgs'), $img_name);
        }
        

        $advertises->category_id='0';
        $advertises->title=$request->title;
        $advertises->link=$request->link;
        $advertises->start_at=$request->start_at;
        $advertises->end_at=$request->end_at;
        $advertises->position=$request->position;
        $advertises->type=$request->type;
        $advertises->status="Active";
        $advertises->save();

        return redirect('/advertises');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Advertise  $advertise
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $advertises = Advertise::where('id',$id)->first();
        return view('management.advertises.show' , compact('advertises'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advertise  $advertise
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $advertises = Advertise::where('id',$id)->first();
        return view('management.advertises.edit' , compact('advertises'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Advertise  $advertise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, advertise $advertise)
    {
        $advertises=Role::find($request->id);
        $advertises->picture_id=$request->picture_id;
        $advertises->title=$request->title;
        $advertises->link=$request->link;
        $advertises->start_at=$request->start_at;
        $advertises->end_at=$request->end_at;
        $advertises->position=$request->position;
        $advertises->type=$request->type;
        $advertises->status=$request->status;
        $role->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advertise  $advertise
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $advertises=Advertise::find($id);
        unlink('upload/advertise_imgs/' . $advertises->picture_id );
        $advertises->delete();
        return back();
    }
}
