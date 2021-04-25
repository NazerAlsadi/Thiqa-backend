@extends('layouts.admin_layout')

@section('title' , 'User')

@section('content')

<div class="col-md-10">
<div class="card">
<div class="card-header card-header-primary">
  <h4 class="card-title">اضافة إعلان جديد</h4>
  <p class="card-category"></p>
</div>

{{-- id category_id picture_id title link status created_at updated_at --}}

	<div class="card-body" >

        <form method="POST" action="{{ route('advertises.store')  }}" enctype="multipart/form-data">
               
        {{ csrf_field() }}

        <input type="hidden" class="form-control" name = "position" value = {{$advertises->position}}>
        <input type="hidden" class="form-control" name = "picture_id" value = {{$advertises->picture_id}}>

        <input type="hidden" class="form-control" name = "id" value="{{$advertises->id}}">
        <div class="form-group">
            <label class="bmd-label-floating">العنوان</label>
            <input type="text" class="form-control" name = "title" value="{{$advertises->title}}">
        </div>
        <div class="form-group">
            <label class="bmd-label-floating">رابط الإعلان</label>
            <input type="text" class="form-control" name = "link" value="{{$advertises->link}}">
        </div>
        <label class="bmd-label-floating" value="{{$advertises->picture_id}}">{{$advertises->picture_id}}</label>
        <img src="/upload/advertise_imgs/{{$advertises->picture_id}}" alt=""  width="250">
        <div >
            <label class="bmd-label-floating">تعديل صورة</label>
            <input type="file" class="form-control" name="picture_url" placeholder="Your Post Image"   >
        </div>
        <div >
            <label class="bmd-label-floating">تاريخ البدء</label>
            <input type="date" value="{{$advertises->start_at}}"  name='start_at'>     
            <label class="bmd-label-floating">تاريخ الانتهاء</label>
            <input type="date" value={{$advertises->end_at}} name='end_at'>
        </div>

        <hr>

        <div class="form-check">
            <label  >
                عرض على الموبايل
              <input type="radio"  id="radio2" name="type" value="mob" checked>
            </label>
          </div>
          <div class="form-check">
            <label >
                عرض على صفحة الانترنت
                <input type="radio" id="radio2" name="type" value="web">   
            </label>
          </div>

        <button type="submit" class="btn btn-primary pull-right">حفظ</button>

    
  </form>
</div>
</div>
</div>
@endsection