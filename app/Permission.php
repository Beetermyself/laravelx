<?php namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    /**
     * 创建权限
     * @param $name
     * @param $displayName
     * @param $description
     * @param $roleId
     * @return bool
     */
    public function createPermission($name , $displayName , $description , $roleId){

        try {
            $permission = new Permission();
            $permission->name = $name;
            $permission->display_name = $displayName;
            $permission->description = $description;
            $permission->save();
            $role = Role::find($roleId);
            if($role){
                $role->attachPermission($permission);
            }
        }catch (\Exception $e){
            return false;
        }
        return true;
    }
}