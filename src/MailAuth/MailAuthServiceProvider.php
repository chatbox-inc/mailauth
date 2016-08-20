<?php
namespace Chatbox\MailAuth;

use Chatbox\ApiAuth\ApiAuthServiceProvider;

use Chatbox\MailAuth\Http\Controllers\RegisterMailController;
use Chatbox\MailAuth\Http\Controllers\EmailChangeMailController;
use Chatbox\MailAuth\Http\Controllers\PasswordResetMailController;
use Chatbox\MailAuth\Service\RegisterMailTokenService;
use Chatbox\MailAuth\Service\ProfileMailTokenService;
use Chatbox\MailAuth\Service\ResetMailTokenService;
use Chatbox\MailToken\RegisterTrait;


/**
 * SPの役割は注入できるポイントを提供すること
 *
 */
abstract class MailAuthServiceProvider extends ApiAuthServiceProvider
{
    use RegisterTrait;

    protected $classRegister = RegisterMailController::class;
    protected $classEmail = EmailChangeMailController::class;
    protected $classReset = PasswordResetMailController::class;

    public function register()
    {
        assert(!empty($this->classRegister),"mailtoken service name must be registered");
        assert(!empty($this->classEmail),"mailtoken service name must be registered");
        assert(!empty($this->classReset),"mailtoken service name must be registered");

        parent::register();

        $this->app->singleton(RegisterMailTokenService::class,function(){
            return $this->registerRegisterMailTokenService();
        });

        $this->app->singleton(ProfileMailTokenService::class,function(){
            return $this->registerProfileMailTokenService();
        });

        $this->app->singleton(ResetMailTokenService::class,function(){
            return $this->registerResetMailTokenService();
        });
    }

    protected function registerAuthRoute($router)
    {
        parent::registerAuthRoute($router);

        $this->registerMailTokenRoute($router,"register",$this->classRegister);
        $this->registerMailTokenRoute($router,"profile",$this->classEmail);
        $this->registerMailTokenRoute($router,"reset",$this->classReset);
    }

    abstract protected function registerRegisterMailTokenService():RegisterMailTokenService;

    abstract protected function registerProfileMailTokenService():ProfileMailTokenService;

    abstract protected function registerResetMailTokenService():ResetMailTokenService;
}