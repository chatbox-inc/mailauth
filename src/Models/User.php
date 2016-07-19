<?php
namespace Chatbox\ApiAuth\Models;
use Chatbox\ApiAuth\Domains\UserNotFoundException;
use Chatbox\ApiAuth\Domains\UserServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Factory;
use Illuminate\Validation\ValidationException;
use Chatbox\ApiAuth\Domains\User as Entity;

/**
 * TODO Eloquent を外部注入する形に。
 */
abstract class User extends Model implements UserServiceInterface
{
//    protected $table = "t_user";
//
//    protected $fillable = ["name","email","password"];


    protected function convertEntity():Entity{
        return new Entity(
            $this->id,
            $this->attributes,
            $this->entityFilter()
        );
    }

    protected function entityFilter():callable {
        return function($data){
            return $data;
        };
    }

    public function loadProfileByCredential(array $credential):Entity
    {
        $user = $this->_whereByCredential($credential)->get();
        if(count($user) === 1){
            return $user->first()->convertEntity();
        }else{
            throw new UserNotFoundException("user not found");
        }
    }

    abstract protected function _whereByCredential($credential);

    public function loadProfileById($userId):Entity
    {
        $user = $this->find($userId);
        if($user){
            return $user->convertEntity();
        }else{
            throw new UserNotFoundException("user not found");
        }
    }

    public function registerProfile(array $data):Entity
    {
        $data = $this->createSaveData($data);
        return $this->create($data)->convertEntity();
    }

    abstract protected function createSaveData($data):array;

    protected function getPasswordHash($password){
        return sha1("chatboxinc".sha1(sha1($password."chatboxinc")));
    }

    public function updateProfile($userId, array $data):Entity
    {
        $user = $this->find($userId);
        if($user){
            $user->update($data);
            return $user->convertEntity();
        }else{
            throw new UserNotFoundException("user not found");
        }
    }

    public function deleteProfile($userId)
    {
        $user = $this->find($userId);
        if($user){
            $user->delete();
            return;
        }else{
            throw new UserNotFoundException("user not found");
        }
    }
}