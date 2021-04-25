<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $users = User::all();
        return view('management.users.index' , compact('users'));
    }

    public function admins()
    { 
        if(Auth::user()->role == 'sadmin'){
        $users = User::where('password','!=','otp')->get();
        return view('management.users.sadmin' , compact('users'));}
        else{dd("you are not admin");}
    }
      public function changeToAdmin()
    {   
        $users = User::where('password','otp')->get();
        return view('management.users.changToAdmin' , compact('users'));
    }
    
          public function changePass($id)
    {   
        $user = User::where('id',$id)->first();
        return view('management.users.changePass' , compact('user'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->id){
            $user=User::find($request->id); 
            $user->name = $request->name;
            $user->phone= $request->phone;
            if($request->password == 'otp'){$user->password = $user->password ;}
            else{$user->password = Hash::make($request->password);}
            $user->save();
            return redirect('/dashboard'); 
        }
        else
        {
            $user = new User();   
            $user->name = $request->name;
            $user->phone= $request->phone;
            $user->password = $user->password ;
            $user->save();
            return redirect('/users');  
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = User::find($user)->first();

        return view('management.users.edit' , compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user=User::find($user->id);
        $user->delete();
        return back();
    }
    
      public function change($id)
    {
          $user =  User::find($id);
 
             $user->password = Hash::make("123456789");
             $user->update();
        
        return redirect('/sadmin');
    }
}
