<?php

Route::group(['prefix' => 'test'], function () {
    // hello world
    Route::get('/', 'Controller@test');
    // 測試驗證
    Route::get('/validation', 'ExtendsController@create');
});
