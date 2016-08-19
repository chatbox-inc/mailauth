<?php
namespace Chatbox\ApiAuth\Specs;
use Chatbox\ApiAuth\Domains\User;
use Chatbox\Token\Token;
use Illuminate\Http\Response;
use Peridot\Plugin\Lumen\LumenAppScope;

/**
 * ユーザ登録フローを検証しつつユーザ作成を行います。
 */
class ProfileUser
{
    use HttpSpecTrait;

    protected $prefix = "";

    public function __construct(LumenAppScope $lumen)
    {
        $this->lumen = $lumen;
    }

    protected function lumen():LumenAppScope
    {
        return $this->lumen;
    }

//    public function describe($credential,$expect){
//        $self = $this;
//        describe("LOGIN API",function()use($self){
//            it("should return 200",               [$self,"testLogin200"]);
//        });
//        describe("LOGOUT API",function()use($self){
//            xit("should return 200",               [$self,"testLogout200"]);
//        });
//    }

    /**
     * @param $token
     * @return Response
     */
    public function doGet($token){
        $this->lumen->get("{$this->prefix}/profile",[
            "X-AUTHTOKEN"=> $token,
        ]);
        return $this->response();
    }

    public function retrieveUser():User{
        $body = $this->body();
        assert(is_array($body));
        $user = array_get($body,"user");
        assert($user instanceof User);
        return $user;
    }

//    public function testLogin200(){
//        $this->lumen->post("{$this->prefix}/login",[
//            "credential" => $this->register->credential,
//        ]);
//
//        $app = app();
//
//        $response = $this->response();
//        assert($response->getStatusCode() === 200,"response code should be 200");
//        $body = $this->body(false);
//        assert(is_array($body),"response code should be 200");
//        assert(is_string(array_get($body,"token.key")),"response code should be 200");
//        $this->token = array_get($body,"token.key");
//    }
//
//    public function testLogout200(){
//        $this->lumen->post("{$this->prefix}/mail/register/send",[
//            "email" => $this->email,
//            "data" => $this->data
//        ]);
//
//        $response = $this->response();
//        assert($response->getStatusCode() === 200,"response code should be 200");
//        $body = $this->body();
//        assert(is_array($body),"response code should be 200");
//        assert(is_string(array_get($body,"token.key")),"response code should be 200");
//        $this->token = array_get($body,"token.key");
//    }
}