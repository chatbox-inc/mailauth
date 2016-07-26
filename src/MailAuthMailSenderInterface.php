<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/25
 * Time: 6:13
 */

namespace Chatbox\MailAuth;


interface MailAuthMailSenderInterface
{
    public function send($type,$email,array $data);

}