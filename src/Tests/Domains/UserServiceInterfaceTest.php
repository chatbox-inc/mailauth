<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/06
 * Time: 13:35
 */

namespace Chatbox\ApiAuth\Tests\Domains;

use Chatbox\ApiAuth\Domains\UserNotFoundException;
use Chatbox\ApiAuth\Domains\UserServiceInterface;
use Chatbox\ApiAuth\Domains\User;
use Chatbox\ApiAuth\Tests\TestCase;

class UserServiceInterfaceTest extends TestCase
{

    protected function user():UserServiceInterface{
        return app(UserServiceInterface::class);
    }

    public function testRegister(){
        $hash = sha1(mt_rand());
        $data = [
            "email" => "t.goto+$hash@chatbox-inc.com",
            "age" => 19,
            "name" => "Johon Smith",
            "password" => "chatbox1234"
        ];
        $credential = [
            "email" => "t.goto+$hash@chatbox-inc.com",
            "password" => "chatbox1234"
        ];

        $user = $this->user()->registerProfile($data);

        unset($data["password"]);

        $this->assertInstanceOf(User::class,$user);

        $credentialUser = $this->user()->loadProfileByCredential($credential);
        $this->assertUser($credentialUser,$user->userId,$data);

        $idUser = $this->user()->loadProfileById($user->userId);
        $this->assertUser($idUser,$user->userId,$data);
        return $user;
    }

    protected function assertUser(User $user,$expectedId,$expectedData){
        $this->assertEquals($expectedId,$user->userId);
        foreach ($expectedData as $key=>$value) {
            $this->assertEquals($expectedData[$key],$value);
        }
    }

    /**
     */
    public function testUpdate()
    {
        $hash = sha1(mt_rand());
        $data = [
            "email" => "t.goto+$hash@chatbox-inc.com",
            "age" => 19,
            "name" => "Johon Smith",
            "password" => "chatbox1234"
        ];
        $updateData = [
            "email" => "t.goto+$hash@chatbox-inc.com",
        ];

        $user = $this->user()->registerProfile($data);

        unset($data["password"]);

        $updatedUser = $this->user()->updateProfile($user->userId,$updateData);
        $this->assertUser($updatedUser,$user->userId,array_merge($data,$updateData));

        $loadedUser = $this->user()->loadProfileById($user->userId);
        $this->assertUser($loadedUser,$user->userId,array_merge($data,$updateData));
    }

    /**
     * @depends testRegister
     */
    public function testDelete($user)
    {
        $hash = sha1(mt_rand());
        $data = [
            "email" => "t.goto+$hash@chatbox-inc.com",
            "age" => 19,
            "name" => "Johon Smith",
            "password" => "chatbox1234"
        ];
        $user = $this->user()->registerProfile($data);

        unset($data["password"]);

        $this->user()->deleteProfile($user->userId);
        return $user;
    }

    /**
     * @param $user
     * @depends testDelete
     * @expectedException \Chatbox\ApiAuth\Domains\UserNotFoundException
     */
    public function testDeletedUserNotFound($user){
        try{
            $this->user()->loadProfileById($user->userId);
        }catch(\Throwable $e){
            throw $e;
        }
    }


}