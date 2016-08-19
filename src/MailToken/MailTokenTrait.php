<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/15
 * Time: 23:41
 */

namespace Chatbox\Mailtoken;

use Chatbox\Mailtoken\Http\MailTokenControllerTrait;
use Chatbox\Mailtoken\Http\MailTokenRequest;
use Chatbox\Token\Token;
use Chatbox\Token\TokenServiceInterface;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Message;

trait MailTokenTrait
{
    abstract protected function token():TokenServiceInterface;

    public function sendmail($email,array $data):Token
    {
        $token = $this->token()->save($data);
        $this->_sendmail($email,[
            "token" => $token,
            "data" => $data
        ]);
        return $token;
    }

    protected function _sendmail($email,array $data){
        /** @var Mailer $app */
        $app = app("mailer");
        $app->send("mail.auth",$data,function(Message $m)use($email){
            $m->from("info@chatbox-inc.com");
            $m->to($email);
            $m->subject("メールトークンサービスからのお知らせ");
        });
    }

    public function check($key){
        $token = $this->token()->load($key);
        return $token;
    }

}