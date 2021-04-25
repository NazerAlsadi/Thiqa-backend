@extends('layouts.admin_layout')

@section('title' , 'اعلانات')

@section('content')


 <div class="col-md-12">
	<div>
		<a href="{{ route('advertises.create')  }}" class="btn btn-success">اضافة إعلان</a>
	</div>
    <div class="card">
	    <div class="card-header card-header-primary ">
	      <h4 class="card-title">الاعلانات</h4>
		  <p class="card-category">اعلانات تظهر على الشاشة الرئيسية</p> 
		  
	    </div>
		{{-- id	category_id	picture_id	title	link	status	created_at	updated_at	 --}}
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead class="text-primary ">
			        <th>يعرض على</th>
			        <th> مكان الإعلان</th>
					<th>صورة الإعلان</th>
					<th>رابط الاعلان</th>
					<th>تاريخ البدء</th>
					<th>تاريخ الانتهاء</th>
			        {{-- <th>الحالة</th> --}}
			        <th></th>
                </thead>
                <tbody>
                @foreach($advertises as $advertise)
		        <tr>
		        	<td>  
						
					@php
					if($advertise->type  == "mob")  {echo'الموبايل'  ;}
					if($advertise->type  == "web")  {echo'صفحة الويب'  ;} 	
					@endphp
					</td>
					<td> 
					@php
					if($advertise->position  == "main")  {echo'شرائح الرئيسية'  ;}
					if($advertise->position  == "rt")  {echo'يمين أعلى'  ;} 	
					if($advertise->position  == "rd")  {echo'يمين أسفل'  ;} 
					if($advertise->position  == "d")  {echo'اسفل عرضي'  ;} 
					@endphp
				    </td>
					
					<td>
						<img src="/upload/advertise_imgs/{{$advertise->picture_id}}" alt=""  height="50px">
					</td>
					<td>{{$advertise->link}}</td>
					<td>{{$advertise->start_at}}</td>
					<td>{{$advertise->end_at}}</td>
		            {{-- <td>{{$advertise->status}}</td> --}}
		            <td class="td-actions text-right">
						<a href="{{ route('advertises.show',$advertise->id) }}" rel="tooltip" title="معاينة" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">remove_red_eye</i>
						</a>
						
		            	<a href="{{ route('advertises.edit',$advertise->id) }}" rel="tooltip" title="تعديل" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
						</a>
						
						@if (($advertise->type) !="web" )
								<form method="POST" action="{{ route('advertises.destroy',$advertise->id) }}" style="display: inline-block;">
									{{ csrf_field() }}
									@method('delete')
									<button rel="tooltip" title="حذف" class="btn btn-danger btn-link btn-sm" onclick="return confirm('هل انت متأكد من حذف الإعلان {{$advertise->title}}?')">
										<i class="material-icons">close</i>
									</button>
								</form>
						@endif	                    
		            </td>  
		        </tr>
		        @endforeach 
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection