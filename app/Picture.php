<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Picture extends Model
{
    use SoftDeletes;
    public function advertises(){

        return $this->hasMany('App\Advertise');
    }

    public function governorates(){

        return $this->hasMany('App\Governorate');
    }

    public function countries(){

        return $this->hasMany('App\Country');
    }

    public function categories(){

        return $this->hasMany('App\Category');
    }

    ////////////////////////
    public function post(){
    	
        return $this->belongsTo('App\Post');
    }

    


}
