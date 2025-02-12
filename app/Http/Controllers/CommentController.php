<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Comment;

class CommentController extends Controller
{   
    public function store(Request $request){
        //VALIDACION DE FORMULARIO
        // SE LE PASA LOS DATOS DE LA 'request'
        //LA INFORMACION DEL 'body' es 'requerida'
        $validate=$this->validate($request,[
            'body'=>'required'
        ]);
        //CREAR UN NUEVO OBJETO de 'comment()'
        $comment=new Comment();
        //UNA VARIABLE 'user' PARA EL USUARIO IDENTIFICADO
        $user=\Auth::user();
        //SE ESTA USANDO ELOQUENT
        $comment->user_id=$user->id;
        $comment->video_id=$request->input('video_id');
        $comment->body=$request->input('body');

        $comment->save();
        return redirect()->route('detailVideo',['video_id'=>$comment->video_id])->with(array(
            'message'=>'Comentario añadido'

        ));
    }

    public function delete($comment_id){
        //CONSEGUIR EL USUAIRO IDENTIFICADO
        $user=\Auth::user();
        //BUSCAR COMENTARIO
        $comment=Comment::find($comment_id);
        //COMPROBAR SI EL USUARIO EXISTE Y EL ES DUEÑO DEL VIDEO
        if ($user&&($comment->user_id==$user->id||$comment->video->user_id==$user->id)) {
            $comment->delete();
        }

        return redirect()->route('detailVideo',['video_id'=>$comment->video_id])->with(array(
            'message'=>'Comentario eliminado'
        ));
    }





}
