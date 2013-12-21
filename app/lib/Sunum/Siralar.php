<?php
/**
 * @author Arda Kılıçdağı
 */

namespace Sunum;

use Mail;

class Siralar {

    /**
     * Queue iron mq tarafından trigger edildiğinde çalışacak kod
     * @param $gorev
     * @param $data array eklenecek ekstra metin
     */
    public function fire($gorev, $data)
    {

        Mail::send('emails.template', $data, function($message) use($data)
        {
            $message->from('cevap-yok@laratest.com', 'Laravel Sunum')
                ->to($data['email'], $data['adSoyad'])
                ->subject($data['subject']);
        });

    }

}

