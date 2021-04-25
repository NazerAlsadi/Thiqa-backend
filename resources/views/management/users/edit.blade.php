@extends('layouts.admin_layout')

@section('title' , 'User')

@section('content')

<div class="col-md-8">
<div class="card">
<div class="card-header card-header-primary">
  <h4 class="card-title">Edit Profile</h4>
  <p class="card-category">Complete your profile</p>
</div>


	<div class="card-body">

	  <form method="post" action="{{url('users')}}">
	    {{ csrf_field() }}
	    
	    	        <div class="form-group">
            <input type="hidden" class="form-control" name = "id" value="{{$user->id}}">
        </div>
        
        <div class="form-group">
            <label class="bmd-label-floating">Username</label>
            <input type="text" class="form-control" name = "name" value="{{$user->name}}">
        </div>
      

        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Phone</label>
            <input type="phone" class="form-control" name = "phone" value="{{$user->phone}}">
        </div>
       
        <div class="form-group bmd-form-group">
            <input type="hidden" name = "password" class="form-control" value="{{$user->password}}">
        </div>

   
        <button type="submit" class="btn btn-primary pull-right">Update Profile</button>

    
  </form>
</div>
</div>
</div>
@endsection