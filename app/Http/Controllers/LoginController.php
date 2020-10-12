<?php

namespace App\Http\Controllers;

use App\Dao\UserDao;
use App\Utils\JsonBuilder;
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
     * @return string
     */
    public function userInfo(Request $request)
    {
        $openId = $request->input('open_id');
        $dao = new UserDao;
        $result = $dao->getUserInfoByOpenid($openId);
        if (empty($result)) {
            return JsonBuilder::Error('未找到用户信息');
        }
        $result['total_order'] = 0;
        $result['order'] = 0;
        $result['complete_order'] = 0;
        return JsonBuilder::Success($result);
    }

    /**
     * 修改用户信息
     * @param Request $request
     */
    public function myInfo(Request $request)
    {

    }

}

