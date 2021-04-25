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

        <div style="text-align: right">  <b class="blufont">معلومات الاتصال</b></div><hr>
        <div style="text-align: right">  <b class="blufont">العنوان &nbsp; : &nbsp;</b>{{$settings->address}}</div><hr>
        <div style="text-align: right">  <b class="blufont">هاتف &nbsp; : &nbsp;</b>{{$settings->phone}}</div><hr>
        <div style="text-align: right">  <b class="blufont">البريد الالكتروني &nbsp; : &nbsp;</b>{{$settings->email}}</div><hr>
        <div style="text-align: right">  <b class="blufont">حسابنا على فيسبوك &nbsp; : &nbsp;</b>{{$settings->facebook}}</div><hr>
        <div style="text-align: right">  <b class="blufont">حسابنا على تويتر &nbsp; : &nbsp;</b>{{$settings->twitter}}</div><hr>
        

        </div>
 
    </div>
</div>
@endsection