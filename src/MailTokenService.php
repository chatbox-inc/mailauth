<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/26
 * Time: 8:36
 */

namespace Chatbox\MailAuth;

use Chatbox\Token\Storage\DB\TaggableDB;
use Chatbox\Token\Storage\TokenStorageInterface;
use Chatbox\Token\TokenService;

class MailTokenService extends TokenService
{
    public function __construct(TaggableDB $storage)
    {
        parent::__construct($storage);
    }

    public function setTag($tag){
        $this->storage = $this->storage->copy($tag);
        return $this;
    }
}