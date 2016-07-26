<?php
namespace Chatbox\MailAuth;

use Chatbox\ApiAuth\ApiAuthServiceProvider;

use Chatbox\Mailtoken\RegisterControllerTrait;
use Chatbox\MailAuth\Http\Controllers\RegisterMailController;
use Chatbox\MailAuth\Http\Controllers\EmailChangeMailController;
use Chatbox\MailAuth\Http\Controllers\PasswordResetMailController;
use Chatbox\Token\Storage\TokenStorageInterface;


/**
 * SPの役割は注入できるポイントを提供すること
 *
 */
abstract class MailAuthServiceProvider extends ApiAuthServiceProvider
{
    use RegisterControllerTrait;

    protected $registerController;
    protected $mailChangeController;
    protected $passwordResetController;

    public function register()
    {
        $app = $this->app;

        if($router = $this->getRouter()){
            $this->registerMailRoute($router);
        }

        $app->singleton(MailTokenService::class,function(){
            return new MailTokenService($this->mailTokenStorageFactory());
        });

        $app->singleton(MailAuthMailSenderInterface::class,function(){
            return $this->mailerServiceFactory();
        });

        parent::register();
    }

    protected function registerMailRoute($router){
        $this->registerRouter($router,RegisterMailController::class,"mail/register/");
        $this->registerRouter($router,EmailChangeMailController::class,"mail/changeMail/");
        $this->registerRouter($router,PasswordResetMailController::class,"mail/changePass/");
    }

    abstract protected function mailerServiceFactory():MailAuthMailSenderInterface;

    abstract protected function mailTokenStorageFactory():TokenStorageInterface;
}