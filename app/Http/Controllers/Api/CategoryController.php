<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('display_order' , 'ASC')->get();
        return response()->json($categories);
    }

    public function show(category $category)
    {
        $category = Category::find($category->id);
        return response()->json($category);
    }

    public function store(Request $request)
    {
        
        // $this->validate(request() , [
        //    'picture_url' => 'image|mimes:jpg,jpeg,gif,png|max:2048',
        //    'country_id' => 'required',
        //    'parent_cat_id' => 'required',
        //    'category_name' => 'required',
        //    'description' => 'required',
        //    'display_order' => 'required',
        //  //  'status' => 'required',
          
        // ]);
        
        $category = new Category();
        
        if($request->picture_url){
            $img_name ='cat_' . time() . '.' . $request->picture_url->getClientOriginalExtension();
            $category->picture_url =  $img_name;
            $request->picture_url->move(public_path('upload/category_imgs'), $img_name);
        }
        
        $category->country_id = $request->country_id;
        $category->parent_cat_id = $request->parent_cat_id;
        $category->category_name = $request->category_name;
        $category->description = $request->description;
        $category->display_order = $request->display_order;
        $category->status = "Active";
        $category->save();

        return response()->json('added successfully');

    }
}
