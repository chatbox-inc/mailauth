<?php
namespace Chatbox\MailAuth;

use Chatbox\ApiAuth\ApiAuthServiceProvider;

use Chatbox\Mailtoken\RegisterControllerTrait;
use Chatbox\MailAuth\Http\Controllers\RegisterMailController;
use Chatbox\MailAuth\Http\Controllers\EmailChangeMailController;
use Chatbox\MailAuth\Http\Controllers\PasswordResetMailController;
use Chatbox\Mailtoken\RegisterTrait;
use Chatbox\Token\Storage\TokenStorageInterface;


/**
 * SPの役割は注入できるポイントを提供すること
 *
 */
abstract class MailAuthServiceProvider extends ApiAuthServiceProvider
{
    use RegisterTrait;

    protected $classRegister;
    protected $classEmail;
    protected $classReset;

    public function register()
    {
        assert(!empty($this->classRegister),"mailtoken service name must be registered");
        assert(!empty($this->classEmail),"mailtoken service name must be registered");
        assert(!empty($this->classReset),"mailtoken service name must be registered");

        parent::register();
    }

    protected function registerAuthRoute($router)
    {
        parent::registerAuthRoute($router);

        $this->registerMailTokenRoute($router,"register",$this->classRegister);
        $this->registerMailTokenRoute($router,"profile",$this->classEmail);
        $this->registerMailTokenRoute($router,"reset",$this->classReset);
    }
}