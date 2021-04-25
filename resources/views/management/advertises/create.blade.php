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

        <input type="hidden" class="form-control" name = "position" value ="main">

        <div class="form-group">
            <label class="bmd-label-floating">العنوان</label>
            <input type="text" class="form-control" name = "title">
        </div>
        <div class="form-group">
            <label class="bmd-label-floating">رابط الإعلان</label>
            <input type="text" class="form-control" name = "link">
        </div>

        <div >
            <label class="bmd-label-floating">اضافة صورة</label>
            <input type="file" class="form-control" name="picture_url" placeholder="Your Post Image"  >
        </div>
        <br>
 
        <div >
            @php
               
                $start_at =  date("Y-m-d");
                // dd($advertise_time."   days");
                $end_at = date('Y-m-d', strtotime($start_at. ' + '.$advertise_time.'  days'));
            @endphp
            <label class="bmd-label-floating">تاريخ البدء</label>
            <input type="date" value={{$start_at}} name='start_at'>     
            <label class="bmd-label-floating">تاريخ الانتهاء</label>
            <input type="date" value={{$end_at}} name='end_at'>
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