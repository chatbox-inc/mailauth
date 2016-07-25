<?php
namespace Chatbox\MailAuth;

use Chatbox\ApiAuth\ApiAuthServiceProvider;

use Chatbox\Mailtoken\RegisterControllerTrait;
use Chatbox\MailAuth\Http\Controllers\RegisterMailController;
use Chatbox\MailAuth\Http\Controllers\EmailChangeMailController;
use Chatbox\MailAuth\Http\Controllers\PasswordResetMailController;


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

        $this->registerRouter($app,RegisterMailController::class);
        $this->registerRouter($app,EmailChangeMailController::class);
        $this->registerRouter($app,PasswordResetMailController::class);

        parent::register();
    }

    abstract protected function mailerServiceFactory():MailAuthMailSenderInterface;
}