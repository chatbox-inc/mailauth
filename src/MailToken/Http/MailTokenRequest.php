<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/17
 * Time: 22:22
 */

namespace Chatbox\MailToken\Http;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Validation\ValidationException;

class MailTokenRequest
{
    protected $request;

    protected $validator;

    public function __construct(Request $request,Factory $validator)
    {
        $this->request = $request;
        $this->validator = $validator;
    }

    public function validate($data,$rule,array $message=[],array $customAttributes=[]){
        $validator = $this->validator->make($data,$rule,$message,$customAttributes);
        if($validator->passes()){
            return $data;
        }else{
            throw new ValidationException($validator);
        }
    }

    public function request():Request{
        return $this->request;
    }

    public function mailaddress(){
        $rules = [
            "email"=>["required","email"],
            "data" => ["array"]
        ];
        $passed = $this->validate($this->request->all(),$rules);
        return array_merge($passed["data"],[
            "email" => $passed["email"]
        ]);
    }

    public function token(){
        $rules = [
            "token"=>["required"]
        ];
        $passed = $this->validate([
            "token" => $this->request->header("X-MAILTOKEN")
        ],$rules);
        return $passed["token"];
    }


}