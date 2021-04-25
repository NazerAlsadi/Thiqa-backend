@extends('layouts.admin_layout')

@section('title' , 'Categories')

@section('content')
<div class="row">
<div class="col-md-8">
<div class="card">
<div class="card-header card-header-primary">
  <h4 class="card-title">Create Category</h4>
  <p class="card-category">Complete your profile</p>
</div>


	<div class="card-body">

	  <form method="post" action="{{ route('categories.store')  }}">
	    {{ csrf_field() }}
        
        <div class="form-group">
            <label class="bmd-label-floating">Picture ID</label>
            <input type="text" class="form-control" name = "picture_id">
        </div>
      

        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Country_id</label>
            <input type="email" class="form-control" name = "email">
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
</div>
@endsection