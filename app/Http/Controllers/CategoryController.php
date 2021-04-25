<?php

namespace App\Http\Controllers;

use App\Category;
use App\Governorate;
use App\Setting; 
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $categories = Category::where('parent_cat_id', 0)->where('category_name', 'LIKE', '%' . $request->input . '%')->orWhereHas('sub',function($q)use ($request){ return $q->where('category_name', 'LIKE', '%' . $request->input . '%');})->orderby('created_at','DESC')->with(['sub'=>function($q) use($request){
            return $q->where('category_name', 'LIKE', '%' . $request->input . '%');
            },'parent'])->paginate(10);

        if($request->withTrashed == "1" )
        {
            $categories = Category::where('parent_cat_id', 0)->where('category_name', 'LIKE', '%' . $request->input . '%')->orWhereHas('sub',function($q)use ($request){ return $q->where('category_name', 'LIKE', '%' . $request->input . '%')->withTrashed();})->orderby('created_at','DESC')->with(['sub'=>function($q) use($request){
            return $q->where('category_name', 'LIKE', '%' . $request->input . '%')->withTrashed();
            },'parent'])->withTrashed()->paginate(10);
        }
        return view('management.categories.index' , compact('categories','request'));       
    }

    public function maincategories()
    {
        $governorates = Governorate::all();
        $sub_categories = Category::where('parent_cat_id','!=', 0)->get();
        $settings = Setting ::first();

        $categories = Category::where('parent_cat_id', 0)->where('id','!=', 1)->get();
        return view('web.categories.mainCategories' ,  compact('governorates','sub_categories','categories','settings')); 
    }
    public function category_by_parent_cat_id( $parent_cat_id)
    {       
        $settings = Setting ::first(); 
        $governorates = Governorate::all();
        $main_category = Category::where('id',$parent_cat_id)->first();
        $sub_categories = Category::where('parent_cat_id','!=', 0)->get();
        $categories = Category::where('parent_cat_id', $parent_cat_id)->get();
        return view('web.categories.subCategories' ,  compact('governorates','sub_categories','categories','settings','main_category')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management.categories.create');
    }

    public function addUpdateL1()
    {
        $categories_max=Category::max('display_order'); 
        $category = new Category;
        return view('management.categories.addUpdateL1',compact('categories_max' , 'category'));
    }

    public function addUpdateL2()
    {
        $category = new Category;
        $categories_max=Category::max('display_order');
        $categories=Category::where('parent_cat_id', 0)->get();
        return view('management.categories.addUpdateL2',compact('category','categories_max', 'categories'));
    }

    public function addUpdateL3()
    {
        $categories_max=Category::max('display_order');
        $categories=Category::where('parent_cat_id', 0)->get();
        $categories_selected =[];
        return view('management.categories.addUpdateL3',compact('categories_max', 'categories','categories_selected'));
    }
    public function addUpdateL3_parent($id)
    {
        $categories_max=Category::max('display_order');
        $categories=Category::where('parent_cat_id', 0)->get();
        $categories_selected =Category::where('parent_cat_id', $id)->get();
        return view('management.categories.addUpdateL3',compact('categories_max', 'categories','categories_selected'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->id)
        {   
            $categories=Category::find($request->id);
            $categories->id = $request->id;
        }
        else
        {
            $categories=new Category;
        }
        
        $validatedData = $request->validate([
            'category_name' =>'required|max:50'
        ]);

      
       if($request->picture_url){
            $img_name ='cat_' . time() . '.' . $request->picture_url->getClientOriginalExtension() ;
            $categories->picture_id =  $img_name;
            $request->picture_url->move(public_path('/upload/category'), $img_name);
        }
       
        $categories->country_id="1";
        $categories->parent_cat_id=$request->parent_cat_id;
        $categories->category_name=$request->category_name;
        $categories->description=$request->description;
        $categories->display_order=$request->display_order;
        $categories->status="Active";
        $categories->save();

        $categories = Category::where('id', '!=' , 1)->get()->sortBy("status")->sortBy("parent_cat_id");
        return redirect('categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $category=Category::find($id);
        $categories_max=$category->display_order;
        $categories=Category::where('parent_cat_id', 0)->get();
        if($category->parent_cat_id == 0)
        {
            return view('management.categories.addUpdateL1',compact( 'category' , 'categories_max'));
        }
        else{

            return view('management.categories.addUpdateL2',compact( 'category', 'categories_max' , 'categories'));
        }
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::where('id',$id)->first();
        if($category)
        {
            $category->delete();
            return back();
        }
        else
        {
            $category=Category::withTrashed()->find($id);
            $category->restore();
            return back();   
        }
        return back();   
    }

    public function handle(Request $request)
    {        
       if ($request->method == "remove")
       {
           foreach($request->index as $id)
           {
               $category=Category::where('id',$id)->first();
               if($category)
               {
                   $category->delete();
               }
           }
       }
       elseif ($request->method == "restore")
       {
           foreach($request->index as $id)
           {
               $category=Category::withTrashed()->find($id);
               if($category)
               {
                   $category->restore();
               }
           }
       }
      
       return redirect('/categories');
   
    }
}
