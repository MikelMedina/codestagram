<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

/**
 * Define un comando Artisan personalizado llamado 'inspire'
 * que muestra una cita inspiradora en la consola.
 * 
 * El comando utiliza la clase Inspiring para obtener una cita aleatoria
 * y la imprime como comentario en la salida de la consola.
 * 
 * Uso: php artisan inspire
 * 
 * @command inspire
 * @purpose Mostrar una cita inspiradora
 */
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

