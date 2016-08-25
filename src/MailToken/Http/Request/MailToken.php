<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/25
 * Time: 3:16
 */

namespace Chatbox\MailToken\Http\Request;

use Chatbox\ApiAuth\Domains\User;
use Chatbox\ApiAuth\Domains\UserServiceInterface;
use Illuminate\Validation\ValidationException;

class MailToken
{
    use RequestParamTrait;

    protected $user;

    public function get(){
        $token = $this->request()->header("X-MAILTOKEN");
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
}