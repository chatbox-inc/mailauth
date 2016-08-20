<?php
describe("MailAuth",function(){

    $user = [
        "name" => "後藤知宏",
        "email" => "t.goto+".\Illuminate\Support\Str::random()."@chatbox-inc.com",
        "password" => "chatbox"
    ];


    $app = require(__DIR__."/../sample/app.php");
    $app->register(\App\MailAuthServiceProvider::class);
    $lumen = new \Peridot\Plugin\Lumen\LumenAppScope($app);

    $this->register = new \Chatbox\MailAuth\Specs\RegisterUser($lumen);
    $this->login = new \Chatbox\ApiAuth\Specs\LoginUser($lumen);
    $this->profile = new \Chatbox\ApiAuth\Specs\ProfileUser($lumen);

    $this->userData = $user;

    describe("REGISTER API",function(){

        it("should return 200",function(){

            /** @var \Chatbox\MailAuth\Specs\RegisterUser $register */
            $register = $this->register;
            $response = $register->doSendmail($this->userData["email"],$this->userData);
            $register->assertResponseOk();
            $token = $register->retrieveToken();

            $response = $register->doCheck($token);
            $register->assertResponseOk();

            $response = $register->doRegister($token,$this->userData);
            $register->assertResponseOk();
        });

    });

    describe("LOGIN API",function(){

        it("should return 200",function(){
            $credential = [
                "email" => $this->userData["email"],
                "password" => $this->userData["password"]
            ];
            /** @var \Chatbox\ApiAuth\Specs\LoginUser $login */
            $login = $this->login;
            $response = $login->doLogin($credential);
            $login->assertResponseOk();
        });
    });

    describe("PROFILE API",function(){

        context("GET",function(){
            it("should return 200",function(){
                $token = $this->login->retrieveToken();
                assert($token instanceof \Chatbox\Token\Token);

                /** @var \Chatbox\ApiAuth\Specs\ProfileUser $profile */
                $profile = $this->profile;

                $response = $profile->doGet($token->key);
                $profile->assertResponseOk();
                $user = $profile->retrieveUser();
                assert($user->data["name"] === $this->userData["name"]);

            });
        });
    });

    describe("LOGOUT API",function(){
        it("should return 200",function(){
            /** @var \Chatbox\ApiAuth\Specs\LoginUser $login */
            $login = $this->login;
            $response = $login->doLogout();
            $login->assertResponseOk();
        });
    });

    describe("PROFILE API",function(){

        context("GET",function(){
            it("should return ERROR",function(){
                $token = $this->login->token;
                assert($token instanceof \Chatbox\Token\Token);

                /** @var \Chatbox\ApiAuth\Specs\ProfileUser $profile */
                $profile = $this->profile;
                $response = $profile->doGet($token->key);
                $e = $profile->retrieveException();
                assert($e instanceof \Chatbox\Token\TokenNotFoundException);
            });
        });
    });


});
