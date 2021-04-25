@extends('layouts.admin_layout')

@section('title' , 'سجل الإضافات')

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
        <div class="container">
        <a href="{{url('/post_review')}}" class="btn btn-secondary" >المنشورات <span class="badge">{{$posts_temp->count()}}</span></a>
        <a href="{{url('/comments_review')}}" class="btn btn-secondary" >التعليقات <span class="badge">{{$comments_temp->count()}}</span></a>
        <a href="{{url('/images_review')}}" class="btn btn-success" >الصور <span class="badge">{{$pictures->count()}}</span></a>
        </div>
          <hr>
          <h4 class="card-title">صور  بحاجة الى تأكيد الإدارة</h4>
      </div>

{{-- -----------------------------Check all compunents ---------------------------------------------------- --}}

        <div class="card-body table-responsive">
          <form action="{{url('pictures-handle')}}" method="POST" id="main" name="main">
            {{@csrf_field()}}

            <div class="row" style="padding-right: 22px" >
                  <div>
                    <input type="checkbox"  name="" id="selectAll"><label  style="padding-left: 7px" for="exampleCheck1">تحديد الكل  </label>    
                    <button rel="tooltip" title="Remove" name = "remove" class="btn btn-primary  btn-link btn-sm checkAllIcon" onclick= " $('#method').val('remove');return confirm('هل انت متأكد من حذف التعليق ')" >
                      <i class="material-icons">clear</i>
                    </button>
                    <button rel="tooltip" title="Restore" name = "restore" class="btn btn-primary  btn-link btn-sm checkAllIcon" onclick= " $('#method').val('restore');return confirm('هل انت متأكد من استعادة التعليق')" >
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
                    <th>المنشور</th>
                    <th>الصورة</th>
                    <th>تاريخ النشر</th>
                    <th></th>
                </thead>
                <tbody>
               
                      @foreach($pictures as $picture)
                              <tr>
                                  <td><input type="checkbox" name="index[]" value="{{$picture->id}}"></td>
                                  <td>{{$picture->post->post_title}}</td>
                                  <td>
                                    <img src="\upload\post_imgs\{{$picture->picture_name}}" alt=""  height="200px">
                                  </td>
                                  <td>{{$picture->created_at}}</td>

                                  <td class="td-actions text-right">

                                      <a href="{{ route('pictures.show',$picture->id) }}" rel="tooltip" title="معاينة" class="btn btn-primary btn-link btn-sm">
                                          <i class="material-icons">remove_red_eye</i>
                                      </a>

                                      @if($picture->deleted_at)
                                      <a href="{{url('pictures/'.$picture->id.'/delete')}}"  rel="tooltip" title="Restore" class="btn btn-success  btn-link btn-sm" onclick="return confirm('Are you sure you want to delete {{$picture->post->post_title}}?')">
                                          <i class="material-icons">undo</i>
                                      </a>
                                      @else 
                                      <a href="{{url('pictures/'.$picture->id.'/delete')}}" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm" onclick="return confirm('Are you sure you want to delete {{$picture->post->post_title}}?')">
                                          <i class="material-icons">clear</i>
                                    </a>
                                    @endif	
                                  </td>  
                                    
                              </td>  
                          </tr>
                          @endforeach 
                </tbody>
            </table>
             {{ $pictures->links() }}
        </div>
    </div>
</div>


@endsection


