<?php
namespace Chatbox\RestApp\Http\Controllers\Mail;
use Chatbox\Mailtoken\Http\vvMailTokenRequest;
use Chatbox\Token\Storage\Eloquent\TaggableEloquent;
use Chatbox\Token\Token;
use Chatbox\Mailtoken\Http\MailTokenController;
use Chatbox\Token\TokenService;
use Chatbox\Token\TokenServiceInterface;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/18
 * Time: 16:05
 */
abstract class AbstractMailTokenController extends MailTokenController
{
    public function __construct(MailTokenRequest $request)
    {
        $storage = $this->constructStorage();
        $token = new TokenService($storage);
        parent::__construct($token, $request);
    }

    abstract function constructStorage():TaggableEloquent;

    protected function sendmail($email, array $data)
    {
        return null;
    }

    protected function handleToken(Token $token)
    {
        return [
            "token" => [
                "key" => $token->key,
                "value" => $token->value,
                "created_at" => $token->createdAt,
            ]
        ];

    }

    protected function handleError(\Exception $e)
    {
        throw $e;
    }



}