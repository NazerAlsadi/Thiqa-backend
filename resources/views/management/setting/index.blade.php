@extends('layouts.admin_layout')

@section('title' , 'اعدادات')

@section('content')


 <div class="col-md-7" align ="right">
    <div class="card">
	    <div class="card-header card-header-primary ">
	      <h4 class="card-title">الاعدادات</h4>
	      <p class="card-category"></p>
	   
	    </div>

        <div class="card-body table-responsive">
            <table class="table table-hover" dir ="rtl">
                <thead class="text-primary ">
			        <th width = '150px'></th>
			        <th></th>
                </thead>
                <tbody>
               
		        <tr>	
					<td>الاسم</td>
                <td>{{$settings[0]->name}}</td>
                </tr>
		        <tr>	
					<td>الاصدار</td>
                    <td>{{$settings[0]->version}}</td>
                </tr>
                <tr>	
					<td>مدة المنشور</td>
                    <td>{{$settings[0]->post_time}} يوم</td>
                </tr>
                <tr>	
					<td>مدة الإعلان</td>
                    <td>{{$settings[0]->advertise_time}} يوم</td>
                </tr>
                <tr>	
					<td>وثيقة استخدام الخدمة</td>
                    <td>{{$settings[0]->agreement}}</td>
                </tr>
                     <tr>	
					<td>من نحن</td>
                    <td>{{$settings[0]->about_us}}</td>
                </tr>
                           <tr>	
					<td>العنوان</td>
                    <td>{{$settings[0]->address}}</td>
                </tr>
                           <tr>	
					<td>هاتف</td>
                    <td>{{$settings[0]->phone}}</td>
                </tr>
                <tr>	
					<td>ايميل</td>
                    <td>{{$settings[0]->email}}</td>
                </tr>
                <tr>	
					<td>فيسبوك</td>
                    <td>{{$settings[0]->facebook}}</td>
                </tr>
                        <tr>	
					<td>تويتير</td>
                    <td>{{$settings[0]->twitter}}</td>
                </tr>
                </tbody>
            </table>
            <div>
                <a href="{{ route('settings.edit',1)  }}" class="btn btn-success">تعديل</a>
            </div>
        </div>
    </div>
</div>


@endsection