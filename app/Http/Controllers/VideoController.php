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
            //LA FUNCIION TIME() ES UN NUMERO UNICO, 'time stamp'
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

    public function delete($video_id){
        //RECOGER EL USUARIO IDENTIFICADO
        $user=\Auth::user();
        //CAPTURAR EL VIDEO
        $video=Video::find($video_id);
        //CAPTURAR LOS COMENTARIOS
        $comments=Comment::where('video_id',$video_id)->get();
        //HACE VALIDACION
        if ($user && $video->user_id==$user->id) {
            //BORRADO DE COMENTARIOS
            if ($comments && count($comments)>=1) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }
            
            //BORRADO DE IMAGENES Y VIDEOS
            Storage::disk('images')->delete($video->imagen);
            Storage::disk('videos')->delete($video->video_path);
            //BORRADO DE REGISTRO
            $video->delete();
            $message=array('message'=>'Video eliminado');
            
        }else{
            $message=array('message'=>'Error');
        }

        return redirect()->route('home')->with($message);

    }

    public function edit($video_id){
        $user=\Auth::user();
        //EL METODO 'finOrFail()' ES EN CASO NO ENCUNTRE UN LOS BUSCADO
        //NO NOS RETORNE UN ERROR
        $video=Video::findOrFail($video_id);

        if ($user && $video->user_id==$user->id) {
            return view('video.edit',array(
                'video'=>$video
            ));
        }else{
            return redirect()->route('home');
        }

    }

    public function update($video_id,Request $request){
        $validate=$this->validate($request,[
            'title'=>'required|min:5',
            'description'=>'required',
            'video'=>'mimes:mp4'
        ]);
        $user=\Auth::user();
        $video=Video::findOrFail($video_id);
        $video->user_id=$user->id;
        $video->title=$request->input('title');
        $video->description=$request->input('description');

        //SACADO DEL METODO 'create'
        //SUBIDA DE IMAGEN
        $imagen=$request->file('imagen');
        if ($imagen) {
            //COGER EL NOMBRE DEL FICHERO TEMPORAL(PATH)
            //LA FUNCIION TIME() ES UN NUMERO UNICO, 'time stamp'
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

        $video->update();

        return redirect()->route('home')->with(array(
            'message'=>'Video actulizado'
        ));

    }

    public function search($search=null,$filter=null){

        if(is_null($search)) {
            $search=\Request::get('search');

            if (is_null($search)) {
                return redirect()->route('home');
            }
            //ELSE
            return redirect()->route('videoSearch',array(
                'search'=>$search
            ));

        }
        if (is_null($filter) && \Request::get('filter') && !is_null($search)) {
            $filter=\Request::get('filter');
            return redirect()->route('videoSearch',array(
                'search'=>$search,
                'filter'=>$filter
            ));
        }
        $column='id';
        $order='desc';

        if (!is_null($filter)) {
            if ($filter=='new') {
                $column='id';
                $order='desc';
        
            }
            if ($filter=='old') {
                $column='id';
                $order='asc';
        
            }
            if ($filter=='all') {
                $column='title';
                $order='asc';
        
            }
        }

        $videos=Video::where('title','LIKE','%'.$search.'%')->orderBy($column,$order)->paginate(5);
        return view('video.search',array(
            'videos'=>$videos,
            'search'=>$search
        ));
    }





}
