<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comments';

    //RELACION DE MUCHOS a 1
    public function user(){
        return $this->belongsTo('App\User','uder_id');
    }
}
