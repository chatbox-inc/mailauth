<?php
namespace Chatbox\ApiAuth\Specs;
use Illuminate\Http\Response;
use Peridot\Plugin\Lumen\LumenAppScope;

/**
 * ユーザ登録フローに関するテスト。
 */
class RegisterUser
{
    use HttpSpecTrait;

    public $prefix = "";

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
    public function doRegister($data)
    {
        $this->lumen->post("{$this->prefix}/profile", [
            "user" => $data,
        ]);
        return $this->response();
    }

}