<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register' , 'Api\AuthController@register');

Route::post('login' , 'Api\AuthController@login');

Route::post('verified' , 'Api\AuthController@verified');

Route::middleware('auth:api')->post('logout' , 'Api\AuthController@logout');

Route::resource('advertises' , 'Api\AdvertiseController');
Route::resource('messages' , 'Api\MessageController');
Route::resource('categories' , 'Api\CategoryController');
Route::resource('posts' , 'Api\PostController');

Route::get('get-posts/{id}/{gov}' , 'Api\PostController@posts_by_catid');
//Route::get('get-posts/{id}' , 'Api\PostController@posts_by_catid');

Route::get('posts-category/{id}/{gov}' , 'Api\PostController@posts_by_cat');

Route::get('change_post_st/{id}' , 'Api\PostController@change_post_st');

Route::get('search-posts/{input}' , 'Api\PostController@posts_search');
Route::post('make-rating','Api\PostController@rate');
Route::post('update-name','Api\AuthController@update_name');
Route::get('user-posts' , 'Api\PostController@user_posts');

Route::resource('comments' , 'Api\CommentController');
Route::resource('governorates' , 'Api\GovernorateController');
Route::resource('favorites' , 'Api\FavoriteController');
Route::resource('settings' , 'Api\SettingController');

Route::get('get-favorites/{id}' , 'Api\FavoriteController@favorites_by_user_id');
Route::get('get_messages/{id}' , 'Api\MessageController@get_messages');
Route::get('readed_at/{id}', 'Api\MessageController@readed_at');
// Route::get('get-posts/{id}' , 'Api\PostController@posts_by_user_id');

Route::resource('imgs' , 'Api\ImgController');


Route::group(['middleware' => 'auth:api'] , function(){

    
  
});