<?php
Route::group(['namespace' => 'Categorias'], function() {
    // views
    Route::group(['prefix' => 'categorias'], function() {
        Route::view('/', 'categorias.index');
        Route::view('/create', 'categorias.create');
        Route::view('/{categoria}/edit', 'categorias.edit');
    });

    // api
    Route::group(['prefix' => 'api/categorias'], function() {
        Route::get('/count/{status}', 'CategoriasController@count');
        Route::post('/filter', 'CategoriasController@filter');

        Route::get('/{categoria}', 'CategoriasController@show');
        Route::post('/store', 'CategoriasController@store');
        Route::put('/update/{categoria}', 'CategoriasController@update');
        Route::delete('/{categoria}', 'CategoriasController@destroy');
    });
});

