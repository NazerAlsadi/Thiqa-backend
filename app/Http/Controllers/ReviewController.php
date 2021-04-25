<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Comment;
use App\User;
use App\Picture;
use App\Governorate;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {        
    }
    public function post_review(Request $request)
    {    
        $posts = Post::orderBy('created_at','DESC')->where('status', 'temp')->with('categories','users','governorates')->paginate(10);
        $pictures_temp = Picture::where('status', 'temp');
        $comments_temp = Comment::where('status', 'temp');
        return view('management.review.posts_review',compact('posts','request','pictures_temp','comments_temp'));
    }
    public function comments_review(Request $request)
    {        
        $pictures_temp = Picture::where('status', 'temp');
        $posts_temp = Post::where('status', 'temp');
        $comments = Comment::orderBy('created_at','DESC')->where('status', 'temp')->with('post','users')->paginate(10);
        return view('management.review.comments_review',compact('comments','request','pictures_temp','posts_temp'));
    }
    public function images_review(Request $request)
    {        
        $pictures = Picture::orderBy('created_at','DESC')->where('status', 'temp')->with('post')->paginate(10);
        $posts_temp = Post::where('status', 'temp');
        $comments_temp = Comment::where('status', 'temp');
        return view('management.review.images_review',compact('pictures','request','posts_temp','comments_temp'));
    }
}
