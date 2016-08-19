<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/30
 * Time: 19:14
 */

namespace Chatbox\MailAuth\Specs;


trait HttpSpecTrait
{
    /**
     * @return Response
     */
    protected function response(){
        $response = $this->lumen->response();
        return $response;
    }

    protected function body($raw=true){
        if($raw){
            $body = $this->response()->getOriginalContent();
            return $body;
        }else{
            return json_decode($this->response()->getContent(),true);
        }
    }

}