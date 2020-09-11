<?php
Route::group(['namespace' => 'Backend'], function(){
    Route::resource('category', 'CategoryController');
    Route::resource('menu', 'MenuController');

});