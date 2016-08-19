<?php
namespace Chatbox\ApiAuth\Http\Controllers;
use Chatbox\ApiAuth\Domains\User;
use Chatbox\ApiAuth\Domains\UserServiceInterface;
use Chatbox\ApiAuth\Http\AuthRequest;
use Chatbox\ApiAuth\Http\Service\HttpProfileService;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/06/17
 * Time: 14:42
 */
class ProfileController
{

    protected $request;

    protected $service;

    /**
     * ProfileController constructor.
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

    public function create()
    {
        $user = $this->request->getUserDataForRegister();
        $user = $this->service->registerProfile($user);
        return [
            "user" => $user
        ];
    }

    public function load(){
        $user = $this->unpackToken();
        $user = $this->service->loadProfileById($user->userId);
        return [
            "user" => $user
        ];
    }

    public function update(){
        $user = $this->unpackToken();
        $userData = $this->request->getUserDataForUpdate();
        $user = $this->service->updateProfile($user->userId,$userData);
        return [
            "user" => $user
        ];
    }

    public function ban(){
        $user = $this->unpackToken();
        $user = $this->service->deleteProfile($user->userId);
        return [
            "user" => $user
        ];
    }

    protected function unpackToken():User{
        $token = $this->request->getToken();
        return $this->service->unserialize($token);
    }




}