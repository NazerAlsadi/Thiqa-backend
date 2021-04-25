@extends('layouts.admin_layout')

@section('title' , 'Categories')

@section('content')


 <div class="col-md-10">

    <div class="card" align="right">
	    <div class="card-header card-header-primary ">
		  <p class="card-category"></p> 
		  
	    </div>
        
        <form method="post" action="{{url('posts')}}" > 
            {{ csrf_field() }}
        <div class="card-body table-responsive">
            <div class="card">
                <input type="hidden" class="form-control" name="id" value="{{$posts[0]->id}}" >
                <div class="card-header">
                    <input type="text" class="form-control" name="post_title" value="{{$posts[0]->post_title}}" >
                    <textarea class="form-control" rows="8" name="post_content" >{{$posts[0]->post_content}}</textarea>
                    <button type="submit" class="btn btn-success">حفظ </button>
                </div>
              </div>
            </div>
        </div>
    </form>

        
     </div>
    </div>
   

 

@endsection