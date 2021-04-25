<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Governorate extends Model
{
    use SoftDeletes;
    public function posts(){

        return $this->hasMany('App\Post' , 'governorate_id');
    }

    ////////////////////////////

    public function pictures(){
    	
        return $this->belongsTo('App\Picture');
    }

    public function countries(){
    	
        return $this->belongsTo('App\Country');
    }
}
