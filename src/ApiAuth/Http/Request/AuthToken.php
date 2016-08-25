<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/25
 * Time: 3:16
 */

namespace Chatbox\ApiAuth\Http\Request;

use Chatbox\ApiAuth\Domains\User;
use Chatbox\ApiAuth\Domains\UserServiceInterface;
use Illuminate\Validation\ValidationException;

class AuthToken
{
    use RequestParamTrait;

    protected $user;

    /**
     * AuthToken constructor.
     * @param $user
     */
    public function __construct(UserServiceInterface $user)
    {
        $this->user = $user;
    }


    public function get(){
        $token = $this->request()->header("X-AUTHTOKEN");
        $val = $this->validator([
            "token" => $token
        ],[
            "token" => ["required"]
        ]);
        if($val->passes()){
            return $token;
        }
        throw new ValidationException($val);
    }

    public function getUser():User{
        $token = $this->get();
        return $this->user->unserialize($token);
    }

}