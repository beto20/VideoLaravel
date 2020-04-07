<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FormatTimeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //'app_path()' ES UNA FUNCION PARA SACAR LA RUTA ABSOLUTA
        // DE CUALQUIER ARCHIVO DEL CODIGO
        require_once app_path().'/Helpers/FormatTime.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
