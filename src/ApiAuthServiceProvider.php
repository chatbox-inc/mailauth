<?php
namespace Chatbox\ApiAuth;

use Illuminate\Support\ServiceProvider;

use Chatbox\ApiAuth\Domains\UserServiceInterface;
use Chatbox\ApiAuth\Domains\TokenServiceInterface;


/**
 * SPの役割は注入できるポイントを提供すること
 *
 */
abstract class ApiAuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $app = $this->app;
        $app->singleton(UserServiceInterface::class,function(){
            return $this->userServiceFactory();
        });
        $app->singleton(TokenServiceInterface::class,function(){
            return $this->tokenServieFactory();
        });
    }

    abstract function userServiceFactory():UserServiceInterface;

    abstract function tokenServieFactory():TokenServiceInterface;
}