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
    return view('welcome');
});

Route::auth();
//LOS ARRAY COMO SEGUNDO PARAMETROS SON 
//PARA ASIGNAR NOMBRES(ALIAS)
Route::get('/',array(
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

Route::get('/delete-comment/{comment_id}',array(
    'as'=>'commentDelete',
    'middleware'=>'auth',
    'uses'=>'CommentController@delete'
));

Route::get('/delete-video/{video_id}',array(
    'as'=>'videoDelete',
    'middleware'=>'auth',
    'uses'=>'VideoController@delete'
));



Route::get('/editar-video/{video_id}',array(
    'as'=>'videoEdit',
    'middleware'=>'auth',
    'uses'=>'VideoController@edit'
));


Route::post('/update-video/{video_id}',array(
    'as'=>'updateVideo',
    'middleware'=>'auth',
    'uses'=>'VideoController@update'
));


Route::get('/buscar/{search?}/{filter?}',[
    'as'=>'videoSearch',
    'uses'=>'VideoController@search'
]);

//PARA BORRAR LA MEMORIA CACHE Y NO SE TRABE
Route::get('/clear-cache',function(){
    $code=Artisan::call('cache:clear');
});

//USUARIO
Route::get('/canal/{user_id}',array(
    'as'=>'channel',
    'uses'=>'UserController@channel'
));




