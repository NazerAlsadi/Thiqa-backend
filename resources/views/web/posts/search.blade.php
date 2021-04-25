@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3 rcol">
            <br>
            @foreach($sub_categories as $sub_category)	
                <a href="#" class="badge badge-primary">{{$sub_category->category_name}}</a>
            @endforeach
            <hr>
            <div>
                <img class="card-img-top" src="\upload\advertise_imgs\rt.jpg" alt="Card image" style="width:100%">
            </div>
            <hr>
            اختر منطقتك<br>
            @foreach($governorates as $governorate)	
                <a href="#" class="badge badge-secundary">{{$governorate->governorate_name}}</a>
            @endforeach

            <hr>
            <div>
                <img class="card-img-top" src="\upload\advertise_imgs\rb.jpg" alt="Card image" style="width:100%">
            </div>
            <hr>
            <button type="button" class="btn btn-outline-secondary mb-1" style="width:100%">اتفاقية الاستخدام</button>
            <button type="button" class="btn btn-outline-secondary mb-1" style="width:100%">جميع الفئات</button>
            <button type="button" class="btn btn-outline-secondary mb-1" style="width:100%">من نحن</button>
            <button type="button" class="btn btn-outline-secondary mb-1" style="width:100%">اتصل بنا</button>
        </div>

 

        <div class="col-md-9">
{{------------------------------------------------- posts --------------------------------------------------}}
@if ($posts)
    <div style="text-align: right"> عرض نتائج البحث عن <b class="blufont">{{$request->input}}</b></div><hr>
@foreach($posts as $post)	
<div class="card mb-3 card" >
    <div class="row no-gutters">
        <div class="col-md-9">
            <div class="card-body" style="height: 190px  ">
            <a class="card-title" href="{{url('details',$post->id)}}"><h5 class="card-title">{{$post->post_title}}</h5></a>
            <p class="card-text fontbold">{{\Illuminate\Support\Str::limit($post->post_content,150)}}<a class="blufont" href="{{url('details',$post->id)}}">.   المزيد</a></p>
            <p class="card-text"><small class="text-muted">{{$post->created_at}}</small> <a href="#" class="badge badge-secundary">{{$post->governorates->governorate_name}}</a></p>
            </div>
        </div>

@if(count($post->pictures))
        @foreach($post->pictures as $picture)	
            <div class="container col-md-3" >
                <div class= "postimg" style='background-image: url("/upload/post_imgs/{{$picture->picture_name}}")'></div>
            </div>
        @break
        @endforeach               
@else
        <div class="container col-md-3">
            <div class= "postimg" style='background-image: url("/upload/post_imgs/logo.jpg")'></div>
        </div>
@endif 
    </div>
</div>
@endforeach
{{ $posts->links() }}

@else
    لايوجد نتائج للبحث
@endif



            {{------------------------------------------------- end posts --------------------------------------------------}}
        </div>
 
    </div>
</div>
@endsection