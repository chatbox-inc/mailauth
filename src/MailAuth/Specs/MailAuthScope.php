<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/20
 * Time: 12:55
 */

namespace Chatbox\MailAuth\Specs;


use Laravel\Lumen\Application;
use Peridot\Core\Scope;

class MailAuthScope extends Scope
{
    protected $app;

    public $register;
    public $login;
    public $profile;
    /**
     * MailAuthScope constructor.
     * @param $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;

        $lumen = new \Peridot\Plugin\Lumen\LumenAppScope($app);

        $this->register = new \Chatbox\MailAuth\Specs\RegisterUser($lumen);
        $this->login = new \Chatbox\ApiAuth\Specs\LoginUser($lumen);
        $this->profile = new \Chatbox\ApiAuth\Specs\ProfileUser($lumen);
    }

    public function greet(){
        return "hello";
    }


}