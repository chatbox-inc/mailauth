<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/06/18
 * Time: 11:12
 */

namespace Chatbox\ApiAuth\Tests\UserServiceInterface;


use Chatbox\ApiAuth\Domains\UserServiceInterface;

trait RegisterTestTrait
{
    abstract public function user():UserServiceInterface;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test正常系()
    {
        $data = [
            "name" => "hoge",
            "email" => "t.goto@chatbox-inc.com",
            "password" => "hogehoge"
        ];
        $user = $this->user()->registerProfile($data);
        $this->assertInstanceOf(UserInterface::class,$user);
    }

    /**
     * A basic test example.
     * @expectedException \Illuminate\Validation\ValidationException
     * @return void
     */
    public function test名前無しバリデーション()
    {
        $data = [
            "email" => "t.goto@chatbox-inc.com",
            "password" => "hogehoge"
        ];
        $this->user()->registerProfile($data);
        $this->assertTrue(false);
    }

    /**
     * A basic test example.
     * @expectedException \Illuminate\Validation\ValidationException
     * @return void
     */
    public function testRegisterFailure2s()
    {
        $data = [
            "name" => "hoge",
            "email" => "t.gotochatbox-inc.com",
            "password" => "hogehoge"
        ];
        $this->user()->registerProfile($data);
        $this->assertTrue(false);
    }


}