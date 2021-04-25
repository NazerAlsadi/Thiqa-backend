<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Message;
use App\Post;
use Illuminate\Http\Request;
use Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $messages = Message::all();
       return response()->json($messages);
    }

     public function get_messages($user_id)
    {
        $messages = Message::where('status','active')->where('to_user_id',$user_id)->get();
        return response()->json($messages);
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
        if($user)
        {
            if($request->id)
            {
                $message=Message::find($request->id);
            }
            else
            {
                $message=new Message;
                $message->from_user_id = $user->id;
                $message->to_user_id = $request->to_user_id;
                $message->post_id = $request->post_id;
                $message->msg_replay_id = $request->msg_replay_id;
            }
        
            $message->meaasge_content = $request->meaasge_content;
            $message->save();
            return response()->json($message,200);
        }
    }


    public function readed_at($id)
    {
         $message=Message::find($id);
         $message->readed_at = Carbon::now();
         $message->save();
         return response()->json($message,200);
    }
    


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
