<?php namespace Sunum;

Class Olaylar {

    public function tetikle($isim){
            return 'merhaba '.$isim.', ucuncu event basari ile tetiklendi';
    }


    public function subscribe($events) {
        $events->listen('olay.test3', 'Sunum\Olaylar@tetikle');
    }

}

