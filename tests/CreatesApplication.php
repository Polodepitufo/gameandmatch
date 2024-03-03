<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;

trait CreatesApplication
{
    /**
     * Crea una instancia de la aplicación para la ejecución de las pruebas
     */
    public function createApplication(): Application
    {
        $app = require __DIR__ . '/../bootstrap/app.php';
        // Inicia y bootea el kernel de la aplicación.
        $app->make(Kernel::class)->bootstrap();
        //Devuelve la instancia de la aplicación creada
        return $app;
    }
}
