<?php //arrayobject.spec.php

describe('ArrayObject', function() {
    beforeEach(function() {
        $this->arrayObject = new ArrayObject(['one', 'two', 'three']);
    });


    describe('can register', function(){
        $email = "t.goto".\Illuminate\Support\Str::random()."@chatbox-inc.com";
        $data = [
            "name" => "piyopiyo",
            "password" => "hogehoge"
        ];
        $register = new \Chatbox\MailAuth\Specs\RegisterUser($this->lumen);
        $register->describe($email,$data);
        $this->register = $register;
    });

    describe("can login",function(){
        $login = new \Chatbox\MailAuth\Specs\LoginUser($this->lumen);
        $login->describe($this->register);
    });
});