<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//MODEL_COMMENT

class Comment extends Model
{
    protected $table='comments';

    //RELACION DE MUCHOS a 1
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function video(){
        return $this->belongsTo('App\Video','video_id');
    }

}
