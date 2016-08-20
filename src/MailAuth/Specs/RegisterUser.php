<?php
namespace Chatbox\MailAuth\Specs;
use Chatbox\Token\Token;
use Illuminate\Http\Response;
use Peridot\Plugin\Lumen\LumenAppScope;

/**
 * ユーザ登録フローに関するテスト。
 */
class RegisterUser
{
    use HttpSpecTrait;

    public $prefix = "";

    public $token;

    public function __construct(LumenAppScope $lumen)
    {
        $this->lumen = $lumen;
    }

    protected function lumen():LumenAppScope
    {
        return $this->lumen;
    }

    /**
     * @return Response
     */
    public function doSendmail($email,$data)
    {
        $this->lumen->post("{$this->prefix}/mail/register/send", [
            "email" => $email,
            "data" => $data,
        ]);
        return $this->response();
    }

    /**
     * @return Response
     */
    public function doCheck($token)
    {
        $this->lumen->get("{$this->prefix}/mail/register/check", [
            "X-MAILTOKEN" => $token,
        ]);
        return $this->response();
    }

    /**
     * @return Response
     */
    public function doRegister($token,$data)
    {
        $this->lumen->post("{$this->prefix}/mail/register/handle", [
            "user" => $data,
        ],[
            "X-MAILTOKEN" => $token,
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


}