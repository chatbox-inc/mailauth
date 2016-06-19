<?php
namespace Chatbox\PageApp;

use Chatbox\Lumen\Providers\SessionServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\FileViewFinder;
use Illuminate\Session\Middleware\StartSession;


/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/06/05
 * Time: 23:37
 */
class ApiAuthServiceProvider extends ServiceProvider
{
    public function register()
    {


        $router = $this->app;

    }

    protected function registerRoute($router){

        $router->post("api/login",ProfileController::class."@login");
        $router->post("api/logout",ProfileController::class."@logout");

        $router->post("api/register",ProfileController::class."@create");
        $router->get("api/profile",ProfileController::class."@load");
        $router->put("api/profile",ProfileController::class."@update");
        $router->delete("api/profile",ProfileController::class."@ban");

    }

}