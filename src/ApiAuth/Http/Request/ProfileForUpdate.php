<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/25
 * Time: 3:16
 */

namespace Chatbox\ApiAuth\Http\Request;

use Illuminate\Validation\ValidationException;

class ProfileForUpdate
{
    use RequestParamTrait;

    public function get(){
        $user = $this->request()->get("user");
        $val = $this->validator([
            "user" => $user
        ],[
            "user" => ["required","array"]
        ]);
        if($val->passes()){
            return $user;
        }
        throw new ValidationException($val);
    }

}