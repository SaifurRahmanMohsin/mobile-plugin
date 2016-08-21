<?php

Route::group(['prefix' => 'api/v1'], function () {
    Route::resource('installs', 'Tempestronics\Mobile\Http\Installs');
});
