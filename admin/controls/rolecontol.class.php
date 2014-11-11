<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 6/16/14
 * Time: 2:31 PM
 */

require_once _PATH . 'base/ajaxcontroller.php';
require_once _PATH . 'base_models/role.class.php';
require_once _PATH . 'base_models/object.class.php';
require_once _PATH . 'base_models/right.class.php';
require_once _PATH . 'base_models/permission.class.php';
require_once _PATH . 'base_controls/db.class.php';

if (!isset($_SESSION)) {session_start();}


class RoleController extends AjaxController{

    private $role;
    private $right;
    private $object;
    private $permission;
    private $tables_control;

    function RoleController(){
        $this->role = new RoleModel();
        $this->right = new RightModel();
        $this->object = new ObjectModel();
        $this->permission = new PermissionModel();

        $this->tables_control = new DBController();
    }

    function getlist($arg){
        $this->reply($this->role->getList());
    }

    function addrole($arg){
        $this->reply($this->role->insert(array($arg['title'])));
    }

    function deleterole($arg){
        $this->reply($this->role->delete($arg['id']));
    }

    function getrole($arg){
        $this->reply($this->role->getList($arg['id']));
    }

    function editrole($arg){
        return $this->reply($this->role->update(array('title'=>$arg['title']),$arg['id']));
    }

    function assign($arg){
        $result["users"]   = $_SESSION['member']->getList($arg['user_id']);
        $result['roles_a'] = $this->role->getAssignedRoles($arg['user_id']);
        $result["roles_u"]   = $this->role->getNotAssignedRoles($arg['user_id']);

        $this->reply($result);
    }

    function doassign($arg){
        $result = false;

        if (!isset($arg['roles'])){
            $this->reply(false);
        }

        $roles = $arg['roles'];
        $roles = explode(',', $roles);

        if ($roles == false || sizeof($roles) == 0){
            $this->reply(false);
        }

       $this->reply($this->role->insertRoles($arg['user_id'], $roles));
    }

    function assignpermission($arg){
        $result['role'] = $this->role->getList($arg['id']);
        $result['objects'] = $this->object->getList();
        $result['rights'] = $this->right->getList();
        $result['assigned'] = $this->permission->getAssignedPermission($arg['id']);

        $this->reply($result);
    }

    function assigntablepermission($arg){
        $result['role'] = $this->role->getList($arg['id']);
        $result['tables'] = $this->tables_control->gettablenames(null, false);
        $result['rights'] = $this->right->getList();
        $result['assigned'] = $this->permission->getAssignedPermission($arg['id']);

        $this->reply($result);
    }

    function doassignperm($arg){
        $perm = $arg['perm'];

        if ($perm != false){
            $perm = explode(',', $perm);
        }


        $this->reply($this->permission->insertPermissions($arg['id'], $perm));
    }
}