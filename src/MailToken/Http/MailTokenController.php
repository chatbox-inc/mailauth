<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/17
 * Time: 22:21
 */

namespace Chatbox\MailToken\Http;

use Chatbox\MailToken\Http\Request\MailAddress;
use Chatbox\MailToken\Http\Request\MailToken;
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
    /**
     * @var MailTokenService
     */
    protected $token;

    /**
     * @param MailTokenRequest $request
     * @param MailTokenService
     */
    public function __construct(
        MailTokenService $token
    ){
        $this->token = $token;
    }

    public function send(MailAddress $mailAddress){
        $data = $mailAddress->get();
        $token = $this->token->sendmail($data["email"],$data);
        return $this->handleToken($token);
    }

    public function load(MailToken $mailToken){
        $key = $mailToken->get();
        $token = $this->token->check($key);
        return $this->handleToken($token);
    }

    public function handle(MailToken $mailToken){
        $key = $mailToken->get();
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