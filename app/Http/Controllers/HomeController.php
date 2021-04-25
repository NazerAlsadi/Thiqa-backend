<?php

namespace App\Http\Controllers;
use App\Category;
use App\Governorate;
use App\Post;
use App\Setting; 
use App\Picture;
use App\Advertise;


use \Illuminate\Support\Str;


use Illuminate\Http\Request;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $governorates = Governorate::all();
        $sub_categories = Category::where('parent_cat_id','!=', 0)->get();
        $posts = Post::where('status','!=', 'unpublish')->with('categories','users','governorates','pictures')->paginate(10);
        $advertises = Advertise::where('type', 'web')->where('position', 'main')->get();
        $four_categories =Category::inRandomOrder()->where('parent_cat_id', 0)->where('id','!=', 1)->limit(4)->get();
        $settings = Setting ::first();
        return view('home', compact('sub_categories' , 'governorates' , 'posts' ,'four_categories','settings','advertises'));
    }
}
