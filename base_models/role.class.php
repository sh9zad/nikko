<?php
/**
 * Created by PhpStorm.
 * User: Shervin
 * Date: 5/29/14
 * Time: 5:35 PM
 */

include_once _PATH . 'base/model.class.php';
include_once _PATH . 'base_models/membersroles.class.php';
include_once _PATH . 'base_models/permission.class.php';
include_once _PATH . 'base_controls/acl.class.php';

if (!isset($_SESSION)) {session_start();}

class RoleModel extends Model{

    private $m_r_tbl;
    private $memberRole;
    private $permission;
    private $acl;

    function RoleModel(){
        parent::Model('tbl_roles');

        $this->m_r_tbl = 'tbl_members_roles';
        $this->memberRole = new MembersRolesModel();
        $this->permission = new PermissionModel();

        $this->schema = array(
            "id" => "0",
            "title" => "txt",
            "creator_id" => "num"
        );

        $this->cols = array(
            "id", "title", "creator_id"
        );

        $this->labels = array(
            "ردیف", "عنوان"
            );
    }

    function getList(){
        $query =  "SELECT id FROM `members` WHERE `type` = 0 AND `manager_id` = 0 AND `id` = " .$_SESSION['CID'];
        $result = $this->search($query, array('id'));


        if($result != false && sizeof($result) > 0){
            return parent::getList();
        }
        else {
            $query = "SELECT * FROM `$this->tablename` WHERE `creator_id` NOT IN (SELECT id FROM `members` WHERE `type` = 0 AND `manager_id` = 0)";

            return $this->search($query);
        }
    }

    function getRoles($user_id){
        $query = "select `$this->tablename`.* from `$this->tablename`
                join `$this->m_r_tbl` on `$this->m_r_tbl`.role_id = `$this->tablename`.id
                where `$this->m_r_tbl`.member_id = $user_id";

        //return $query;
        return $this->search($query);
    }

    function insertRoles($user_id, $roles){
        $result = 'false';

        //return $this->deleteRoles($user_id);
        if (!is_array($roles) && $roles != null){
            return $this->deleteRoles($user_id);

            if ($result != false)
                $result = $this->memberRole->insert(array($user_id, $roles, $_SESSION['CID']));
        }
        elseif (is_array($roles) && sizeof($roles) > 0){

            $result = $this->deleteRoles($user_id);
            if ($roles[0] == 'false' || $roles[0] == false && $result != false){
                return true;
            }
            if ($result != false)
                $result = $this->deleteRoles($user_id);
                foreach ($roles as $role){
                   $result = $this->memberRole->insert(array($user_id, $role));
                }
        }
        else{
            return false;
        }

        return $result;
    }

    function getAssignedRoles($user_id){
        $query = "select * from `tbl_roles` where `tbl_roles`.id in ( select role_id from `tbl_members_roles` where member_id = $user_id )";

        return $this->search($query);
    }

    function getNotAssignedRoles($user_id){
        $query = "select * from `tbl_roles` where `tbl_roles`.id not in ( select role_id from `tbl_members_roles` where member_id = $user_id )";

        return $this->search($query);
    }

    function deleteRoles($user_id){
        $query = "DELETE FROM `$this->m_r_tbl` where member_id = $user_id";

        //return $query;

        return $this->search($query);
    }
}