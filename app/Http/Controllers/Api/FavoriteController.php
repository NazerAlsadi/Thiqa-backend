<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;

use App\Favorite;
use App\Post;
use Illuminate\Http\Request;
use Auth;
class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::guard('api')->user();
        
        if($user)
        {
         $favorite = $user->favorites()->select('posts.id','post_title' ,'governorate_id' , 'posts.user_id' , 'favorites.created_at')->with(
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
        return response()->json($favorite);   
        }
        return response()->json('No User');
    }
    
     public function favorites_by_user_id($user_id)
    {
        $favorites = Favorite::where('status','active')->where('user_id',$user_id)->with('post')->get();
        return response()->json($favorites);
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
        
        
        $user = Auth::guard('api')->user();
        
        if($user && $request->post_id){
            
            $fav= Favorite::where('user_id',$user->id)->where('post_id',$request->post_id)->first();
            if($fav)
            {
                $fav->delete();
                return response()->json('unfav',200);
            }
            else
            {
                Favorite::create(['user_id'=>$user->id,'post_id'=>$request->post_id]);
                return response()->json('fav',200);
            }
            
        }
        
        
        
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function show(favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function edit(favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(favorite $favorite)
    {
        //
    }
}
