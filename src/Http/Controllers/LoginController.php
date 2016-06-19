<?php
namespace Chatbox\ApiAuth\Http\Controllers;
use Chatbox\ApiAuth\AuthServiceInterface;
use Chatbox\ApiAuth\TokenServiceInterface;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/06/17
 * Time: 14:42
 */
class LoginController
{

    protected $token;

    protected $req;

    protected $auth;

    /**
     * LoginController constructor.
     * @param $token
     * @param $req
     */
    public function __construct(
        TokenServiceInterface $token,
        AuthServiceInterface $auth,
        Request $req)
    {
        $this->token = $token;
        $this->req = $req;
        $this->auth = $auth;
    }


    public function login()
    {
        $cred = $this->req->get("credentials");

    }


    public function logout()
    {

    }

}