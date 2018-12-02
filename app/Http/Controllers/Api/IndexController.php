<?php

namespace App\Http\Controllers\Api;

class IndexController extends AuthenticateController
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['show']);
    }

    public function index(){

        return $this->message('请求成功');
    }
}