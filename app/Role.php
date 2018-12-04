<?php namespace App;

use Illuminate\Support\Facades\Log;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    /**
     * 创建角色
     * @param $name
     * @param $display_name
     * @param $description
     * @return bool
     * @throws \Exception
     */
    public function createRole($name,$display_name,$description){

        try {
            $role = new Role();
            $role->name = $name;
            $role->display_name = $display_name;
            $role->description = $description;

            //判断权限是否存在
            $count = Role::where(['name'=>$role->name])->count();

            Log::info('角色是否存在:'.$count);

            if($count == 0){
                $role->save();
            }
        }catch (\Exception $e){
            Log::info($e->getMessage());
            throw new \Exception('创建角色失败');
        }
        return true;
    }

    /**
     * 给用户添加角色
     * @param $userId
     * @param $roleId
     * @return bool
     * @throws \Exception
     */
    public function distributeRole($userId,$roleId){

        try{
            $user = User::find($userId);
            $user->attachRole($roleId);
        }catch (\Exception $e){
            Log::info($e->getMessage());
            throw new \Exception('角色分配失败');
        }
        return true;
    }
}