@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{------------------------------- detailes--------------------------------}}
        <div class="col-md-8 rcol">
            <div class="row"><i class="material-icons">person</i> <h5><a href="#" class="badge badge-secundary">{{$post->users->name}}</a></h5> 
            <div class ="mr-auto"><i class="material-icons">schedule</i>{{$post->created_at}}</div></div> <br>

            <div class="row"><h5 class = "blufont">{{$post->post_title}}</h5> 
                <div>
                    {{$post->post_content}}
                </div>            
        </div> <br>

        {{----------------------------------------images---------------------------------------------------------}}


        @foreach($pictures as $picture)
            <div  align="center">
              
                    <img src="\upload\post_imgs\{{$picture->picture_name}}" alt="{{$picture->picture_title}}" class="img-thumbnail" >
            
            </div><br>
         @endforeach

        {{----------------------------------------comments---------------------------------------------------------}}

            <hr>
            <h6 class = "blufont">التعليقات<span class="badge">{{count($comments)}}</span></h6> 
            <div>
                @foreach($comments as $comment)	
                <div class="card mb-3 card" style="background-color: #f1eef1">
                    <div class="row no-gutters">
                        <div>
                            <div class="card-body">
                            <h6 class="card-title">{{$comment->comment_title}}</h6>
                            <p class="card-text fontbold">{{$comment->comment_content}}</p>
                            <p class="card-text"><small class="text-muted">{{$comment->created_at}}</small> <a href="#" class="badge badge-secundary">{{$comment->users->name}}</a></p>
                            </div>
                        </div>
                        
                    </div>
                </div>
                @endforeach
            </div>
            <br><hr>  
        {{------------------------------- Like --------------------------------}}
        <br>
        <h6 class = "blufont">منشورات تهمك</h6> 

        @foreach($like_post as $post)	
            <div class="card mb-3 card" >
                <div class="row no-gutters">
                    <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title">{{$post->post_title}}</h5>
                        <p class="card-text fontbold">{{\Illuminate\Support\Str::limit($post->post_content,150)}}<a class="blufont" href="{{url('details',$post->id)}}">.   المزيد</a></p>
                        <p class="card-text"><small class="text-muted">{{$post->created_at}}</small> <a href="#" class="badge badge-secundary">{{$post->governorates->governorate_name}}</a></p>
                        </div>
                    </div>
                    @if(count($post->pictures))
                    @foreach($post->pictures as $picture)	
                        <div class="container col-md-3" tyle="height: 100%">
                            <img src="/upload/post_imgs/{{$picture->picture_name}}" class="img-thumbnail" alt="...">
                        </div>
                    @break
                    @endforeach               
            @else
                    <div class="container col-md-3" tyle="height: 100%">
                    <img src="/upload/post_imgs/logo.jpg" class="img-thumbnail" alt="...">
                    </div>
            @endif    
                </div>
            </div>
            @endforeach

</div>
@endsection


      