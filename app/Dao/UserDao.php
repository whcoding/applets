<?php

namespace App\Dao;

use App\Models\User;

class UserDao
{
    /**
     * 根据openid 获取用户信息
     * @param $openId
     * @return mixed
     */
    public function getUserInfoByOpenId($openId)
    {
        return User::where('open_id', $openId)->first();
    }

    /**
     * 根据openid 修改用户信息
     * @param $openId
     * @param $data
     * @return mixed
     */
    public function updateUserInfoByOpenId($openId, $data)
    {
        return User::where('open_id', $openId)->update($data);
    }

}
