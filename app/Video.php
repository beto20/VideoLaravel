<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


//MDOEL_VIDEO

class Video extends Model
{
    protected $table='videos';
    //RELACION DE 1 A MUCHOS
    public function comments(){
        return $this->hasMany('App\Comment')->orderBy('id','desc');
    }

    //RELACION DE MUCHOS a 1
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }


}
