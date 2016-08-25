<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/25
 * Time: 3:16
 */

namespace Chatbox\ApiAuth\Http\Request;

use Illuminate\Validation\ValidationException;

class Credential
{
    use RequestParamTrait;

    public function get(){
        $credential = $this->request()->get("credential");
        $val = $this->validator([
            "credential" => $credential
        ],[
            "credential" => ["array"]
        ]);
        if($val->passes()){
            return $credential;
        }
        throw new ValidationException($val);
    }

}