<?php
namespace Chatbox\ApiAuth\Http\Controllers;
use Chatbox\ApiAuth\Domains\UserServiceInterface;
use Chatbox\ApiAuth\Http\AuthRequest;
use Chatbox\ApiAuth\Http\Service\HttpTokenService;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/06/17
 * Time: 14:42
 */
class LoginController
{
    protected $request;
    protected $service;

    /**
     * TokenController constructor.
     * @param $request
     * @param $service
     */
    public function __construct(
        AuthRequest $request,
        UserServiceInterface $service)
    {
        $this->request = $request;
        $this->service = $service;
    }


    public function login()
    {
        $cred = $this->request->getCredential();
        $user = $this->service->loadProfileByCredential($cred);
        $token = $this->service->serialize($user);
        return [
            "token" => $token,
        ];
    }

    public function logout()
    {
        $token = $this->request->getToken();
        $this->service->forget($token);
        return [];
    }

}