<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

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
        return view('management.comments.index' , compact('comments'));
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
            $comment->id = $comment->id;
        }
        else
        {
          
            $comment=new Comment;
            $comment->id = $request->id;
        }

        $comment->post_id = $comment->post_id;
        $comment->user_id = $comment->user_id;
        $comment->comment_title = $request->comment_title;
        $comment->comment_content = $request->comment_content;
        $comment->status = $comment->status;
        $comment->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {  
        $comment=Comment::where('id', $id)->with('users','post')->first();
        return view('management.comments.show' , compact('comment' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $comment=Comment::where('id', $id)->with('users')->first();
        return view('management.comments.edit' ,compact ('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

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

    public function handle(Request $request)
    {        
       if ($request->method == "remove")
       {
           foreach($request->index as $id)
           {
               $comment=Comment::where('id',$id)->first();
               if($comment)
               {
                   $comment->delete();
               }
           }
       }
       elseif ($request->method == "restore")
       {
           foreach($request->index as $id)
           {
               $comment=Comment::withTrashed()->find($id);
               if($comment)
               {
                   $comment->restore();
               }
           }
       }

       return back();  
    }

    
    public function changeStatus($id, $st){

        $comment =  Comment::find($id);
 
             $comment->status = $st ;
             $comment->update();
        
        return redirect('/comments_review');
     }
}
