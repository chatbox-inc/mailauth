<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/18
 * Time: 15:55
 */

namespace Chatbox\ApiAuth;

use Chatbox\ApiAuth\Http\Controllers\TokenController;
use Chatbox\ApiAuth\Http\Controllers\ProfileController;


trait RegisterRouteTrait
{
    protected function registerAuthRoute($router){
        $router->post("login",TokenController::class."@login");
        $router->post("logout",TokenController::class."@logout");

        $router->post("profile",ProfileController::class."@create");
        $router->get("profile",ProfileController::class."@load");
        $router->put("profile",ProfileController::class."@update");
        $router->delete("profile",ProfileController::class."@ban");
    }
}