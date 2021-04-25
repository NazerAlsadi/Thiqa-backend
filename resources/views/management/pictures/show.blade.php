@extends('layouts.admin_layout')

@section('title' , 'عرض صورة')

@section('content')


<div class="col-md-10">

    <div class="card">
	    <div class="card-header card-header-primary ">
		  <p class="card-category">عرض صورة</p> 
        </div>
        
        <div class="card" >
            <div class="card-header">
                <p class="text-primary">{{$post->post_title}}</p>
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <p>{{$post->post_content}}</p>
                <h6> {{$post->created_at}}</h6>
              </blockquote>
            </div>
        </div>

            <div class="card" >
                <div class="card-body" >
                    <input type="hiddin" class="form-control" name="id" value="{{$picture->id}}" >
                    <h5 class="card-title">{{$picture->picture_title}}</h5>
                    <img src="\upload\post_imgs\{{$picture->picture_name}}" alt="" >
                </div>
                
                <div class="btn-group">
                    @if($picture->status == 'temp')
                    <a href="changePictureStatus/{{$picture->id}}/{{'active'}}" class="btn btn-success"> تأكيد الصورة</a>
                    @elseif($picture->status == 'active')
                    <a href="changePictureStatus/{{$picture->id}}/{{'temp'}}" class="btn btn-danger"> تعليق الصورة</a>
                    @endif   
                  </a>
                </div>
            </div>
    </div>
</div>
   

 

@endsection