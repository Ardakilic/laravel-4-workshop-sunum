<?php

class SunumController extends BaseController {

    /**
     * Örnek 4 için, subscribe edilmiş olayları controller'da aktif ediyoruz:
     */
    public function __construct() {
        Event::subscribe('Sunum\Olaylar');
    }

    /**
     * Event'lerin kullanılmadığı durumu göstermek amacı ile kodlandı
     * Sunum boyunca işlevi yok bu metodun
     * @return \Illuminate\Http\RedirectResponse
     */
    public function kayitDeneme()
    {
        //Eğer bu bir post metodu olsaydı gerçek hayatta işlemler şunlara benzer olacaktı:

        //AŞAMA 1. FORM DOĞRULAMA
        $validation = Validator::make(Input::all(), User::$addRules);

        if($validation->passes()) {

            //AŞAMA 2: ÜYE OLUŞTURMA
            User::create(array(
                'firstName'     => Input::get('firstName'),
                'lastName'      => Input::get('lastName'),
                'email'         => Input::get('email'),
                'password'      => Hash::make(Input::get('password'))
            ));

            //AŞAMA 3: EPOSTA GÖNDERİMİ (kayıt linki, hoş geldiniz mesajı vs.)
            $data = array(
                'view'          => 'emails.welcome',
                'firstName'     => Input::get('firstName'),
                'lastName'      => Input::get('lastName'),
                'email'         => Input::get('email'),
                'password'      => Hash::make(Input::get('password')),
                'subject'       => Lang::get('welcomeToOurSite')
            );

            Mail::send($data['view'], $data, function($message)
            {
                $message
                    ->to($data['email'], $data['first_name'].' '.$data['last_name'])
                    ->subject($data['subject']);
            });

            //AŞAMA 4: EBÜLTENE KAYIT ETME

            //burası classa göre değişecek, ama en az 3-4 satır sürecek bir kod betiği

            //AŞAMA 4: KULLANICIYI BAŞARILI SAYFASINA DÖNDÜRME
            return Redirect::route('basariliKayit')
                ->withSuccess('Sitemize başarı ile kayıt oldunuz');

        //form doğrulamadan geçememiş
        } else {
            return Redirect::back()
                ->withInput()
                ->withErrors($validation);
        }
    }

    /**
     * Birinci olay denemesi metodu
     * @return array|null
     */
    public function olayTest1()
    {
        return Event::fire('olay.test1');
    }

    /**
     * İkinci olay denemesi metodu
     * @return array|null
     */
    public function olayTest2()
    {
        return Event::fire('olay.test2','Arda Kilicdagi');
    }

    /**
     * Üçüncü olay denemesi metodu
     * @return array|null
     */
    public function olayTest3()
    {
        return Event::fire('olay.test3','Arda Kilicdagi');
    }

    /**
     * Dördüncü olay denemesi metodu
     * @return array|null
     */
    public function olayTest4()
    {
        Event::subscribe('Sunum\Olaylar');
    }

    ///////////////////////////////////////////
    ///KUYRUKLAR///////////////////////////////
    ///////////////////////////////////////////

    /**
     * Gelen Iron.io Queue'yu tetikler
     */
    public function kuyrukDeneme()
    {
        return Queue::marshal();
    }


    /**
     * Kuyruk tetikleyen birinci metod
     * @return null
     */
    public function kuyrukTetik1()
    {

        //view, ve email ile alakalı veriler
        $data = array(
            'email'     => 'ardakilicdagi@gmail.com',
            'adSoyad'   => 'Arda Kılıçdağı',
            'subject'   => 'Merhaba!',
            'title'     => 'Hoş Geldiniz!',
            'body'      => 'Sitemize Hoş Geldiniz'
        );

       Queue::push(function() use ($data)
       {

           Mail::send('emails.template', $data, function($message) use($data)
           {
               $message->from('cevap-yok@laratest.com', 'Laravel Sunum')
                   ->to($data['email'], $data['adSoyad'])
                   ->subject($data['subject']);
           });


       });
    }

    /**
     * Kuyruk tetikleyen ikinci metod
     * @return null
     */
    public function kuyrukTetik2()
    {

        //view, ve email ile alakalı veriler
        $data = array(
            'email'     => 'ardakilicdagi@gmail.com',
            'adSoyad'   => 'Arda Kılıçdağı',
            'subject'   => 'Merhaba!',
            'title'     => 'Hoş Geldiniz!',
            'body'      => 'Classy Sitemize Hoş Geldiniz<br /><img src="http://i.imgur.com/Da4lNKi.jpg" />'
        );

        Queue::push('Sunum\Siralar', $data);
    }

}
