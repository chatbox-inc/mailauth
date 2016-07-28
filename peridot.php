<?php
use Evenement\EventEmitterInterface;

class IlluminateKernelScope extends \Peridot\Core\Scope{

    use \Laravel\Lumen\Testing\Concerns\MakesHttpRequests;

    protected $app;

    protected $baseUrl = 'http://localhost';

    public function __construct($app)
    {
        $this->app = $app;
        $this->client = $this;
    }
}

return function(EventEmitterInterface $emitter) {
    $emitter->on("runner.start",function(){
        $app = require __DIR__ . "/sample/app.php";
        $scope = new IlluminateKernelScope($app);
        $rootSuite = \Peridot\Runner\Context::getInstance()->getCurrentSuite();
        $rootSuite->getScope()->peridotAddChildScope($scope);
    });
};


