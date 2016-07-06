<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/06
 * Time: 1:42
 */

namespace Chatbox\ApiAuth\Domains;


class Token
{
    public $token;

    public $user;

    /**
     * Token constructor.
     * @param $token
     * @param $user
     * @param $expireAt
     * @param $nextToken
     */
    public function __construct($token,User $user)
    {
        $this->token = $token;
        $this->user = $user;
    }


}