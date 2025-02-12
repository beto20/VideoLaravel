<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /*
        //PRIMERA FORMA UASNDO EL QUERY BUILDER
        //EL METODO 'paginate(#)' ES PARA MOSTRAR LA CANTIDAD
        // DE ITEMS POR PAGINA
        $videos=DB::table('videos')->paginate(5);
        */

        //IMPORTANDO: use App\Video;
        $videos=Video::orderBy('id','desc')->paginate(5);



        return view('home',array(
            'videos'=>$videos
        ));
    }
}
