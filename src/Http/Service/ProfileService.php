<?php
namespace Chatbox\ApiAuth\Http\Service;
use Chatbox\ApiAuth\Domains\TokenServiceInterface;
use Chatbox\ApiAuth\Domains\UserServiceInterface;
use Chatbox\ApiAuth\Domains\User;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/06/25
 * Time: 14:21
 */
class ProfileService
{
    protected $user;

    protected $token;

    /**
     * ProfileService constructor.
     * @param $user
     */
    public function __construct(
        UserServiceInterface $user,
        TokenServiceInterface $token
    ){
        $this->user = $user;
        $this->token = $token;
    }


    public function register(array $user):User{
        return $this->user->registerProfile($user);
    }

    public function findByToken($token):User{
        return $this->token->loadByToken($token)->user;
    }

    public function update($token,$user):User{
        return $user;
    }

    public function delete($token):User{
        return $user;
    }

}