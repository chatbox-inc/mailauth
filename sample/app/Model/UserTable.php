<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/18
 * Time: 19:14
 */

namespace App\Model;


use Chatbox\ApiAuth\Domains\User;
use Chatbox\ApiAuth\Domains\UserNotFoundException;
use Chatbox\ApiAuth\Models\UserEloquent;
use Chatbox\Token\Storage\Migratable;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

class UserTable extends UserEloquent implements Migratable
{
    protected $table = "rt_user";

    protected $fillable = [
        "name","email","password"
    ];

    protected function entity():User
    {
        return new User($this->id,$this->toArray());
    }

    protected function _findByCredential(array $credential):UserEloquent
    {
        $user = $this->where([
            "email" => $credential["email"],
        ])->first();
        if($user && password_verify($credential["password"],$user->password)){
            return $user;
        }else{
            throw new UserNotFoundException;
        }
    }

    protected function _create(array $data):UserEloquent
    {
        $data["password"] = password_hash($data["password"],\PASSWORD_BCRYPT);
        return $this->create($data);
    }

    public function upTable(Builder $builder)
    {
        $builder->create($this->table,function(Blueprint $table){
            $table->increments("id");
            $table->string("name");
            $table->string("email");
            $table->string("password");
            $table->timestamps();
        });
    }

    public function downTable(Builder $builder)
    {
        $builder->dropIfExists($this->table);
    }


}