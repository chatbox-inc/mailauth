<?php
namespace Chatbox\MailAuth\Http\Controllers;
use Chatbox\ApiAuth\Domains\UserServiceInterface;
use Chatbox\ApiAuth\Http\Request\ProfileForUpdate;
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
    public function __construct(RegisterMailTokenService $token)
    {
        parent::__construct($token);
    }


//    public function handle()
//    {
//        $key = $this->request->token();
//        $token = $this->token->check($key);
//
//        /** @var UserServiceInterface $api */
//        $user = app(UserServiceInterface::class);
//
//        $registerData = $profile->get();
//        $registerData["email"] = $token->value["email"];
//
//        $user = $user->registerProfile($registerData);
//        return [
//            "token" => $token,
//            "user" => $user,
//        ];
//
//    }
}