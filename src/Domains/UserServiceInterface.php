<?php
namespace Chatbox\ApiAuth\Domains;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/06/17
 * Time: 14:38
 */
interface UserServiceInterface
{
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

