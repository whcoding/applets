<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat\Factory;

class LoginController extends Controller
{
    /**
     * 微信登录
     */
    public function index(Request $request)
    {
        $code = $request->input('code');
        $app = Factory::miniProgram(config('wechat.mini_program.default'));
        $app->auth->session('051way000zmbqK1l4O200Qi1qY3way0Z');
    }

    /**
     * 用户信息
     * @param Request $request
     */
    public function userInfo(Request $request)
    {
        $request->input('user_id');

    }

}

