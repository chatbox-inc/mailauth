<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/18
 * Time: 16:06
 */

namespace Chatbox\RestApp\Http\Controllers\Mail;


use Chatbox\Mailtoken\Http\MailTokenRequest;
use Chatbox\RestApp\Model\MailTokenTable;
use Chatbox\Token\Storage\Eloquent\TaggableEloquent;
use Chatbox\Token\Token;
use Chatbox\Token\TokenServiceInterface;
use Chatbox\ApiAuth\Http\Service\ProfileService;
use Chatbox\ApiAuth\Http\AuthRequest;

class RegisterMailtokenController extends AbstractMailTokenController
{
    function constructStorage():TaggableEloquent
    {
        return new class() extends MailTokenTable{
            protected $tag = "register";
        };
    }


    protected function handle(Token $token)
    {
        /** @var ProfileService $service */
        $service = app(ProfileService::class);
        /** @var AuthRequest $request */
        $request = app(AuthRequest::class);

        $user = $request->getUserDataForRegister();

        $user = $service->register(array_merge($user,$token->value));
        return [
            "user" => $user
        ];
    }


}