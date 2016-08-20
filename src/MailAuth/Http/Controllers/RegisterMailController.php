<?php
namespace Chatbox\MailAuth\Http\Controllers;
use Chatbox\ApiAuth\Domains\UserServiceInterface;
use Chatbox\ApiAuth\Http\AuthRequest;
use Chatbox\MailAuth\Service\RegisterMailTokenService;
use Chatbox\MailToken\Http\MailTokenRequest;

use Chatbox\ApiAuth\ApiAuthService;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/25
 * Time: 6:04
 */
class RegisterMailController extends AbstractMailController
{
    public function __construct(MailTokenRequest $request, RegisterMailTokenService $token)
    {
        parent::__construct($request, $token);
    }


    public function handle()
    {
        $key = $this->request->token();
        $token = $this->token->check($key);

        /** @var UserServiceInterface $api */
        $user = app(UserServiceInterface::class);
        /** @var AuthRequest $req */
        $req = app(AuthRequest::class);

        $registerData = $req->getUserDataForRegister();
        $registerData["email"] = $token->value["email"];

        $user = $user->registerProfile($registerData);
        return [
            "token" => $token,
            "user" => $user,
        ];

    }
}