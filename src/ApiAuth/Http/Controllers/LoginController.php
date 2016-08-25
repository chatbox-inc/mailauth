<?php
namespace Chatbox\ApiAuth\Http\Controllers;
use Chatbox\ApiAuth\Domains\UserServiceInterface;
use Chatbox\ApiAuth\Http\Request\AuthToken;
use Chatbox\ApiAuth\Http\Request\Credential;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/06/17
 * Time: 14:42
 */
class LoginController
{
    protected $service;

    /**
     * TokenController constructor.
     * @param $request
     * @param $service
     */
    public function __construct(
        UserServiceInterface $service)
    {
        $this->service = $service;
    }


    public function login(Credential $credential)
    {
        $cred = $credential->get();
        $user = $this->service->loadProfileByCredential($cred);
        $token = $this->service->serialize($user);
        return [
            "token" => $token,
        ];
    }

    public function logout(AuthToken $token)
    {
        $token = $token->get();
        $this->service->forget($token);
        return [];
    }

}