@extends('layouts.admin_layout')

@section('title' , 'اعدادات')

@section('content')


 <div class="col-md-7" align ="right">
    <div class="card">
	    <div class="card-header card-header-primary ">
	      <h4 class="card-title">تعديل الإعدادات</h4>
	      <p class="card-category"></p>
	   
	    </div>

        <div class="card-body table-responsive">
            <form method="post" action="{{url('settings')}}" > 
                {{ csrf_field() }}
            <table class="table table-hover" dir ="rtl">
                <thead class="text-primary ">
			        <th width = '150px'></th>
			        <th></th>
                </thead>
                <tbody>
                    <input type="hidden" class="form-control" name="id" value="{{$settings[0]->id}}" >
		        <tr>	
					<td>الاسم</td>
                <td> <input type="text" class="form-control" name="name" value="{{$settings[0]->name}}" ></td>
                </tr>
		        <tr>	
					<td>الاصدار</td>
                    <td><input type="text" class="form-control" name="version" value="{{$settings[0]->version}}" ></td>
                </tr>
                <tr>	
					<td>مدة المنشور / يوم</td>
                    <td><input type="text" class="form-control" name="post_time" value="{{$settings[0]->post_time}} " ></td>
                </tr>
                <tr>	
					<td>مدة الإعلان / يوم</td>
                    <td><input type="text" class="form-control" name="advertise_time" value="{{$settings[0]->advertise_time}}" > </td>
                </tr>
                <tr>	
					<td>وثيقة استخدام الخدمة</td>
                    <td><textarea class="form-control" rows="10" name="agreement" >{{$settings[0]->agreement}}</textarea></td>
                </tr>
                       <tr>	
					<td>من نحن</td>
                    <td><textarea class="form-control" rows="10" name="about_us" >{{$settings[0]->about_us}}</textarea></td>
                </tr>
                                       <tr>	
					<td>العنوان</td>
                    <td><textarea class="form-control" rows="2" name="address" >{{$settings[0]->address}}</textarea></td>
                </tr>
                                       <tr>	
					<td>هاتف</td>
                    <td><textarea class="form-control" rows="1" name="phone" >{{$settings[0]->phone}}</textarea></td>
                </tr>
                                       <tr>	
					<td>البريد الالكتروني</td>
                    <td><textarea class="form-control" rows="1" name="email" >{{$settings[0]->email}}</textarea></td>
                </tr>
                                       <tr>	
					<td>فيسبوك</td>
                    <td><textarea class="form-control" rows="1" name="facebook" >{{$settings[0]->facebook}}</textarea></td>
                </tr>
                <tr>	
					<td>تويتر</td>
                    <td><textarea class="form-control" rows="1" name="twitter" >{{$settings[0]->twitter}}</textarea></td>
                </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">حفظ </button>
        </form>
        </div>
    </div>
</div>


@endsection