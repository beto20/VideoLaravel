<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Video;
use App\Comment;

class VideoController extends Controller
{
    public function createVideo(){
        return view('video.createVideo');
    }

    public function saveVideo(Request $request){
        $validatedData=$this->validate($request,[
            'title'=>'required|min:5',
            'description'=>'required',
            'video'=>'mimes:mp4'

        ]);
        //CREAR EL OBJETO 
        $video=new video();

        //CREAR LA VARIABLE USER PARA GUARDAR SU ID EN LA BD
        //USANDO EL OBJETO '\Auth' PARA CONSEGUIR EL USUARIO
        $user=\Auth::user();

        //SE SETEAN LAS PROPIEDADES DE VIDEO
        $video->user_id=$user->id;
        $video->title=$request->input('title');
        $video->description=$request->input('description');

        //SUBIDA DE IMAGEN
        //LAS IMAGENES SE GUARDAN EN LA CARPETA STORAGE
        //CREAR UNA VARIABLE 'image' Y RECOGER EL FICHERO
        $imagen=$request->file('imagen');
        if ($imagen) {
            //COGER EL NOMBRE DEL FICHERO TEMPORAL(PATH)
            //LA FUNCIION TIME() TE RETORNA DE CUANDO SE SUBIO LA IMAGEN
            $imagen_path=time().$imagen->getClientOriginalName();
            //USAR EL OBJETO 'storage' Y EL METODO 'disk()' PARA ALMACENAR EN LA CARPETA 'storage/app'
            //TODO SE GUARDA EN UNA CARPETA 'images', SE PASA EL NOMBRE DEL FICHERO
            \Storage::disk('images')->put($imagen_path, \File::get($imagen));
            //SETEAMOS EL NOMBRE DEL ARCHIVO GUARDADO EN EL DISCO DURO
            $video->imagen=$imagen_path;    
        }

        //SUBIDA DE VIDEO
        //CREAR VARIABLE 'video_file' RECOGEMOS FICHERO DE LA 'request'
        $video_file=$request->file('video');
        if ($video_file) {
            //CREAR VARIABLE 'video_path' 
            $video_path=time().$video_file->getClientOriginalName();
            //CON PUT PASAMOE EL NOMBRE DEL FICHERO
            \Storage::disk('videos')->put($video_path,\File::get($video_file));
            //SETEAR
            $video->video_path=$video_path;
        }

        //USAR METODO 'save()' EN EL OBJETO CREADO PARA GUARDAR EN LA BD
        $video->save();

        //REDIRIGIR LA RUTA AL INDEX 
        return redirect()->route('home')->with(array(
            'message'=>'El video se guardo correctamente'
        ));
    }


    //METODO PARA DEVOLVER LAS IMAGENES
    public function getImage($filename){
        //'storage' SIN LA BARRA ADELANTE PORQUE YA ESTA IMPORTADO
        $file=Storage::disk('images')->get($filename);
        //EL METODO 'Response' SE USA EN ESTE CASO PARA VALIDAR
        // SI DEVUELVE ALGO USANDO EL CODIGO 200(OK)
        return new Response($file,200);
    }


    public function getVideoDetail($video_id){
        //USANDO ELOQUENT ORM
        //CON LA FUNCION 'find()' BUSCAMOS EL ID EN LA BD
        //USANDO LA ENTIDAD 'Video'
        $video=Video::find($video_id);   
        return view('video.detail',array(
            'video'=>$video
        ));
    }


    public function getVideo($filename){
        $file=Storage::disk('videos')->get($filename);
        return new Response($file,200);
    }




}
