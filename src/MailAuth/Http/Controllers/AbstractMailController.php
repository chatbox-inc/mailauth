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

}