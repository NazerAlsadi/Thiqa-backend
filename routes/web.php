<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/'    , 'HomeController@index');
Route::get('/home'    , 'HomeController@index');
Route::get('/dashboard', 'DashboardController@index' )->middleware('auth');

Route::get('/management', 'ManagementController@index');



Auth::routes();

Route::resource('users' , 'UserController')->middleware('auth');

Route::resource('categories' , 'CategoryController')->middleware('auth');
Route::post('categories-handle' , 'CategoryController@handle')->middleware('auth');
Route::get('categories/{id}/delete','CategoryController@destroy')->middleware('auth');
Route::get('MainCategories', 'CategoryController@maincategories');
Route::get('subcategories/{id}', 'CategoryController@category_by_parent_cat_id');


Route::resource('advertises', 'AdvertiseController')->middleware('auth');

Route::get('agreement', 'SettingController@agreement');
Route::get('aboutUs', 'SettingController@aboutUs');
Route::get('contactUs', 'SettingController@contactUs');

Route::resource('posts' , 'PostController')->middleware('auth');
Route::post('posts-handle' , 'PostController@handle')->middleware('auth');
Route::get('posts/{id}/delete','PostController@destroy')->middleware('auth');
Route::get('posts/changePostStatus/{id}/{st}' , 'PostController@changeStatus')->middleware('auth');
Route::get('details/{id}', 'PostController@details');
Route::get('search', 'PostController@posts_search');
Route::get('postsByCategry/{id}', 'PostController@post_by_category');
Route::get('postsByGovernorate/{id}', 'PostController@post_by_governorate');

Route::get('post_review', 'ReviewController@post_review')->middleware('auth');
Route::get('comments_review', 'ReviewController@comments_review')->middleware('auth');
Route::get('images_review', 'ReviewController@images_review')->middleware('auth');

Route::resource('comments', 'CommentController')->middleware('auth');
Route::post('comments-handle' , 'CommentController@handle')->middleware('auth');
Route::get('comments/{id}/delete','CommentController@destroy')->middleware('auth');
Route::get('comments/changeCommentStatus/{id}/{st}' , 'CommentController@changeStatus')->middleware('auth');

Route::resource('pictures', 'PictureController')->middleware('auth');
Route::post('pictures-handle' , 'PictureController@handle')->middleware('auth');
Route::get('pictures/{id}/delete','PictureController@destroy')->middleware('auth');
Route::get('pictures/changePictureStatus/{id}/{st}' , 'PictureController@changeStatus')->middleware('auth');

Route::resource('settings', 'SettingController')->middleware('auth');
Route::get('sadmin', 'UserController@admins')->middleware('auth');

Route::get('addUpdateL1', 'CategoryController@addUpdateL1')->middleware('auth');
Route::get('addUpdateL2', 'CategoryController@addUpdateL2')->middleware('auth');
Route::get('chang-to-admin', 'UserController@changeToAdmin')->middleware('auth');
Route::get('changeToAdmin/{id}' , 'UserController@change')->middleware('auth');
Route::get('changeUserPass/{id}' , 'UserController@changePass')->middleware('auth');






