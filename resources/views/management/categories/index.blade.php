@extends('layouts.admin_layout')

@section('title' , 'Categories')

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
	<div class="dropdown show">
		<a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		  اضافة تصنيف
		</a>
		<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
		  <a class="dropdown-item" href="addUpdateL1">مستوى أول</a>
		  <a class="dropdown-item" href="addUpdateL2">مستوى ثاني</a>
		</div>
	  </div>
    <div class="card">
	    <div class="card-header card-header-primary ">
	      <h4 class="card-title"> التصنيفات</h4>
        
        <form method="get" action="{{ url('/categories')  }}"  class="navbar-form" enctype="multipart/form-data">
            <div class="input-group no-border col-md-12" >
              <input type="search" name="input" value="{{$request->input}}"  class="form-control" style="color:white;" placeholder="بحث........" >
              <button type="submit" class="btn btn-white btn-round btn-just-icon">
                <i class="material-icons">search</i>
                <div class="ripple-container"></div>
              </button>
              <a href="{{url('categories')}}" class="btn btn-white btn-round btn-just-icon clearForm">
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
          <form action="{{url('categories-handle')}}" method="POST" id="main" name="main">
            {{@csrf_field()}}

            <div class="row" style="padding-right: 22px" >
                  <div>
                    <input type="checkbox"  name="" id="selectAll"><label  style="padding-left: 7px" for="exampleCheck1">تحديد الكل  </label>    
                    <button rel="tooltip" title="Remove" name = "remove" class="btn btn-primary  btn-link btn-sm checkAllIcon" onclick= " $('#method').val('remove');return confirm('Are you sure you want to delete ?')" >
                      <i class="material-icons">clear</i>
                    </button>
                    <button rel="tooltip" title="Restore" name = "restore" class="btn btn-primary  btn-link btn-sm checkAllIcon" onclick= " $('#method').val('restore');return confirm('Are you sure you want to delete ?')" >
                      <i class="material-icons">undo</i>
                    </button>
                    <input type="hidden" class="form-control"  name = "method"  id = "method">
                  </div>
            </div>
                <hr>

{{-- -------------------------------- Table compunents---------------------------------------------------- --}}
        <div class="card-body table-responsive">
            <table class="table table-hover" dir ="rtl" id = "cattable">
                <thead class="text-primary ">
					<th></th>
					<th></th>
			        <th>الرمز</th>
			        <th>الاسم</th>
			        <th>الوصف</th>
			        <th>ترتيب العرض</th>
			        <th>الحالة</th>
                    <th style="width: 10px;"></th>
                    <th style="width: 10px;"></th>
                </thead>
                <tbody>

					@foreach($categories as $category)	
					<tr style="background-color :lightgrey" @if($category->deleted_at)  class="deleted" @endif>
					  <td><input type="checkbox" name="index[]" value="{{$category->id}}"></td>
						<td><i class="material-icons">account_tree</i></td>
						<td>{{$category->id}}</td>
						<td><a href="categories/{{$category->id}}">{{$category->category_name}}</a></td>
						<td>{{$category->description}}</td>
						<td>{{$category->display_order}}</td>
						<td>{{$category->status}}</td>	
						<!-- Edit category-->  
							<td> 
							  @if ($category->deleted_at)
							  <a href="#" rel="tooltip" title="Edit" class="btn btn-secundory btn-link btn-sm">
								<i class="material-icons">edit</i>
							  </a>
							  @else
							  <a href="{{ route('categories.edit',$category->id) }}" rel="tooltip" title="Edit" class="btn btn-primary btn-link btn-sm">
								<i class="material-icons">edit</i>
							  </a>	
							  @endif
							</td>
						<!-- Delete category-->  
						<td>
								@if($category->deleted_at)
								<a href="{{url('categories/'.$category->id.'/delete')}}"  rel="tooltip" title="Restore" class="btn btn-success  btn-link btn-sm" onclick="return confirm('Are you sure you want to delete {{$category->title}}?')">
									<i class="material-icons">undo</i>
								</a>
								@else 
								<a href="{{url('categories/'.$category->id.'/delete')}}" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm" onclick="return confirm('Are you sure you want to delete {{$category->title}}?')">
									<i class="material-icons">clear</i>
							  </a>
							  @endif	
						</td>  
					</tr>
					@foreach($category->sub as $sub)
					<tr>
					  <tr @if($sub->deleted_at) class="deleted" @endif>
						<td><input type="checkbox" name="index[]" value="{{$sub->id}}"></td>
						<td></td>
						<td> {{$sub->id}}</td>
						<td><a href="categories/{{$sub->id}}">{{$sub->category_name}}</a></td>
						<td>{{$sub->description}}</td>
						<td>{{$sub->display_order}}</td>
						<td>{{$sub->status}}</td>	
							<!-- Edit sub category--> 
							<td> 
							  @if ($sub->deleted_at)
							  <a href="#" rel="tooltip" title="Edit" class="btn btn-secundory btn-link btn-sm">
								<i class="material-icons">edit</i>
							  </a>
							  @else
							  <a href="{{ route('categories.edit',$sub->id) }}" rel="tooltip" title="Edit" class="btn btn-primary btn-link btn-sm">
								<i class="material-icons">edit</i>
							  </a>	
							  @endif
	
							</td>
							<!-- Delete sub category-->  
							<td>
								   
									@if($sub->deleted_at)
									<a href="{{url('categories/'.$sub->id.'/delete')}}" rel="tooltip" title="Restore" type="button" class="btn btn-success btn-link btn-sm" onclick="return confirm('Are you sure you want to restore {{$sub->title}}?')">
										<i class="material-icons">undo</i>
									</a>
									@else 
									<a href="{{url('categories/'.$sub->id.'/delete')}}" rel="tooltip" title="Remove" type="button" class="btn btn-danger btn-link btn-sm" onclick="return confirm('Are you sure you want to delete {{$sub->title}}?')">
										<i class="material-icons">clear</i>
									</a>
								  @endif
								</form>
							</td> 
					</tr>
					@endforeach 
						@endforeach
				

                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection