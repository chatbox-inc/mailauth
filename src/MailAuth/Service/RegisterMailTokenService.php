<?php
namespace Chatbox\MailAuth\Service;
use Chatbox\ApiAuth\Domains\UserServiceInterface;
use Chatbox\ApiAuth\Http\Request\ProfileForRegister;
use Chatbox\MailToken\MailTokenService;
use Chatbox\Token\Token;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/19
 * Time: 19:40
 */
abstract class RegisterMailTokenService extends MailTokenService
{
    public function handle(Token $token)
    {

        $profile = app(ProfileForRegister::class);
        $user = app(UserServiceInterface::class);

        $registerData = $profile->get();
        $registerData["email"] = $token->value["email"];

        $user = $user->registerProfile($registerData);
        return [
            "token" => $token,
            "user" => $user,
        ];
    }


}