<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Category;
use App\Post;
use App\Comment;
use App\User;
use App\Picture;
use App\Governorate;
use Auth;
use App\Rate;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $posts = Post::orderBy('created_at','DESC')->where('status' ,'!=' ,'unpublish')->with('categories','users','governorates')->get();
        return response()->json($posts);
    }

    // public function posts_by_catid($id,Request $request)
    // {
    //     $posts = Post::where('status' ,'!=' ,'unpublish');
    //     if($id!=0)
    //     {
    //         $posts = $posts->where('category_id', $id);
    //     }
    //     if($request->gov!=0)
    //     {
    //         $posts = $posts->where('governorate_id', $request->gov);
    //     }
    //     $posts = $posts->with('categories','governorates','users' , 'pictures')->orderBy('created_at','DESC')->paginate(10);

    //     return response()->json($posts);
    // }
    
    
    ////////////////////////
    public function posts_by_catid($id,$gov)
    {
        $posts = Post::where('status' ,'!=' ,'unpublish');
        if($id!=0)
        {
            $posts = $posts->where('category_id', $id);
        }
        if($gov!=0)
        {
            $posts = $posts->where('governorate_id', $gov);
        }
        $posts = $posts->with('categories','governorates','users','pictures')->orderBy('created_at','DESC')->paginate(10);

        return response()->json($posts);
    }
    
    ///////////////////////
    
    
    
    public function posts_by_cat($id,$gov)
    {
        $posts = Post::where('status' ,'!=' ,'unpublish');
        if($id!=0)
        {
            $posts = $posts->where('category_id', $id);
        }
        if($gov!=0)
        {
            $posts = $posts->where('governorate_id', $gov);
        }
        $posts = $posts->with('categories','governorates','users','pictures')->orderBy('created_at','DESC')->get();

        return response()->json($posts);
    }
    
    
    

    public function change_post_st($id)
    {
        $post=Post::where('id',$id)->first();
        if($post->status == "unpublish")
        {
            $post->status = "temp";
            $post->save();
            return response()->json($post);
        }
        else
        {
            $post->status = "unpublish";
            $post->save();
            return response()->json($post); 
        }

        return response()->json($posts);
    }
    
    public function posts_search($input)
    {
        $posts = Post::where('post_content', 'LIKE', '%' . $input . '%')
        ->orWhere('post_title', 'LIKE', '%' . $input . '%')->where('status' ,'!=' ,'unpublish')->with('categories','governorates','users')->get();
        return response()->json($posts);
    }

     public function posts_by_user_id($user_id)
    {
        $posts = Post::where('user_id',$user_id)->get();
        return response()->json($posts);
    }
    
    
    
    
    public function user_posts()
    {
        $user = Auth::guard('api')->user();
        
        if($user)
        {
            $posts = $user->posts()->select('posts.id','post_title' ,'governorate_id' , 'posts.user_id' , 'posts.created_at')->with(
             [
                'governorates'=> function($q) {
                     return $q->select('id','governorate_name');
                    },
                'pictures'=> function($q) {
                     return $q->where('status' ,'Active')->first();
                    },
                'users'=> function($q) {
                     return $q->select('id' ,'name');
                    },
             ]
         )->get();
            
            return response()->json($posts);
        }
        return response()->json('No User');
        // $posts = Post::where('user_id',$user_id)->get();
        // return response()->json($posts);
    }
    
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rate(Request $request)
    {
        
        $user = Auth::guard('api')->user();
        
        if($user && $request->rate)
        {
            if($request->rate==1)
            {
                Rate::updateorcreate(['user_id'=>$user->id,'post_id'=>$request->post_id],['rate_up'=>1,'rate_down'=>0]);
            }
            else
            {
                Rate::updateorcreate(['user_id'=>$user->id,'post_id'=>$request->post_id],['rate_up'=>0,'rate_down'=>1]);
            }
            
        }
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
            $post->id = $post->id;
        }
        else
        {  
            $post=new Post;
        }
        $post->country_id = 1;
        $post->category_id = $request->category_id;
        $post->governorate_id = $request->governorate_id;

        // add userId
        $user = Auth::guard('api')->user();
        if($user){
            $post->user_id = $user->id;
        }
        $post->post_title = $request->post_title;
        $post->post_content = $request->post_content;
        $post->status = $request->status;
        $post->save();
        return response()->json($post->id,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $posts = Post::where('id',$id)->with('categories','governorates','users')->with(['comments'=>function($q){
            $q->orderBy('created_at','DESC');
        },'comments.users','pictures'])->first();
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
        
        $user = Auth::guard('api')->user();
         
        if($user){
            $post = Post::find($post->id);
            
            $post->user_id = $user->id;
            $post->country_id = 1;
            $post->category_id = $request->category_id;
            $post->governorate_id = $request->governorate_id;
            $post->post_title = $request->post_title;
            $post->post_content = $request->post_content;
            $post->status = $request->status;
            $post->save();
             return response()->json($post);
        }
        
        return  response()->json('No User ' , 501);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
