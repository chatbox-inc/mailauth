<?php
namespace Chatbox\ApiAuth\Domains;
/**
 * 認証用一次発行トークン
 *
 */
interface TokenServiceInterface
{
    // 値の保存
    public function createByUser(User $user):Token;

    // キーを値に変換
    public function loadByToken($key):Token;

    // キーを無効化
    public function inactive($key):Token;


}