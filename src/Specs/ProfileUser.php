<?php
namespace Chatbox\MailAuth\Specs;
use Illuminate\Http\Response;
use Peridot\Plugin\Lumen\LumenAppScope;

/**
 * ユーザ登録フローを検証しつつユーザ作成を行います。
 */
class ProfileUser
{
    protected $prefix = "";

    public function __construct(LumenAppScope $lumen)
    {
        $this->lumen = $lumen;
    }

    public function describe($login){
        $this->credential = $register->credential;
        $this->user       = $register->user;

        it("should return 200",               [$this,"testLogin200"]);
        it("should return 200",               [$this,"testLogout200"]);
    }

    /**
     * @return Response
     */
    protected function response(){
        $response = $this->lumen->response();
        return $response;
    }

    protected function body(){
        $body = $this->response()->getOriginalContent();
        return $body;
    }

    public function testLogin200(){
        $this->lumen->post("{$this->prefix}/auth/login",[
            "credential" => $this->credential,
        ]);

        $response = $this->response();
        assert($response->getStatusCode() === 200,"response code should be 200");
        $body = $this->body();
        assert(is_array($body),"response code should be 200");
        assert(is_string(array_get($body,"token.key")),"response code should be 200");
        $this->token = array_get($body,"token.key");
    }

    public function testLogout200(){
        $this->lumen->post("{$this->prefix}/mail/register/send",[
            "email" => $this->email,
            "data" => $this->data
        ]);

        $response = $this->response();
        assert($response->getStatusCode() === 200,"response code should be 200");
        $body = $this->body();
        assert(is_array($body),"response code should be 200");
        assert(is_string(array_get($body,"token.key")),"response code should be 200");
        $this->token = array_get($body,"token.key");
    }
}