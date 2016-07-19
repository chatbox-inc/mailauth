<?php
namespace Chatbox\ApiAuth\Models;
use Chatbox\ApiAuth\Domains\TokenServiceInterface;
use Chatbox\ApiAuth\Domains\User as UserEntity;
use Chatbox\ApiAuth\Domains\Token as Entity;
use Chatbox\Token\Storage\TokenStorageInterface;
use Chatbox\Token\TokenService;


/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/06/17
 * Time: 16:54
 */
class Token implements TokenServiceInterface
{
    /** @var TokenService  */
    protected $token;

    /**
     * Token constructor.
     * @param $token
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->token = new TokenService($tokenStorage);
    }


    public function createByUser(UserEntity $user):Entity
    {
        $token = $this->token->save($user);
        return new Entity($token->key,$user);
    }

    public function loadByToken($key):Entity
    {
        $token = $this->token->load($key);
        return new Entity($token->key,$token->value);
    }

    public function inactive($key)
    {
        $this->token->delete($key);
    }
}