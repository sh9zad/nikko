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

class ACLController extends Controller{

    private $objectModel;
    private $permissionModel;
    private $rightModel;
    private $roleModel;
    private $user_id;
    private $roles;

    function ACLController($user_id = null){
        $this->objectModel = new ObjectModel();
        $this->permissionModel = new PermissionModel();
        $this->rightModel = new RightModel();
        $this->roleModel = new RoleModel();

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
        $roles = $this->roleModel->getRoles($user_id);

        if (!is_array($roles)){
            $result = false;
            return $result;
        }

        foreach($roles as $role){
            if ($role['id'] == "1")
                //echo ('hi');
                $result = true;
        }

        return $result;
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