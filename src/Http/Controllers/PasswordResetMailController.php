<?php
namespace Chatbox\MailAuth\Http\Controllers;
use Chatbox\Token\Token;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/25
 * Time: 6:04
 */
class PasswordResetMailController extends AbstractMailController
{
    protected $type="passwordReset";

    protected function handle(Token $token)
    {
    }
}