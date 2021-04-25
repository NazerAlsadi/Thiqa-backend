<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Country extends Model
{
    use SotDeletes;
    public function posts(){

        return $this->hasMany('App\Post');
    }

    public function categories(){

        return $this->hasMany('App\Category');
    }

    public function governorates(){

        return $this->hasMany('App\Governorate');
    }
    ////////////////

    public function pictures(){
    	
        return $this->belongsTo('App\Picture');
    }
}
