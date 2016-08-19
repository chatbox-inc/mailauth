<?php
namespace Chatbox\ApiAuth;

use Chatbox\Token\TokenServiceInterface;
use Illuminate\Support\ServiceProvider;
use Chatbox\ApiAuth\Http\Controllers\LoginController;
use Chatbox\ApiAuth\Http\Controllers\ProfileController;

use Chatbox\ApiAuth\Domains\UserServiceInterface;

/**
 * SPの役割は注入できるポイントを提供すること
 * キーワードDIの経緯などはApiAuthServiceを参照
 *
 */
abstract class ApiAuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        if($router = $this->getRouter()){
            $this->registerAuthRoute($router);
        }

        $this->app->singleton(UserServiceInterface::class,function(){
            return $this->registerUserServiceInterface();
        });
    }

    abstract protected function registerUserServiceInterface():UserServiceInterface;

    protected function getRouter(){
        return $this->app;
    }

    protected function registerAuthRoute($router){
        $router->post("login",LoginController::class."@login");
        $router->post("logout",LoginController::class."@logout");

        $router->post("profile",ProfileController::class."@create");
        $router->get("profile",ProfileController::class."@load");
        $router->put("profile",ProfileController::class."@update");
        $router->delete("profile",ProfileController::class."@ban");
    }


}