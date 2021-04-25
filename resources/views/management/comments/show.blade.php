@extends('layouts.admin_layout')

@section('title' , 'عرض تعليق')

@section('content')


<div class="col-md-10">

    <div class="card">
	    <div class="card-header card-header-primary ">
		  <p class="card-category">عرض تعليق</p> 
        </div>
        
        <div class="card" >
            <div class="card-header">
                <p class="text-primary">{{$comment->post->post_title}}</p>
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <p>{{$comment->post->post_content}}</p>
                <h6> {{$comment->post->created_at}}</h6>
              </blockquote>
            </div>
        </div>

            <div class="card" >
                <div class="card-body" >
                    <input type="hiddin" class="form-control" name="id" value="{{$comment->id}}" >
                    <h5 class="card-title">{{$comment->comment_title}}</h5>
                    <p class="card-text">{{$comment->comment_content}}</p>
                     <a href="#" class="card-link">{{$comment->users->name}}</a>
                     <h6 class="card-subtitle mb-2 text-muted">{{$comment->created_at}}</h6>
                </div>
                
                <div class="btn-group">
                    @if($comment->status == 'temp')
                    <a href="changeCommentStatus/{{$comment->id}}/{{'active'}}" class="btn btn-success"> تأكيد التعليق</a>
                    @elseif($comment->status == 'active')
                    <a href="changeCommentStatus/{{$comment->id}}/{{'temp'}}" class="btn btn-danger"> تعليق التعليق</a>
                    @endif   
                  </a>
              </div>
            </div>
    </div>
</div>
   

 

@endsection