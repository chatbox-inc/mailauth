<?php
namespace Chatbox\ApiAuth\Http;
use Chatbox\ApiAuth\Domains\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Validation\Validator;
use Illuminate\Validation\ValidationException;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/06/21
 * Time: 1:23
 */
class AuthRequest
{
    protected function request():Request{
        return app(Request::class);
    }

    protected function validator(array $data,array $rules,array $messages=[],array $custom=[]):Validator{
        /** @var Factory $valiator */
        $valiator = app(Factory::class);
        $val = $valiator->make($data,$rules,$messages,$custom);
        return $val;
    }

    public function getToken(){
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

    public function getCredential(){
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

    public function getUserDataForRegister(){
        return $this->getUserData();
    }

    public function getUserDataForUpdate(){
        return $this->getUserData();
    }

    protected function getUserData(){
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