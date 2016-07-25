<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/25
 * Time: 6:05
 */

namespace Chatbox\MailAuth\Http\Controllers;

use Chatbox\MailAuth\MailAuthMailSenderInterface;
use Chatbox\Mailtoken\Http\MailTokenController;
use Chatbox\Mailtoken\Http\MailTokenRequest;
use Chatbox\Token\Token;
use Chatbox\Token\TokenService;
use Chatbox\Token\TokenServiceInterface;

abstract class AbstractMailController extends MailTokenController
{
    protected $sender;

    public function __construct(
        MailAuthMailSenderInterface $sender,
        TokenServiceInterface $token,
        MailTokenRequest $request)
    {
        $this->sender = $sender;

        $storage =
        $token = new TokenService($storage);
        parent::__construct($token, $request);
    }

    protected function sendmail($email, array $data)
    {
        $this->sender->send($email,$data);
    }

    protected function handleToken(Token $token)
    {
        // TODO: Implement handleToken() method.
    }

    protected function handleError(\Exception $e)
    {
        // TODO: Implement handleError() method.
    }


}