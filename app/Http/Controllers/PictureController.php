<?php

namespace App\Http\Controllers;

use App\Picture;
use App\Post;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $picture=Picture::where('id', $id)->with('post')->first();
        $post = Post::where('id',$picture->post->id)->with('categories','governorates','users')->first();
        return view('management.pictures.show' , compact('picture','post' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function edit(picture $picture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, picture $picture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $picture=Picture::where('id',$id)->first();
        if($picture)
        {
            $picture->delete();
            return back();
        }
        else
        {
            $picture=Picture::withTrashed()->find($id);
            $picture->restore();
            return back();   
        }
        return back();  
    }

    public function handle(Request $request)
    {        
       if ($request->method == "remove")
       {
           foreach($request->index as $id)
           {
               $picture=Picture::where('id',$id)->first();
               if($picture)
               {
                   $picture->delete();
               }
           }
       }
       elseif ($request->method == "restore")
       {
           foreach($request->index as $id)
           {
               $picture=Picture::withTrashed()->find($id);
               if($picture)
               {
                   $picture->restore();
               }
           }
       }
       return back();  
    }

    public function changeStatus($id, $st){

        $picture =  Picture::find($id);
 
             $picture->status = $st ;
             $picture->update();
        
        return redirect('/images_review');
     }
}
