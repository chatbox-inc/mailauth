<?php
namespace App;
use App\Model\UserTable;
use Chatbox\ApiAuth\Models\UserService;
use Chatbox\Token\CacheTokenService;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/19
 * Time: 12:44
 */
class MailAuthServiceProvider extends \Chatbox\MailAuth\MailAuthServiceProvider
{
    protected function registerUserServiceInterface():UserServiceInterface
    {
        $model = new UserTable();
        $token = new CacheTokenService(app("cache")->store());
        return new UserService($model,$token);
    }




}