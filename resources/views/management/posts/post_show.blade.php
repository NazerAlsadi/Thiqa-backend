@extends('layouts.admin_layout')

@section('title' , 'Categories')

@section('content')


 <div class="col-md-10">

    <div class="card">
	    <div class="card-header card-header-primary ">
		  <p class="card-category"></p> 
		  
	    </div>
        
        <div class="card-body table-responsive">
      
            <p class="text-primary" > {{$posts->users->name}} <i class="material-icons">contact_page</i></p>
            <div class="card" >
                <div class="card-header">
                    <p class="text-primary">{{$posts->post_title}}</p>
                </div>
                <div class="card-body">
                  <blockquote class="blockquote mb-0">
                    <p>{{$posts->post_content}}</p>
                    <h6> {{$posts->created_at}}  ..... {{$posts->governorates->governorate_name}}</h6>
                  </blockquote>
                </div>
                <div>
                    <div class="btn-group">
                          @if($posts->status == 'temp')
                          <a href="changePostStatus/{{$posts->id}}/{{'active'}}" class="btn btn-success"> تأكيد المنشور</a>
                          @elseif($posts->status == 'active')
                          <a href="changePostStatus/{{$posts->id}}/{{'temp'}}" class="btn btn-danger"> تعليق المنشور</a>
                          @endif   
                        </a>
                    </div>
              </div>
            </div>
            @foreach($pictures as $picture)
            <div  align="center">
              
                    <img src="\upload\post_imgs\{{$picture->picture_name}}" alt="{{$picture->picture_title}}" class="img-thumbnail" >
            
            </div><br>
            @endforeach
        </div>

   
        <p class="text-primary" >   التعليقات {{$comments->count()}} <i class="material-icons">question_answer</i></p>

        @foreach($comments as $comment)
            <div class="card">
                <div class="card-body">
                     <h5 class="card-title">{{$comment->comment_title}}</h5>
                     <h6 class="card-subtitle mb-2 text-muted">{{$comment->created_at}}</h6>
                     <p class="card-text">{{$comment->comment_content}}</p>
                     <a href="#" class="card-link">{{$comment->users->name}}</a>

                     <a href="{{ route('comments.edit',$comment->id) }}" rel="tooltip" title="تعديل" class="btn btn-primary btn-link btn-sm">
                        <i class="material-icons">edit</i>
                    </a>

                    <form method="POST" action="{{ route('comments.destroy',$comment->id) }}" style="display: inline-block;">
                        {{ csrf_field() }}
                        @method('delete')
                        <button rel="tooltip" title="حذف" class="btn btn-danger btn-link btn-sm" onclick="return confirm('هل أنت متأكد من حذف التعليق {{$comment->title}}?')">
                            <i class="material-icons">close</i>
                        </button>
                    </form>

                </div>
            </div>
        @endforeach  
     </div>
    </div>
   

 

@endsection