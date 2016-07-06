<?php
namespace Chatbox\ApiAuth\Models;
use Chatbox\ApiAuth\Domains\TokenServiceInterface;
use Chatbox\ApiAuth\Domains\User as UserEntity;
use Chatbox\ApiAuth\Domains\Token as Entity;
use Illuminate\Database\Eloquent\Model;


/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/06/17
 * Time: 16:54
 */
class Token extends Model implements TokenServiceInterface
{
    protected $table = "t_token";

    protected $fillable = ["key","value"];

    public function createByUser(UserEntity $user):Entity
    {
        $key = sha1(mt_rand());
        $this->create([
            "key" => $key,
            "value" => base64_encode(serialize($user))
        ]);
        return new Entity($key,$user);
    }

    public function loadByToken($key):Entity
    {
        $tokenModel = $this->where("key",$key)->first();
        $user = unserialize(base64_decode($tokenModel->value));
        return new Entity($key,$user);
    }

    public function inactive($key):Entity
    {
        $tokenModel = $this->where("key",$key)->first();
        $tokenModel->delete();
    }
}