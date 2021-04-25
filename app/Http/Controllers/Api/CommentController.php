<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;

use App\Comment;
use Illuminate\Http\Request;

use Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $comments = Comment::all();
       return response()->json($comments);
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
        // $validatedData = $request->validate([
        //     'name' =>'required|unique:roles,name,'.$request->id,
        //     'permissionarray' => 'required',
        // ]);
	

        if($request->id)
        {
      
            $comment=Comment::find($request->id);
            $comment->post_id = $comment->post_id;
        }
        else
        {
            $comment=new Comment;
            $user = Auth::guard('api')->user();
            if($user){
                $comment->user_id = $user->id;
                $comment->post_id = $request->post_id;
                
                $comment->comment_title = $request->comment_title;
                $comment->comment_content = $request->comment_content;
                $comment->status = $request->status;
                $comment->save();
                $comment = Comment::where('id',$comment->id)->with('users')->first();
                 return response()->json($comment,200);
            }
        }
        
        return response()->json('did not add comment');
        

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(comment $comment)
    {
        $comm = Comment::find($comment->id);
        return response()->json($comm , '200');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $comment=Comment::where('id', $id)->with('users')->get();
        return view('management.comments.edit' ,compact ('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,Comment $comment)
    {
       
        $comment = Comment::find($comment->id);
      
        $comment->comment_title = $request->comment_title;
        $comment->comment_content = $request->comment_content;
        $comment->save();
        return response()->json($comment,200);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment=Comment::find($id);
        $comment->delete();
        return back();
    }
}
