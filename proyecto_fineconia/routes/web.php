<?php

use Illuminate\Support\Facades\Route;

Route::get('/resources/css/{file}', function ($file) {
    $path = resource_path('css/'.$file);
    
    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path, [
        'Content-Type' => 'text/css'
    ]);
})->where('file', '.*\.css$');

Route::get('/', function () {
    return view('REGRISTRO');

});
