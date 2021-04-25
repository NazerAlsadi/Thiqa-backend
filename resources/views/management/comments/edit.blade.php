@extends('layouts.admin_layout')

@section('title' , 'Categories')

@section('content')


<div class="col-md-10">

    <div class="card">
	    <div class="card-header card-header-primary ">
		  <p class="card-category">تعديل تعليق</p> 
        </div>
        
        <form method="post" action="{{url('comments')}}" > 
            {{ csrf_field() }}
            <div class="card" >
                <div class="card-body" >
                    <input type="text" class="form-control" name="id" value="{{$comment->id}}" >
                    <input type="text" class="form-control" name="comment_title" value="{{$comment->comment_title}}" >
                     <textarea class="form-control" rows="8" name="comment_content" >{{$comment->comment_content}}</textarea>
                     <a href="#" class="card-link">{{$comment->users->name}}</a>
                     <h6 class="card-subtitle mb-2 text-muted">{{$comment->created_at}}</h6>
                     <button type="submit" class="btn btn-success">حفظ </button>
                </div>
            </div>
         </form>
    </div>
</div>
   

 

@endsection