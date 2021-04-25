@extends('layouts.admin_layout')

@section('title' , 'Categories')

@section('content')


 <div class="col-md-12">
	 <div class="dropdown show">
		<a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		  اضافة تصنيف
		</a>
		<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
		  <a class="dropdown-item" href="addUpdateL1">مستوى أول</a>
		  <a class="dropdown-item" href="addUpdateL2">مستوى ثاني</a>
		  <a class="dropdown-item" href="addUpdateL3">مستوى ثالث</a>
		</div>
	  </div>
    <div class="card">
	    <div class="card-header card-header-primary ">
	      <h4 class="card-title">التعليقات</h4>
		  <p class="card-category">التعليقات غير المشاهدة من قبل الادارة</p> 
		  
	    </div>
		{{-- id	post_id	user_id	comment_title	comment_content	status	created_at	updated_at	 --}}
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead class="text-primary ">
			        <th>المنشور</th>
			        <th>اسم لمستخدم</th>
					<th>عنوان التعليق</th>
                    <th>نص التعليق</th>
                    <th>تاريخ التعليق</th>
                    <th>الحالة</th>
			        <th></th>
                </thead>
                <tbody>
               
                @foreach($comments as $comment)
		        <tr>
                    <td>{{$comment->post_id}}</td>
                    <td>{{$comment->user_id}}</td>
                    <td>{{$comment->comment_title}}</td>
                    <td>{{$comment->comment_content}}</td>
                    <td>{{$comment->created_at}}</td>
                    <td>{{$comment->status}}</td>

		            <td class="td-actions text-right">

                        <a href="{{ route('categories.edit',$comment->id) }}" rel="tooltip" title="معاينة" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">remove_red_eye</i>
                        </a>

		            	<a href="{{ route('categories.edit',$comment->id) }}" rel="tooltip" title="تعديل" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                        </a>

                        <form method="POST" action="{{ route('categories.destroy',$comment->id) }}" style="display: inline-block;">
			                {{ csrf_field() }}
			                @method('delete')
	                        <button rel="tooltip" title="حذف" class="btn btn-danger btn-link btn-sm" onclick="return confirm('Are you sure you want to delete {{$comment->title}}?')">
	                            <i class="material-icons">close</i>
	                        </button>
	                    </form>
	                    
		            </td>  
		        </tr>
		        @endforeach 
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection