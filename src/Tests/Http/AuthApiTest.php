<?php
namespace Chatbox\ApiAuth\Tests\Http;
use Chatbox\ApiAuth\Tests\TestCase;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/06
 * Time: 22:21
 */
abstract class AuthApiTest extends TestCase
{
    protected $prefix = "";

    public function registerDataProvider(){
        $hash = sha1(mt_rand());
        return [
            [//#1
                [
                    "email" => "t.goto+$hash@chatbox-inc.com",
                    "age" => 19,
                    "name" => "Johon Smith",
                    "password" => "chatbox1234"
                ]
            ]
        ];
    }

    /**
     * @param $data
     * @dataProvider registerDataProvider
     */
    public function testRegister($data){
//        $data = ;
//
//        $this->post($this->prefix."profile",[
//            "user" => $data
//        ],[]);
//
//        $this->assertResponseOk();
    }

}