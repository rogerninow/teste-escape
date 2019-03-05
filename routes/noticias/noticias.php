<?php
Route::group(['namespace' => 'Noticias'], function() {
    // views
    Route::group(['prefix' => 'noticias'], function() {
        Route::view('/', 'noticias.index');
    });

    // api
    Route::group(['prefix' => 'api/noticias'], function() {
        Route::get('/count/{status}', 'NoticiasController@count');
        Route::post('/filter', 'NoticiasController@filter');

        Route::get('/{noticia}', 'NoticiasController@show');
        Route::post('/store', 'NoticiasController@store');
        Route::put('/update/{noticia}', 'NoticiasController@update');
        Route::delete('/{noticia}', 'NoticiasController@destroy');
    });
});

