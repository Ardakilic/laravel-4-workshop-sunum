<?php

Route::get('/', function(){
   return View::make('hello');
});

//Olaylar, Örnek 1
Route::get('olay/test1', 'SunumController@olayTest1');

//Olaylar, Örnek 2
Route::get('olay/test2', 'SunumController@olayTest2');

//Olaylar, Örnek 3
Route::get('olay/test3', 'SunumController@olayTest3');

//olaylar, Örnek 4
Route::get('olay/test4', 'SunumController@olayTest4');


//Kuyruklar, Aşama 1: Iron MQ'nun tetikleyeceği post resource
Route::post('kuyruk/deneme', 'SunumController@kuyrukDeneme');

//Kuyruklar, Aşama 2: Birinci Kuyruk tetiği
Route::get('kuyruk/tetik1', 'SunumController@kuyrukTetik1');

//Kuyruklar, Aşama 2: İkinci Kuyruk tetiği
Route::get('kuyruk/tetik2', 'SunumController@kuyrukTetik2');
