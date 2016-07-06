<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/02
 * Time: 11:40
 */

namespace Chatbox\ApiAuth\Tests;

class TestCase extends \Laravel\Lumen\Testing\TestCase
{
    /**
     * Creates the application
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        static $app = null;
        if($app === null){
            $app = app();
        }
        return clone $app;
    }
}