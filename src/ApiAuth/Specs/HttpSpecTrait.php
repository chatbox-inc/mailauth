<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/30
 * Time: 19:14
 */

namespace Chatbox\ApiAuth\Specs;

use Illuminate\Http\Response;
use Peridot\Plugin\Lumen\LumenAppScope;

trait HttpSpecTrait
{

    abstract protected function lumen():LumenAppScope;

    /**
     * @return Response
     */
    protected function response(){
        $response = $this->lumen()->response();
        return $response;
    }

    /**
     * @param bool $raw
     * @return mixed
     */
    protected function body($raw=true){
        if($raw){
            $body = $this->response()->getOriginalContent();
            return $body;
        }else{
            return json_decode($this->response()->getContent(),true);
        }
    }

    public function assertResponseOk(){
        $e = $this->response()->exception ?: "response code should be 200";
        assert($this->response()->getStatusCode() === 200,$e);
    }

    public function retrieveException(){
        return $this->response()->exception;
    }
}