<?php

namespace App\Dao;

use App\Models\User;

class UserDao
{
    public function getUserInfoByOpenid($openId)
    {
        return User::where('open_id', $openId)->first();
    }
}
