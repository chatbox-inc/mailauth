<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/16
 * Time: 16:54
 */

namespace Chatbox\ApiAuth\Models;


use Chatbox\ApiAuth\Domains\User;
use Chatbox\ApiAuth\Domains\UserNotFouncException;
use Chatbox\ApiAuth\Domains\UserNotFoundException;
use Chatbox\ApiAuth\Domains\UserServiceInterface;
use Chatbox\Token\Token;
use Chatbox\Token\TokenServiceInterface;

class UserService implements UserServiceInterface
{
    protected $model;

    protected $token;

    /**
     * UserService constructor.
     * @param $entity
     * @param $token
     */
    public function __construct(UserEloquent $model,TokenServiceInterface $token)
    {
        $this->model = $model;
        $this->token = $token;
    }

    public function serialize(User $user):Token
    {
        $token = $this->token->save($user);
        return $token;
    }

    public function unserialize($key):User
    {
        $token = $this->token->load($key);
        return $token->value;
    }

    public function forget($key)
    {
        $this->token->delete($key);
    }

    public function loadProfileByCredential(array $credential):User
    {
        return $this->model->loadProfileByCredential($credential);
    }

    public function loadProfileById($userId):User
    {
        return $this->model->loadProfileById($userId);
    }

    public function registerProfile(array $data):User
    {
        return $this->model->registerProfile($data);
    }

    public function updateProfile($userId, array $data):User
    {
        return $this->model->updateProfile($userId,$data);
    }

    public function deleteProfile($userId)
    {
        $this->model->deleteProfile($userId);
    }


}