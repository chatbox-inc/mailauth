<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/16
 * Time: 16:12
 */

namespace App;

use App\Model\UserTable;
use Chatbox\ApiAuth\Domains\UserServiceInterface;
use Chatbox\ApiAuth\Models\UserService;
use Chatbox\Token\CacheTokenService;

class ApiAuthServiceProvider extends \Chatbox\ApiAuth\ApiAuthServiceProvider
{
    protected function registerUserServiceInterface():UserServiceInterface{
        $model = new UserTable();
        $token = new CacheTokenService(app("cache")->store());
        return new UserService($model,$token);
    }
}