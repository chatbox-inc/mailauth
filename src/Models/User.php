<?php
namespace Chatbox\ApiAuth\Models;
use Chatbox\ApiAuth\Domains\UserNotFoundException;
use Chatbox\ApiAuth\Domains\UserServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Factory;
use Illuminate\Validation\ValidationException;
use Chatbox\ApiAuth\Domains\User as Entity;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/06/17
 * Time: 16:54
 */
class User extends Model implements UserServiceInterface
{
    protected $table = "t_user";

    protected $fillable = ["name","email","password"];


    protected function convertEntity():Entity{
        return new Entity($this->id,$this->attributes,$this->entityFilter());
    }

    protected function entityFilter():callable {
        return function($data){
            return $data;
        };
    }


    public function loadProfileByCredential(array $credential):Entity
    {
        $user = $this->where([
            "email" => array_get($credential,"email"),
            "password" => $this->getPasswordHash(array_get($credential,"password")),
        ])->get();
        if(count($user) === 1){
            return $user->first()->convertEntity();
        }else{
            throw new UserNotFoundException("user not found");
        }
    }

    public function loadProfileById($userId):Entity
    {
        $user = $this->where([
            "id" => $userId,
        ])->first();
        if($user){
            return $user->convertEntity();
        }else{
            throw new UserNotFoundException("user not found");
        }
    }

    public function registerProfile(array $data):Entity
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
            return $this->create($data)->convertEntity();
        }else{
            throw new ValidationException($val);
        }
    }

    protected function getPasswordHash($password){
        return sha1("chatboxinc".sha1(sha1($password."chatboxinc")));
    }

    public function updateProfile($userId, array $data):Entity
    {
        $user = $this->where([
            "id" => $userId,
        ])->first();
        if($user){
            $user->update($data);
            return $user->convertEntity();
        }else{
            throw new UserNotFoundException("user not found");
        }
    }

    public function deleteProfile($userId)
    {
        $user = $this->where([
            "id" => $userId,
        ])->first();
        if($user){
            $user->delete();
            return;
        }else{
            throw new UserNotFoundException("user not found");
        }
    }


}