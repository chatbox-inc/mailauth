<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/20
 * Time: 10:39
 */

namespace App\Services;


use Illuminate\Contracts\Mail\Mailer;

trait CommonMailSetting
{
    protected $from = "info@chatbox-inc.com";


    protected function publishEmail($view, $data, $cb)
    {
        /** @var Mailer $mailer */
        $mailer = app("mailer");
        $mailer->send($view,$data,$cb);
    }


}