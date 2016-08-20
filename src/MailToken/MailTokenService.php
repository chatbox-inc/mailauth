<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/15
 * Time: 23:41
 */

namespace Chatbox\MailToken;

use Chatbox\Token\Token;
use Chatbox\Token\TokenServiceInterface;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Message;

/**
 * メールトークンに関する処理を組み込む
 * @package Chatbox\Mailtoken
 */
abstract class MailTokenService
{
//    protected $view;
//
//    protected $from;
//
//    protected $subject;

    protected $token;

    /**
     * MailToken constructor.
     * @param $token
     */
    public function __construct(TokenServiceInterface $token)
    {
        assert(!empty($this->view));
        assert(!empty($this->from));
        assert(!empty($this->subject));

        $this->token = $token;
    }

    public function sendmail($email,array $data):Token
    {
        $token = $this->token->save($data);
        $this->_sendmail($email,[
            "token" => $token,
            "data" => $data
        ]);
        return $token;
    }

    abstract protected function publishEmail($view,$data,$cb);

    protected function _sendmail($email,array $data){
        $this->publishEmail($this->view,$data,function(Message $m)use($email){
            $m->from($this->from);
            $m->to($email);
            $m->subject($this->subject);
        });
    }

    public function check($key):Token{
        $token = $this->token->load($key);
        return $token;
    }

    abstract public function handle(Token $token);

    public function delete(Token $token){
        $this->token->delete($token);
    }

}