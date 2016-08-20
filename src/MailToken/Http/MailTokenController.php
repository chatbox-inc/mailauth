<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/17
 * Time: 22:21
 */

namespace Chatbox\MailToken\Http;

use Chatbox\MailToken\MailTokenTrait;
use Chatbox\Token\Token;
use Chatbox\MailToken\MailTokenService;

/**
 * 基本的にはコントローラで実装
 *
 * Class MailTokenController
 * @package Chatbox\Mailtoken\Http
 */
abstract class MailTokenController
{
    protected $request;
    /**
     * @var MailTokenService
     */
    protected $token;

    /**
     * @param MailTokenRequest $request
     * @param MailTokenService
     */
    public function __construct(
        MailTokenRequest $request,
        MailTokenService $token
    ){
        $this->request = $request;
        $this->token = $token;
    }

    public function send(){
        $data = $this->request->mailaddress();
        $token = $this->token->sendmail($data["email"],$data);
        return $this->handleToken($token);
    }

    public function load(){
        $key = $this->request->token();
        $token = $this->token->check($key);
        return $this->handleToken($token);
    }

    public function handle(){
        $key = $this->request->token();
        $token = $this->token->check($key);
        $response = $this->token->handle($token);
        return $response;
    }

    protected function handleToken(Token $token){
        return [
            "token" => $token,
        ];
    }
}