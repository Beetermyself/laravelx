<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IndexController extends AuthenticateController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){

        //获取用户个人信息

        $userinfo = Auth::user();

        $userid   = $userinfo->id;

        Log::info('用户信息'.$userid);

        return $this->success(new UserResource(User::where('id',$userid)->first()),'获取个人信息成功');

    }
}