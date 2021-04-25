@extends('layouts.admin_layout')

@section('title' , 'Categories')

@section('content')


 <div class="col-md-12" >
	
    <div class="card" >
	    <div class="card-header card-header-primary " align="right">
	      <h4 class="card-title">اعلان</h4>
		  <p class="card-category"></p> 
		  
	    </div>
        {{-- id	category_id	picture_id	title	link	status	created_at	updated_at	 --}}
        <div class="card-body table-responsive" align ="center">
            <img src="\upload\advertise_imgs\{{$advertises->picture_id}}" alt=""  height="300px">
            <input  type="text" class="form-control" name = "title" value="{{$advertises->title}}" >
        </div>
        </div>
    </div>
</div>


@endsection