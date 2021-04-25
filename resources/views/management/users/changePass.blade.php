@extends('layouts.admin_layout')

@section('title' , 'Categories')

@section('content')


 <div class="col-md-10">

    <div class="card" align="right">
	    <div class="card-header card-header-primary ">
		  <p class="card-category" >تغيير كلمة السر للمستخدم</p> 
		  <p class="card-category" >{{$user->name}}</
	    </div>
    </div>
	  <form method="post" action="{{url('users')}}">
	    {{ csrf_field() }}
	        <div class="form-group">
            <input type="hidden" class="form-control" name = "id" value="{{$user->id}}">
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" name = "name" value="{{$user->name}}">
        </div>
      

        <div class="form-group bmd-form-group">
            <input type="hidden" class="form-control" name = "phone" value="{{$user->phone}}">
        </div>
       
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Password</label>
            <input type="Password" name = "password" class="form-control">
        </div>

    
    
      
   
        <button type="submit" class="btn btn-primary pull-right">Update Profile</button>

    
  </form>
    </div>
   

 

@endsection