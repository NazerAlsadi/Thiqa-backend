<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use SoftDeletes;
    protected $appends = array('up_rating','down_rating','favorite_list');
    
    public function comments(){

        return $this->hasMany('App\Comment','post_id');
    }

    public function favorites(){

        return $this->hasMany('App\Favorite');
    }
    public function getFavoriteListAttribute()
    {
        return $this->favorites()->pluck('user_id');
    }

    public function pictures(){

        return $this->hasMany('App\Picture');
    }
    public function rating()
    {
        return $this->hasMany('App\Rate');
    }
    public function getUpRatingAttribute()
    {
        return $this->rating()->where('rate_up',1)->count();
        
    }
    public function getDownRatingAttribute()
    {
        return $this->rating()->where('rate_down',1)->count();
        
    }
    
    /////////////////////////////////////////////////////

    public function categories(){

        return $this->belongsTo('App\Category','category_id');
    }

    public function countries(){
    	
        return $this->belongsTo('App\Country');
    }

    public function governorates(){
    	
        return $this->belongsTo('App\Governorate' ,'governorate_id');
    }

    public function users(){
    	
        return $this->belongsTo('App\User' , 'user_id');
    }
}
