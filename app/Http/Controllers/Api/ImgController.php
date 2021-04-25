<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Category;
use App\Post;
use App\Comment;
use App\User;
use App\Picture;
use App\Governorate;
use Image;

use Illuminate\Http\Request;

class ImgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $imgs = Picture::all();
        return response()->json($imgs);
    }

    public function posts_by_catid($id)
    {
        $posts = Post::where([
            ['status','active'],
            ['category_id', $id],
        ])->with('categories','governorates','users')->get();

        return response()->json($posts);
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
         if($request->attachment){
            $len = count(json_decode($request->attachment , true) );
            for($i=0 ; $i < $len ; $i++  ){

                $pic = new Picture();
                $pic->post_id = $request->post_id;
                $pic->status = $request->status;

                $img = base64_decode(json_decode($request->attachment , true)[$i]['encoded']);
                
                
                // here compress the img
                
                $temp = Image::make($img)->resize(512,null , function($constraint){
                    $constraint->aspectRatio();
                });
                //$canvas = Image::canvas(20,20);
                
                
                $name = 'post_'.$i . time() .'.jpeg';
                $pic->picture_title = $name;
                $pic->picture_name = $name;
                // file_put_contents(public_path('/upload/post_imgs').'/'.$name, $temp);
                
                $temp->save(public_path('/upload/post_imgs').'/'.$name);

                $pic->save();
            }
        }
        return response()->json('Added Successfully' ,200 );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Post::where('id',$id)->with('categories','governorates','users')->with(['comments.users','pictures'])->first();
        //$comments=Comment::where('post_id', $id)->with('users')->get();
        //$pictures=Picture::where('post_id', $id)->get();
        return response()->json($posts,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $pic = Picture::find($id);
        //return response()->json($pic);
        $pic->delete();
        return response()->json('deleted successfully');
    }
}
