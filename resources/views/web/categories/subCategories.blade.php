@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3 rcol">
            <br>
            @foreach($sub_categories as $sub_category)	
            <a href="{{url('postsByCategry/'.$sub_category->id)}}" class="badge badge-primary">{{$sub_category->category_name}}</a>
            @endforeach
            <hr>
            <div>
                <img class="card-img-top" src="\upload\advertise_imgs\rt.jpg" alt="Card image" style="width:100%">
            </div>
            <hr>
            اختر منطقتك<br>
            @foreach($governorates as $governorate)	
            <a href="{{url('postsByGovernorate/'.$governorate->id)}}" class="badge badge-secundary">{{$governorate->governorate_name}}</a>
            @endforeach

            <hr>
            <div>
                <img class="card-img-top" src="\upload\advertise_imgs\rb.jpg" alt="Card image" style="width:100%">
            </div>
            <hr>
            <a href="{{url('/')}}" type="button" class="btn btn-outline-secondary mb-1" style="width:100%">الصفحة الرئيسية</a>
            <a href="{{url('MainCategories')}}" type="button" class="btn btn-outline-secondary mb-1" style="width:100%">الفئات</a>
            <a href="{{url('agreement')}}" type="button" class="btn btn-outline-secondary mb-1" style="width:100%">اتفاقية الاستخدام</a>
            <a href="{{url('aboutUs')}}" type="button" class="btn btn-outline-secondary mb-1" style="width:100%">من نحن</a>
            <a href="{{url('contactUs')}}" type="button" class="btn btn-outline-secondary mb-1" style="width:100%">اتصل بنا</a>
        </div>

 

        <div class="col-md-9">     

        <div style="text-align: right">  <a href="{{url('MainCategories')}}"><b class="blufont">الفئات الرئيسية / </b></a> <b class="blufont">الفئات الفرعية</b></div><hr>
 
        <div class="row">
            <div class="col-md-5">
                <div class="card" style="width:100%">
                    <img class="card-img-top" src="\upload\category\{{$main_category->picture_id}}" alt="Card image" style="width:100%">
                    <div class="card-body">
                        <h4 class="card-title" style="text-align: center">{{$main_category->category_name}}</h4>
                    </div>
                </div> 
            </div> 
            @foreach($categories as $category)	
   
                <a href="{{url('postsByCategry/'.$category->id)}}" class="badge badge-secundary">
                    <div class="card" style="width:100%">
                        <div class="card-body">
                            <h6 class="card-title" style="text-align: center">{{$category->category_name}}</h6>
                        </div>
                    </div> 
                </a>
     
            @endforeach
        </div>
        

        </div>
 
    </div>
</div>
@endsection