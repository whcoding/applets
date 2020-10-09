<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat\Factory;

class LoginController extends Controller
{

    public function index(Request $request)
    {
        $code = $request->input('code');
        $app = Factory::miniProgram(config('wechat.mini_program.default'));
        dd($app->auth->session('051way000zmbqK1l4O200Qi1qY3way0Z'));
    }

}

