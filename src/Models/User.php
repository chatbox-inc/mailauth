<?php
namespace Chatbox\ApiAuth\Models;
use Chatbox\ApiAuth\Domains\UserInterface;
use Chatbox\ApiAuth\Domains\UserNotFouncException;
use Chatbox\ApiAuth\Domains\UserServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Factory;
use Illuminate\Validation\ValidationException;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/06/17
 * Time: 16:54
 */
class User extends Model implements UserServiceInterface,UserInterface
{
    protected $table = "t_user";

    protected $fillable = ["name","email","password"];



    public function loadProfileByCredential(array $credential):UserInterface
    {
        // TODO: Implement loadProfileByCredential() method.
    }

    public function loadProfileById($userId):UserInterface
    {
        // TODO: Implement loadProfileById() method.
    }

    public function registerProfile(array $data)
    {
        /** @var Factory $validator */
        $validator = app("validator");
        $val = $validator->make($data,[
            "name" => ["required"],
            "email" => ["required","email"],
            "password" => ["required"],
        ]);
        if($val->passes()){
            $data["password"] = $this->getPasswordHash($data["password"]);
            return $this->create($data);
        }else{
            throw new ValidationException($val);
        }

    }

    protected function getPasswordHash($password){
        return sha1("chatboxinc".sha1(sha1($password."chatboxinc")));
    }

    public function updateProfile()
    {
        // TODO: Implement updateProfile() method.
    }

    public function deleteProfile()
    {
        // TODO: Implement deleteProfile() method.
    }


}