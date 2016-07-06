<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/06
 * Time: 13:35
 */

namespace Chatbox\ApiAuth\Tests\Domains;

use Chatbox\ApiAuth\Domains\TokenServiceInterface;
use Chatbox\ApiAuth\Domains\Token;
use Chatbox\ApiAuth\Domains\User;
use Chatbox\ApiAuth\Tests\TestCase;

class TokenServiceInterfaceTest extends TestCase
{

    protected function token():TokenServiceInterface{
        return app(TokenServiceInterface::class);
    }

    public function testRegister(){
        $userId = 1100;
        $data = [
            "email" => "t.goto@chatbox-inc.com",
            "age" => 19,
            "name" => "Johon Smith",
            "password" => "chatbox1234"
        ];
        $user = new User($userId,$data);

        $token = $this->token()->createByUser($user);

        $this->assertInstanceOf(Token::class,$token);

        $loadedToken = $this->token()->loadByToken($token->token);

        $this->assertEquals($token->user->userId,$loadedToken->user->userId);
    }

    /**
     * @depends testRegister
     */
    public function testLoad($user)
    {


    }


}