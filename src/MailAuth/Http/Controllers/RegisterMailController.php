<?php
namespace Chatbox\MailAuth\Http\Controllers;
use Chatbox\ApiAuth\Http\AuthRequest;
use Chatbox\Token\Token;

use Chatbox\ApiAuth\Domains\UserServiceInterface;
use Chatbox\ApiAuth\ApiAuthService;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/25
 * Time: 6:04
 */
class RegisterMailController extends AbstractMailController
{


    protected function handle(Token $token)
    {
        /** @var ApiAuthService $api */
        $api = app(ApiAuthService::class);
        /** @var AuthRequest $req */
        $req = app(AuthRequest::class);

        $registerData = $req->getUserDataForRegister();
        $registerData["email"] = $token->value["email"];

        $user = $api->user()->registerProfile($registerData);
        return [
            "token" => $token,
            "user" => $user,
        ];

    }
}