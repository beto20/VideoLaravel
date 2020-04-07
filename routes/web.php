<?php

use Illuminate\Support\Facades\Route;
use App\Video;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   /* $videos= Video::all();
    foreach($videos as $video){
        echo $video->title.'</br>';
        echo $video->user->email.'</br>';
        //var_dump($video);
        foreach ($video->comments as $comment) {
            echo $comment->body;
        }
    }
    die();
    */
    return view('welcome');
});

Route::auth();
//LOS ARRAY COMO SEGUNDO PARAMETROS SON 
//PARA ASIGNAR NOMBRES(ALIAS)
Route::get('/home',array(
    'as'=>'home',
    'uses'=>'HomeController@index'
));



/*
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
*/

//RUTAS DEL CONTROLADOR DE VIDEOS
Route::get('/crear-video',array(
    'as'=>'createVideo',
    'middleware'=>'auth',
    'uses'=> 'VideoController@createVideo'
));


Route::post('/guardar-video',array(
    'as'=>'saveVideo',
    'middleware'=>'auth',
    'uses'=> 'VideoController@saveVideo'
));

//'filename' COMO PARAMETRO OBLIGATORIO
Route::get('/miniatura/{filename}',array(
    'as'=>'imageVideo',
    'uses'=>'VideoController@getImage'
));

Route::get('/video/{video_id}',array(
    'as'=>'detailVideo',
    'uses'=>'VideoController@getVideoDetail'
));

Route::get('/video-file/{filename}',array(
    'as'=>'fileVideo',
    'uses'=>'VideoController@getVideo'
));

Route::post('/comment',array(
    'as'=>'comment',
    //MIDDLEWARE PARA AUTENTIFICACION
    'middleware'=>'auth',
    'uses'=>'CommentController@store'
));



