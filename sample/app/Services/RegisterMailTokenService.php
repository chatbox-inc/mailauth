<?php
namespace App\Services;
use Chatbox\Token\Token;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/20
 * Time: 10:37
 */
class RegisterMailTokenService extends \Chatbox\MailAuth\Service\RegisterMailTokenService
{
    use CommonMailSetting;

    protected $view = "mail.auth.register";

    protected $subject = "新規登録について";


}