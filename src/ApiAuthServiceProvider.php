<?php
namespace Chatbox\ApiAuth;

use Chatbox\ApiAuth\Models\Token;
use Chatbox\ApiAuth\Models\User;
use Illuminate\Support\ServiceProvider;
use Chatbox\ApiAuth\Http\Controllers\ProfileController;
use Chatbox\ApiAuth\Http\Controllers\TokenController;

use Chatbox\ApiAuth\Domains\UserServiceInterface;
use Chatbox\ApiAuth\Domains\TokenServiceInterface;
use Laravel\Lumen\Application;


/**
 * SPの役割は注入できるポイントを提供すること
 *
 */
class ApiAuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $app = $this->app;
        $app->singleton(UserServiceInterface::class,function(){
            return new User;
        });
        $app->singleton(TokenServiceInterface::class,function(){
            return new Token;
        });
    }
}