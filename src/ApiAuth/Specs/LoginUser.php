<?php
namespace Chatbox\ApiAuth\Specs;
use Chatbox\Token\Token;
use Illuminate\Http\Response;
use Peridot\Plugin\Lumen\LumenAppScope;

/**
 * ユーザ登録フローを検証しつつユーザ作成を行います。
 */
class LoginUser
{
    use HttpSpecTrait;

    protected $prefix = "";

    public $token;

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

    public function doLogin($credential){
        $this->lumen->post("{$this->prefix}/login",[
            "credential" => $credential,
        ]);
        return $this->response();
    }

    public function doLogout(){
        $token = $this->token;
        $this->lumen->post("{$this->prefix}/logout",[],[
            "X-AUTHTOKEN" => $token
        ]);
        return $this->response();
    }

    public function retrieveToken(){
        $body = $this->body();
        assert(is_array($body));
        $token = array_get($body,"token");
        assert($token instanceof Token);
        assert(!empty($token->key));
        $this->token = $token;
        return $token;
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