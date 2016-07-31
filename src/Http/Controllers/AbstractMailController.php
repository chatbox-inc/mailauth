<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/25
 * Time: 6:05
 */

namespace Chatbox\MailAuth\Http\Controllers;

use Chatbox\MailAuth\MailAuthMailSenderInterface;
use Chatbox\MailAuth\MailTokenService;
use Chatbox\Mailtoken\Http\MailTokenController;
use Chatbox\Mailtoken\Http\MailTokenRequest;
use Chatbox\Token\Storage\DB\TaggableDB;
use Chatbox\Token\Token;
use Chatbox\Token\TokenService;
use Chatbox\Token\TokenServiceInterface;

abstract class AbstractMailController extends MailTokenController
{
    protected $type;

    protected $sender;

    public function __construct(
        MailAuthMailSenderInterface $sender,
        MailTokenService $token,
        MailTokenRequest $request)
    {
        $this->sender = $sender;
        $token->setTag($this->type);
        parent::__construct($token, $request);
    }

    protected function sendmail($email, array $data)
    {
        $this->sender->send($this->type,$email,$data);
    }

    protected function handleToken(Token $token)
    {
        return [
            "token" => [
                "key" => $token->key,
                "value" => $token->value
            ]
        ];
    }

    protected function handleError(\Exception $e)
    {
        throw $e;
    }
}