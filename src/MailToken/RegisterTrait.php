<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/19
 * Time: 18:11
 */

namespace Chatbox\Mailtoken;


trait RegisterTrait
{

    protected function registerMailTokenRoute($router,$entry,$class){
        $router->get ("mail/$entry/send",  "{$class}@load");
        $router->post("mail/$entry/check", "{$class}@send");
        $router->post("mail/$entry/handle","{$class}@handle");
    }

}