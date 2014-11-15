<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 6/15/14
 * Time: 12:39 PM
 */

require_once _PATH .'base/controller.php';
require_once _PATH.'base_models/object.class.php';
require_once _PATH.'base_models/permission.class.php';
require_once _PATH.'base_models/right.class.php';
require_once _PATH.'base_models/role.class.php';
require_once _PATH . 'base/members.class.php';

class ACLController extends Controller{

    private $objectModel;
    private $permissionModel;
    private $rightModel;
    private $roleModel;
    private $user_id;
    private $roles;
    private $members;

    function ACLController($user_id = null){
        $this->objectModel = new ObjectModel();
        $this->permissionModel = new PermissionModel();
        $this->rightModel = new RightModel();
        $this->roleModel = new RoleModel();
        $this->members = new Members();

        if ($user_id != null){
            $this->user_id = $user_id;

            $this->roles = $this->getRole($user_id);
        }
    }

    function setUser($user_id){
        $this->user_id = $user_id;
        $this->roles = $this->getRole($this->user_id);
    }

    function getRole($user_id){
        unset($this->roles);
        $this->roles = $this->roleModel->getRoles($user_id);
        return $this->roles;
    }

    function isAdministrator($user_id){
        $result = false;
        if ($user_id == 1)
            return true;

        $user = $this->members->getList($user_id);

        if ($user != false && sizeof($user) > 0){
            $user = $user[0];

            if($user['type'] == 1)
                return true;
            else
                return false;
        }
        else{
            return false;
        }

        return $result;
    }

    function isSuperAdmin($user_id){
        if ($user_id == 1)
            return true;

        $user = $this->members->getList($user_id);

        if ($user != false && sizeof($user) > 0){
            $user = $user[0];

            if($user['type'] == 0 && $user['manager_id'] == 0)
                return true;
            else
                return false;
        }
        else{
            return false;
        }
    }

    function checkRole($role_name){
        if(!is_array($this->roles)){
            return false;
        }

        foreach ($this->roles as $role){
            if($role['title'] == $role_name)
                return true;
        }

        return false;
    }

    function checkPermission($user_id, $object, $right){
        $result = false;

        $right = explode('|', $right);

        $result = $this->permissionModel->checkPermission($user_id, $object, $right);
        //return $result;

        return ($result['count'] > 0) ? true : false;
    }
}