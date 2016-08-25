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

class MailAddress
{
    use RequestParamTrait;

    protected $user;

    public function get(){
        $data = $this->request()->all();
        $val = $this->validator($data,[
            "email"=>["required","email"],
            "data" => ["array"]
        ]);
        if($val->passes()){
            return array_merge(array_get($data,"data",[]),[
                "email" => $data["email"]
            ]);
        }
        throw new ValidationException($val);
    }
}