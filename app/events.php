<?php

//Birinci Olay Örneği
Event::listen('olay.test1', function(){
    return 'birinci event tetiklendi';
});

//İkinci Olay Örneği
Event::listen('olay.test2', function($isim){
    return 'merhaba '.$isim.', ikinci event basari ile tetiklendi';
});


//Üçüncü Olay Örneği
//Dördüncü örnek sebebi ile yoruma dönüştürdük
//Event::listen('olay.test3', 'Sunum\Olaylar@tetikle');

