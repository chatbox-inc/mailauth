<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/06
 * Time: 1:43
 */

namespace Chatbox\ApiAuth\Domains;


class User implements \JsonSerializable
{
    public $userId;

    public $data;

    public $filter;

    /**
     * User constructor.
     * @param $userId
     * @param $data
     */
    public function __construct($userId, array $data,callable $filter = null)
    {
        $this->userId = $userId;
        $this->data = $data;
    }

    function jsonSerialize()
    {
        if($this->filter){
            return call_user_func($this->filter,$this->data);
        }else{
            return $this->data;
        }
    }


}