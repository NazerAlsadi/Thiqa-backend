@extends('layouts.admin_layout')

@section('title' , 'User')

@section('content')

<div class="col-md-8">
<div class="card">
<div class="card-header card-header-primary">
  <h4 class="card-title">Create Profile</h4>
  <p class="card-category">Complete your profile</p>
</div>


	<div class="card-body">

	  <form method="post" action="{{ route('users.store')  }}">
	    {{ csrf_field() }}
        
        <div class="form-group">
            <label class="bmd-label-floating">Username</label>
            <input type="text" class="form-control" name = "name">
        </div>
      

        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Phone</label>
            <input type="phone" class="form-control" name = "phone">
        </div>
       
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Password</label>
            <input type="Password" name = "password" class="form-control">
        </div>

    
    
      
   
        <button type="submit" class="btn btn-primary pull-right">Create Profile</button>

    
  </form>
</div>
</div>
</div>
@endsection