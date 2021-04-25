<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    public function sub (){
        return $this->hasMany("App\Category",'parent_cat_id');
    }

    public function posts(){

        return $this->hasMany('App\Post');
    }

    public function advertises(){

        return $this->hasMany('App\Advertise');
    }

    public function parent (){
        return $this->belongsTo("App\Category",'parent_cat_id');
    }
    //////////////////////

    public function pictures(){
    	
        return $this->belongsTo('App\Picture');
    }

    public function countries(){
    	
        return $this->belongsTo('App\Country');
    }

    public function get_name_category($id){
    	
        $category=Category::find($id);
        $category_name = $category->category_name;
        return $category_name;
    }

}
