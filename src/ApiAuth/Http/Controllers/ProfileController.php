<?php
namespace Chatbox\ApiAuth\Http\Controllers;
use Chatbox\ApiAuth\Domains\User;
use Chatbox\ApiAuth\Domains\UserServiceInterface;
use Chatbox\ApiAuth\Http\AuthRequest;
use Chatbox\ApiAuth\Http\Request\AuthToken;
use Chatbox\ApiAuth\Http\Request\ProfileForRegister;
use Chatbox\ApiAuth\Http\Request\ProfileForUpdate;
use Chatbox\ApiAuth\Http\Service\HttpProfileService;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/06/17
 * Time: 14:42
 */
class ProfileController
{

    protected $service;

    protected $token;

    /**
     * ProfileController constructor.
     * @param $request
     * @param $service
     */
    public function __construct(
        UserServiceInterface $service,
        AuthToken $token
    ){
        $this->service = $service;
        $this->token = $token;
    }

    public function create(ProfileForRegister $profile)
    {
        $user = $profile->get();
        $user = $this->service->registerProfile($user);
        return [
            "user" => $user
        ];
    }

    public function load(AuthToken $token){
        $user = $this->unpackToken();
        $user = $this->service->loadProfileById($user->userId);
        return [
            "user" => $user
        ];
    }

    public function update(ProfileForUpdate $profile){
        $user = $this->unpackToken();
        $userData = $profile->get();
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
        return $this->token->getUser();
    }




}