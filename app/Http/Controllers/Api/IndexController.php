<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\User as UserResource;
use App\Permission;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Role;
use Illuminate\Http\Request;

class IndexController extends AuthenticateController
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('addRoleName');
    }

    public function index(){

        //获取用户个人信息

        $userinfo = Auth::user();

        $userid   = $userinfo->id;

        Log::info('用户信息'.$userid);

        return $this->success(new UserResource(User::where('id',$userid)->first()),'获取个人信息成功');

    }

    //创建用户权限

    public function addRoleName(Request $request,Role $role){

        $input = $request->all();

        $role->createRole('admin','管理员','第一个权限');

        return $this->success([$input],'新增权限成功');

    }

    //添加权限
    public function setUserRole(Request $request,Role $role){

        $userid = Auth::id();
        $roleid = $request->input('roleid');
        $status = $role->distributeRole($userid,$roleid);

        return $this->success(['status'=>$status],'设置用户权限');
    }

    //创建权限
    public function createPermission(Request $request,Permission $permission){

        $userid = Auth::id();
        $roleid = $request->input('roleid');
        $status = $permission->createPermission($userid,$roleid);

        return $this->success(['status'=>$status],'设置权限管理');

    }
}