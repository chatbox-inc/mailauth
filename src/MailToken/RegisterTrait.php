<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/19
 * Time: 18:11
 */

namespace Chatbox\MailToken;


trait RegisterTrait
{

    protected function registerMailTokenRoute($router,$entry,$class){
        $router->post ("mail/$entry/send",  "{$class}@send");
        $router->get  ("mail/$entry/check", "{$class}@load");
        $router->post ("mail/$entry/handle","{$class}@handle");
    }

}