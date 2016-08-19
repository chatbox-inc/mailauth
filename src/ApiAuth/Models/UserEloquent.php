<?php
namespace Chatbox\ApiAuth\Models;
use Chatbox\ApiAuth\Domains\UserNotFoundException;
use Chatbox\ApiAuth\Domains\UserServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Factory;
use Illuminate\Validation\ValidationException;
use Chatbox\ApiAuth\Domains\User as Entity;

/**
 *
 */
abstract class UserEloquent extends Model
{
    abstract protected function entity():Entity;

    abstract protected function _findByCredential(array $credential):UserEloquent;

    abstract protected function _create(array $data):UserEloquent;

    public function loadProfileByCredential(array $credential):Entity
    {
        return $this->_findByCredential($credential)->entity();
    }

    protected function findOrException($userId):UserEloquent{
        if($user = $this->find($userId)){
            return $user;
        }else{
            throw new UserNotFoundException("user not found");
        }
    }

    public function loadProfileById($userId):Entity
    {
        return $this->findOrException($userId)->entity();
    }

    public function registerProfile(array $data):Entity
    {
        return $this->_create($data)->entity();
    }

    public function updateProfile($userId, array $data):Entity
    {
        $user = $this->findOrException($userId);
        $user->update($data);
        return $user->entity();
    }

    public function deleteProfile($userId)
    {
        $user = $this->findOrException($userId);
        $user->delete();
    }
}