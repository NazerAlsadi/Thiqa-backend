<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $guarded = ['id'];
    public function post(){
    	
        return $this->belongsTo('App\Post','post_id');
    }

    public function users(){
    	
        return $this->belongsTo('App\User');
    }
}
