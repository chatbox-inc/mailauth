<?php
namespace Chatbox\ApiAuth\Domains;
use Chatbox\Token\Token;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/06/17
 * Time: 14:38
 */
interface UserServiceInterface
{
    /**
     * @param User $user
     * @return string $key
     */
    public function serialize(User $user):Token;

    /**
     * @param $token
     * @throws UserNotFouncException
     * @return User
     */
    public function unserialize($key):User;

    /**
     * @param $token
     * @return mixed
     */
    public function forget($key);

    /**
     * @param $credential
     * @throws UserNotFouncException
     * @return User
     */
    public function loadProfileByCredential(array $credential):User;

    /**
     * @param $credential
     * @throws UserNotFouncException
     * @return User
     */
    public function loadProfileById($userId):User;

    /**
     * @param array $data
     * @return User
     */
    public function registerProfile(array $data):User;

    /**
     * @param $userId
     * @param $data
     * @throws UserNotFouncException
     * @return User
     */
    public function updateProfile($userId,array $data):User;

    /**
     * @param $userId
     * @throws UserNotFoundException
     */
    public function deleteProfile($userId);
}

class UserNotFoundException extends \Exception{};

