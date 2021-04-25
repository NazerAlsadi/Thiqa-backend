@extends('layouts.admin_layout')

@section('title' , 'المنشورات')

@section('content')


{{-- -----------------------------Start script---------------------------------------------------- --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function () {
  $('#selectAll').click(function (e) {
  $('#cattable').closest('table').find('td input:checkbox').prop('checked', this.checked);
});
});
</script>

{{-- -------------------------------- Create & Search compunents---------------------------------------------------- --}}

<div class="col-md-12">
    <div class="card">
	    <div class="card-header card-header-primary ">
	      <h4 class="card-title">المنشورات</h4>
        
        <form method="get" action="{{ url('/posts')  }}"  class="navbar-form" enctype="multipart/form-data">
            <div class="input-group no-border col-md-12" >
              <input type="search" name="input" value="{{$request->input}}"  class="form-control" style="color:white;" placeholder="بحث........" >
              <button type="submit" class="btn btn-white btn-round btn-just-icon">
                <i class="material-icons">search</i>
                <div class="ripple-container"></div>
              </button>
              <a href="{{url('posts')}}" class="btn btn-white btn-round btn-just-icon clearForm">
                <i class="material-icons">clear</i>
              </a>
              <div >
                <div class="form-check">
                  <label class="form-check-label" for="check1">
                    <input type="checkbox"  id="check1" name="withTrashed" value="1">اظهار المحذوف
                  </label>
                </div>
            </div>
          </div>
        </form>
      </div>

{{-- -----------------------------Check all compunents ---------------------------------------------------- --}}

        <div class="card-body table-responsive">
          <form action="{{url('posts-handle')}}" method="POST" id="main" name="main">
            {{@csrf_field()}}

            <div class="row" style="padding-right: 22px" >
                  <div>
                    <input type="checkbox"  name="" id="selectAll"><label  style="padding-left: 7px" for="exampleCheck1">تحديد الكل  </label>    
                    <button rel="tooltip" title="Remove" name = "remove" class="btn btn-primary  btn-link btn-sm checkAllIcon" onclick= " $('#method').val('remove');return confirm('هل انت متأكد من حذف المنشور ')" >
                      <i class="material-icons">clear</i>
                    </button>
                    <button rel="tooltip" title="Restore" name = "restore" class="btn btn-primary  btn-link btn-sm checkAllIcon" onclick= " $('#method').val('restore');return confirm('هل انت متأكد من استعادة المنشور')" >
                      <i class="material-icons">undo</i>
                    </button>
                    <input type="hidden" class="form-control"  name = "method"  id = "method">
                  </div>
            </div>
                <hr>

{{-- -------------------------------- Table compunents---------------------------------------------------- --}}    
		{{-- id category_id country_id governorate_id user_id post_title post_content status created_at updated_at	 --}}
        <div class="card-body table-responsive">
            <table class="table table-hover" dir ="rtl" id = "cattable">
                <thead class="text-primary ">
                    <th></th>
                    <th width="5%">القسم</th>
                        {{-- <th>الدولة</th> --}}
                    <th width="5%">المحافظة</th>
                    <th width="8%">اسم المستخدم</th>
                    <th width="18%">العنوان</th>
                    <th width="40%">النص</th>
                    <th width="10%">تاريخ النشر</th>
					<th>الحالة</th>
			        <th></th>
                </thead>
                <tbody>
               
				@foreach($posts as $post)
                <tr @if($post->deleted_at)  class="deleted" @endif>
                    <td><input type="checkbox" name="index[]" value="{{$post->id}}"></td>
                    <td >{{$post->categories->category_name}}</td>
                    <td  >{{$post->governorates->governorate_name}}</td>
                    <td  >{{$post->users->name}}</td>
                    <td  >{{$post->post_title}}</td>
                    <td  >{{$post->post_content}}</td>
                    <td  >{{$post->created_at}}</td>
		            <td> @if ($post->deleted_at) <p class="text-success">محذوف</p> @endif</td>
		            <td class="td-actions text-right">

                        <a href="{{ route('posts.show',$post->id) }}" rel="tooltip" title="معاينة" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">remove_red_eye</i>
                        </a>

		            	      <a href="{{ route('posts.edit',$post->id) }}" rel="tooltip" title="تعديل" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                        </a>

            
                        @if($post->deleted_at)
                        <a href="{{url('posts/'.$post->id.'/delete')}}"  rel="tooltip" title="Restore" class="btn btn-success  btn-link btn-sm" onclick="return confirm('Are you sure you want to delete {{$post->post_title}}?')">
                            <i class="material-icons">undo</i>
                        </a>
                        @else 
                        <a href="{{url('posts/'.$post->id.'/delete')}}" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm" onclick="return confirm('Are you sure you want to delete {{$post->post_title}}?')">
                            <i class="material-icons">clear</i>
                      </a>
                      @endif	
                    </td>  
	                    
		            </td>  
		        </tr>
		        @endforeach 
                </tbody>
            </table>
             {{ $posts->links() }}
        </div>
    </div>
</div>


@endsection


