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
    protected $options = [];

    public function __construct($app)
    {
        parent::__construct($app);
    }

    protected function option($key,$default = true){
        return array_get($this->options,$key,true);
    }

    public function register()
    {
        $this->registerRoute($this->app);
        $this->registerService($this->app);
    }

    protected function registerService(Application $app){
        if (! $this->option("register.service")) return ;
        $app->singleton(UserServiceInterface::class,function(){
            return new User;
        });
        $app->singleton(TokenServiceInterface::class,function(){
            return new Token;
        });
    }

    public function registerRoute($router){
        if (! $this->option("register.route")) return ;

        $router->post("login",TokenController::class."@login");
        $router->post("logout",TokenController::class."@logout");

        $router->post("profile",ProfileController::class."@create");
        $router->get("profile",ProfileController::class."@load");
        $router->put("profile",ProfileController::class."@update");
        $router->delete("profile",ProfileController::class."@ban");
    }

}