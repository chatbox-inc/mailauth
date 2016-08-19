<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/17
 * Time: 22:21
 */

namespace Chatbox\Mailtoken\Http;

use Chatbox\Mailtoken\MailTokenTrait;
use Chatbox\Token\Token;
use Chatbox\Mailtoken\MailTokenService;
use Chatbox\Token\TokenServiceInterface;

/**
 * 基本的にはコントローラで実装
 *
 * Class MailTokenController
 * @package Chatbox\Mailtoken\Http
 */
abstract class MailTokenController
{
    use MailTokenTrait;

    protected $request;
    protected $token;

    /**
     * TokenServiceInterfaceではDI自動解決出来ないので、
     * 継承してタイプヒントを実装に変更するか、
     * Setterを利用してextendする。
     * @param MailTokenRequest $request
     * @param TokenServiceInterface|null $token
     */
    public function __construct(
        MailTokenRequest $request,
        TokenServiceInterface $token = null
    ){
        $this->request = $request;
        $this->token = $token;
    }

    /**
     * @return TokenServiceInterface
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param TokenServiceInterface $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    protected function token():TokenServiceInterface
    {
        return $this->getToken();
    }


    public function send(){
        list($email,$data) = $this->request->mailaddress();
        $data["email"] = $email;
        $token = $this->mailtoken()->sendmail($email,$data);
        return $this->handleToken($token);
    }

    public function load(){
        $token = $this->request->token();
        $token = $this->mailtoken->load($token);
        return $this->handleToken($token);
    }

    protected function handleToken(Token $token){
        return [
            "token" => $token,
        ];
    }
}