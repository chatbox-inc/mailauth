<?php
namespace Chatbox\ApiAuth\Http\Service;
use Chatbox\ApiAuth\Domains\Token;
use Chatbox\ApiAuth\Domains\TokenServiceInterface;
use Chatbox\ApiAuth\Domains\UserServiceInterface;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/06/25
 * Time: 14:20
 */
class TokenService
{
    protected $token;

    protected $user;

    /**
     * TokenService constructor.
     * @param $token
     * @param $user
     */
    public function __construct(
        TokenServiceInterface $token,
        UserServiceInterface $user)
    {
        $this->token = $token;
        $this->user = $user;
    }


    public function publish(array $credential):Token
    {
        $user = $this->user->loadProfileByCredential($credential);
        return $this->token->createByUser($user);
    }

//    public function refresh($token){
//        return $key;
//    }
//

    public function delete($token){
        $this->token->inactive($token);
    }

}