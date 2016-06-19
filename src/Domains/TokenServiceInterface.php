<?php
namespace Chatbox\ApiAuth\Domains;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/06/17
 * Time: 14:38
 */
interface TokenServiceInterface
{
    // 値の保存
    public function save($data);

    // キーを値に変換
    public function load($key);
}