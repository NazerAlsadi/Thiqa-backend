<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Comment;
use App\User;
use App\Picture;
use App\Governorate;
use App\Setting; 

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {        
        $posts = Post::orderBy('created_at','DESC')->where('post_title', 'LIKE', '%' . $request->input . '%')->with('categories','users','governorates')->paginate(10);
        if($request->withTrashed)
        {
            $posts = Post::orderBy('created_at','DESC')->where('post_title', 'LIKE', '%' . $request->input . '%')->withTrashed()->with('categories','users','governorates')->paginate(10);
        }
        return view('management.posts.index',compact('posts','request'));
    }

    public function post_by_category( $category_id)
    {        
        $governorates = Governorate::all();
        $sub_categories = Category::where('parent_cat_id','!=', 0)->get();
        $category_name = Category::where('id',$category_id)->first();
        $main_category = Category::where('id',$category_name->parent_cat_id)->first();
        $posts = Post::orderBy('created_at','DESC')->where('status' ,'!=' ,'unpublish')->where('category_id', $category_id)->with('categories','users','governorates','pictures')->paginate(10);
        $settings = Setting ::first();
        return view('web.posts.postsByCategry', compact('posts' ,'settings','sub_categories','governorates','category_name','main_category'));
    }

    public function post_by_governorate( $governorate_id)
    { 
        $governorates = Governorate::all();
        $governorate_name = Governorate::where('id',$governorate_id)->first();
        $sub_categories = Category::where('parent_cat_id','!=', 0)->get();
        $posts = Post::orderBy('created_at','DESC')->where('status' ,'!=' ,'unpublish')->where('governorate_id', $governorate_id)->with('categories','users','governorates','pictures')->paginate(10);
        $settings = Setting ::first();
        return view('web.posts.postsByGovernorate', compact('posts' ,'settings','sub_categories','governorates','governorate_name'));
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
        if($request->id)
        {      
            $post=Post::find($request->id);
            $post->id = $request->id;
        }
        else
        {          
            $post=new Post;
            $post->id = $post->id;
        }

        $post->category_id = $post->category_id;
        $post->country_id = $post->country_id;
        $post->governorate_id = $post->governorate_id;
        $post->user_id = $post->user_id;
        $post->post_title = $request->post_title;
        $post->post_content = $request->post_content;
        $post->status = $post->status;
        $post->save();

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Post::where('id',$id)->with('categories','governorates','users')->first();
        $comments=Comment::where('post_id', $id)->with('users')->get();
        $pictures=Picture::where('post_id', $id)->get();
        return view('management.posts.post_show' , compact('posts','comments','pictures' ));
    }

    public function details($id)
    {
        $post = Post::where('id',$id)->with('categories','governorates','users')->first();
        $comments=Comment::where('post_id', $id)->with('users')->get();
        $pictures=Picture::where('post_id', $id)->get();
        $settings = Setting ::first();
        $like_post =Post::inRandomOrder()->where('category_id', $post->category_id)->limit(4)->get();

        return view('web.posts.show',compact('settings','post','comments','pictures','like_post'));
    }

    public function posts_search(Request $request)
    {       
        $governorates = Governorate::all();
        $sub_categories = Category::where('parent_cat_id','!=', 0)->get();
        $posts = Post::where('status' ,'!=' ,'unpublish')->where('post_content', 'LIKE', '%' . $request->input . '%')
        ->orWhere('post_title', 'LIKE', '%' . $request->input . '%')
        ->with('categories','governorates','users')->paginate(15);
        $settings = Setting ::first();

        return view('web.posts.search',compact('settings','posts','governorates','sub_categories', 'request'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Post::where('id',$id)->with('categories','governorates','users')->get();
        return view('management.posts.edit' , compact('posts' ));
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
        $post=Post::where('id',$id)->first();
        if($post)
        {
            $post->delete();
            return back();
        }
        else
        {
            $post=Post::withTrashed()->find($id);
            $post->restore();
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
               $post=Post::where('id',$id)->first();
               if($post)
               {
                   $post->delete();
               }
           }
       }
       elseif ($request->method == "restore")
       {
           foreach($request->index as $id)
           {
               $post=Post::withTrashed()->find($id);
               if($post)
               {
                   $post->restore();
               }
           }
       }

       return back();  
    }

    
    public function changeStatus($id, $st){

        $post =  Post::find($id);
 
             $post->status = $st ;
             $post->update();
        
        return redirect('/post_review');
     }
}
