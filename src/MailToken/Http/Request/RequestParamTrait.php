<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/25
 * Time: 3:16
 */

namespace Chatbox\MailToken\Http\Request;


use Illuminate\Contracts\Validation\Factory;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;

trait RequestParamTrait
{
    protected function request():Request{
        return app(Request::class);
    }

    protected function validator(array $data,array $rules,array $messages=[],array $custom=[]):Validator{
        /** @var Factory $valiator */
        $valiator = app(Factory::class);
        $val = $valiator->make($data,$rules,$messages,$custom);
        return $val;
    }
}