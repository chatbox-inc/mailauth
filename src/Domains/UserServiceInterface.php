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
     * @return UserInterface
     */
    public function loadProfileByCredential(array $credential):UserInterface;

    /**
     * @param $credential
     * @throws UserNotFouncException
     * @return UserInterface
     *
     */
    public function loadProfileById($userId):UserInterface;

    public function registerProfile(array $data);

    public function updateProfile();

    public function deleteProfile();


}

class UserNotFouncException extends \Exception{};

