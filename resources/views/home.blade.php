@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3 rcol">
            @foreach($sub_categories as $sub_category)	
                <a href="{{url('postsByCategry/'.$sub_category->id)}}" class="badge badge-primary">{{$sub_category->category_name}}</a>
            @endforeach
            <hr>
            <div>
                <img class="card-img-top" src="/upload/advertise_imgs/rt.jpg" alt="Card image" style="width:100%">
            </div>
            <hr>
            اختر منطقتك<br>
            @foreach($governorates as $governorate)	
                <a href="{{url('postsByGovernorate/'.$governorate->id)}}" class="badge badge-secundary">{{$governorate->governorate_name}}</a>
            @endforeach

            <hr>
            <div>
                <img class="card-img-top" src="/upload/advertise_imgs/rb.jpg" alt="Card image" style="width:100%">
            </div>
            <hr>
            <a href="{{url('/')}}" type="button" class="btn btn-outline-secondary mb-1" style="width:100%">الصفحة الرئيسية</a>
            <a href="{{url('MainCategories')}}" type="button" class="btn btn-outline-secondary mb-1" style="width:100%">الفئات</a>
            <a href="{{url('agreement')}}" type="button" class="btn btn-outline-secondary mb-1" style="width:100%">اتفاقية الاستخدام</a>
            <a href="{{url('aboutUs')}}" type="button" class="btn btn-outline-secondary mb-1" style="width:100%">من نحن</a>
            <a href="{{url('contactUs')}}" type="button" class="btn btn-outline-secondary mb-1" style="width:100%">اتصل بنا</a>
        </div>

 

        <div class="col-md-9">
{{------------------------------------------------- posts --------------------------------------------------}}

            @foreach($posts as $post)	
            <div class="card mb-3 card" >
                <div class="row no-gutters">
                    <div class="col-md-9">
                        <div class="card-body" style="height: 190px  ;  overflow: auto">
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

            {{------------------------------------------------- end posts --------------------------------------------------}}
        </div>

        <div class="container-fluid">
            <hr>
        <div clss="row">
            <img class="card-img-top" src="/upload/advertise_imgs/d.jpg" alt="Card image" style="width:100%">
        </div>

        <hr>

        {{-------------------------------------------four_categories-----------------------------------------------------}}

    
        <div class="row">
            @foreach($four_categories as $four_category)	
            <div class="col-md-3 " >
              <a href="{{url('subcategories/'.$four_category->id)}}">
                  <div class="card" style="width:100%">
                  <img class="card-img-top" src="\upload\category\{{$four_category->picture_id}}" alt="Card image" style="width:100%">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center">{{$four_category->category_name}}</h4>
                  </div>
                </div> 
              </a>
           </div>
            @endforeach
        </div>

          </div>  
    </div>
</div>
@endsection