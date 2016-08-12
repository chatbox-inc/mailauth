<?php
namespace Chatbox\MailAuth\Specs;
use Illuminate\Http\Response;
use Peridot\Plugin\Lumen\LumenAppScope;

/**
 * ユーザ登録フローを検証しつつユーザ作成を行います。
 */
class RegisterUser
{
    use HttpSpecTrait;

    protected $prefix = "";

    public function __construct(LumenAppScope $lumen)
    {
        $this->lumen = $lumen;
    }

    public function describe($email,$data){
        $this->email = $email;
        $this->data = $data;


        it("should return 400 without email", [$this,"testSend400"]);
        it("should return 200",               [$this,"testSend200"]);
        it("should return 200",               [$this,"testCheck200"]);
        it("should return 200",               [$this,"testHandle200"]);
    }

    public function testSend400(){
        $this->lumen->post("{$this->prefix}/mail/register/send");
        assert($this->lumen->response()->getStatusCode() === 500,"response code should be 400");
    }

    public function testSend200(){
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
    public function testCheck200(){
        $this->lumen->get("{$this->prefix}/mail/register/check",[
            "X-MAILTOKEN" => $this->token
        ]);

        $response = $this->response();
        assert($response->getStatusCode() === 200,"response code should be 200");
        $body = $this->body();
        assert(is_array($body),"response code should be 200");
        assert(array_get($body,"token.key")===$this->token,"response code should be 200");
    }
    public function testHandle200(){
        $this->lumen->post("{$this->prefix}/mail/register/handle",[
            "user" => $this->data
        ],[
            "X-MAILTOKEN" => $this->token
        ]);

        $response = $this->response();
        assert($response->getStatusCode() === 200,"response code should be 200");
        $body = $this->body(false);
        assert(is_array($body),"response code should be 200");
        assert(is_string(array_get($body,"token.key")),"response code should be 200");

        $this->user = array_get($body,"user");
        $this->credential = [
            "email" => $this->email,
            "password" => $this->data["password"]
        ];
    }
}