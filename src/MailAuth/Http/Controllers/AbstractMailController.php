<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/25
 * Time: 6:05
 */

namespace Chatbox\MailAuth\Http\Controllers;

use Chatbox\MailAuth\MailAuthMailSenderInterface;
use Chatbox\MailAuth\MailTokenService;
use Chatbox\MailToken\Http\MailTokenController;
use Chatbox\MailToken\Http\MailTokenRequest;
use Chatbox\Token\TokenServiceInterface;

abstract class AbstractMailController extends MailTokenController
{
}