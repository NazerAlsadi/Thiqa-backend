@extends('layouts.admin_layout')

@section('title' , 'اضافة تصنيف جديد')

@section('content')

<div class="col-md-10">
<div class="card">
<div class="card-header card-header-primary">
  <h4 class="card-title">اضافة تصنيف جديد</h4>
  <p class="card-category">تصنيف فرعي يحوي العديد من التصنيفات الفرعية و يتبع لتصنيف رئيسي . </p>
</div>

	
	<div class="card-body" >

        <form method="POST" action="{{ route('categories.store')  }}" enctype="multipart/form-data" >
        {{ csrf_field() }}
   
        @if ($category->id)
        <div class="dropdown show">
            
            <label class="bmd-label-floating">اختر التصنيف الرئيسي</label>
            <select class="browser-default custom-select"  name="parent_cat_id" >
                <option value="{{$category->parent_cat_id}}">{{$category->get_name_category($category->parent_cat_id)}}</option>
                @foreach ($categories as $category_list)
                <option value="{{$category_list->id}}">{{$category_list->category_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <input type="hidden" class="form-control" name = "display_order" value = "{{($categories_max)}}">
        </div>

        <div class="form-group">
            <label class="bmd-label-floating">اسم التصنيف</label>
            <input type="text" class="form-control" name = "category_name" value = "{{$category->category_name}}">
            @error('category_name')
            <span class="invalid-feedback" role="alert" style="display: block">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="form-group">
            <label class="bmd-label-floating">الوصف</label>
            <input type="text" class="form-control" name = "description" value = "{{$category->description}}">
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" name = "id" value = "{{$category->id}}">
        </div>

        @else

        <div class="dropdown show">
            
            <label class="bmd-label-floating">اختر التصنيف الرئيسي</label>
            <select class="browser-default custom-select"  name="parent_cat_id" >
                @foreach ($categories as $category_list)
                <option value="{{$category_list->id}}">{{$category_list->category_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="bmd-label-floating">اسم التصنيف</label>
            <input type="text" class="form-control" name = "category_name">
            @error('category_name')
            <span class="invalid-feedback" role="alert" style="display: block">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="form-group">
            <label class="bmd-label-floating">الوصف</label>
            <input type="text" class="form-control" name = "description">
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" name = "display_order" value = {{($categories_max)+1}}>
        </div>

        @endif

        <button type="submit" class="btn btn-primary pull-right">حفظ التصنيف</button>

    
  </form>
</div>
</div>
</div>
@endsection