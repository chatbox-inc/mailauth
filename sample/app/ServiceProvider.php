<?php
namespace App;
use App\Model\AuthTokenTable;
use App\Model\MailTokenTable;
use App\Model\UserTable;
use Chatbox\ApiAuth\ApiAuthServiceProvider;
use Chatbox\ApiAuth\Models\Token;
use Chatbox\ApiAuth\RegisterRouteTrait;
use Chatbox\ApiAuth\Domains\UserServiceInterface;
use Chatbox\MailAuth\MailAuthMailSenderInterface;
use Chatbox\MailAuth\MailAuthServiceProvider;
use Chatbox\MailClerk\MailClerkServiceProvider;
use Chatbox\Token\Storage\Mock\ArrayStorage;
use Chatbox\Token\TokenService;
use Illuminate\Contracts\Mail\Mailer;
use Chatbox\MailClerk\MailClerk;
use Chatbox\Token\Storage\TokenStorageInterface;
use Chatbox\Token\TokenServiceInterface;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/19
 * Time: 12:44
 */
class ServiceProvider extends MailAuthServiceProvider
{
    use RegisterRouteTrait;

    public function register()
    {
        $this->app->register(MailClerkServiceProvider::class);
        return parent::register();
    }

    public function getRouter()
    {
        return $this->app;
    }

    protected function mailerServiceFactory():MailAuthMailSenderInterface
    {
        return new class() implements MailAuthMailSenderInterface{

            public function send($type,$email, array $data)
            {
                /** @var MailClerk $mailer */
                $mailer = app(MailClerk::class);
                $mailer->publish($type,$data,function($m)use($email){
                    $m->to($email);
                });
            }

        };
    }

    protected function mailTokenStorageFactory():TokenStorageInterface
    {
        return new MailTokenTable();
    }


    function userServiceFactory():UserServiceInterface
    {
        return new UserTable();
    }

    function tokenServieFactory():TokenServiceInterface
    {
        $storage = new ArrayStorage();
        return new TokenService($storage);
    }
}