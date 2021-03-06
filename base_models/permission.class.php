<?php
/**
 * Created by PhpStorm.
 * User: Shervin
 * Date: 5/29/14
 * Time: 5:35 PM
 */

include_once _PATH . 'base/model.class.php';
include_once _PATH . 'utility/datecalc.class.php';

class PermissionModel extends Model{

    private $dateCalc;

    function PermissionModel(){
        parent::Model('tbl_permissions');

        $this->schema = array(
            "id" => "key",
            "object_id" => "required",
            "right_id" => "required",
            "role_id" => "required",
            "table_name" => "required",
            "column_name" => "required",
            "create_date" => "required"
        );

        $this->cols = array(
            "id", "object_id", "right_id", "role_id", "table_name", "column_name", "create_date"
        );

        $this->labels = array(
            "ردیف", "عنوان"
            );

        $this->dateCalc = new DateCalc();
    }

    function insertPermissions($role_id, $isTable, $object_permissions, $table_name = false){
        $result = false;

        if ($table_name === false)
            $result = $this->deleteRolePermissions($role_id);
        else
            $result = $this->deleteRolePermissions($role_id, $table_name);

        if ($object_permissions == false)
            return $result;

        foreach ($object_permissions as $object_permission){
            $object_permission = explode("-", $object_permission);
            if($isTable === false)
                $result = $this->insert(array($object_permission[0], $object_permission[1], $role_id, null, null,date('Y-m-d')));
            elseif ($isTable === true){
                $result = $this->insert(array(null, $object_permission[1], $role_id, $table_name, $object_permission[0],date('Y-m-d')));
            }
        }

        return $result;
    }

    function getAssignedPermission($role_id){
        $query = "select `tbl_permissions`.* from `tbl_permissions`
                    join `tbl_rights` on `tbl_permissions`.right_id = `tbl_rights`.id
                    where `tbl_permissions`.role_id = $role_id ";

        return $this->search($query);
    }

    function getAssignedPermissionTable($role_id, $table_name){
        $query = "select `tbl_permissions`.* from `tbl_permissions`
                    join `tbl_rights` on `tbl_permissions`.right_id = `tbl_rights`.id
                    where `tbl_permissions`.role_id = $role_id AND `tbl_permissions`.`table_name` = '$table_name'";
        //return $query;
        return $this->search($query);
    }

    function checkPermission($user_id, $object, $rights){

        $query = "SELECT COUNT(*) FROM `$this->tablename` where
                `$this->tablename`.object_id in (select `tbl_objects`.id from `tbl_objects` where `tbl_objects`.title = '$object') and
                `$this->tablename`.right_id in (select `tbl_rights`.id from `tbl_rights` where ";
            foreach($rights as $right)
            {
                $query .= " `tbl_rights`.title ='".$right."' OR";

            }
        $query = trim($query, " OR");
        $query .=") and
                `$this->tablename`.role_id IN ( select `tbl_roles`.id from `tbl_roles`
                                                join `tbl_members_roles` on `tbl_members_roles`.role_id = `tbl_roles`.id
                                                where `tbl_members_roles`.member_id = $user_id )";

        //return $query;
        $result = $this->search($query, array('count'));

        return $result[0];
    }

    private function deleteRolePermissions($role_id, $table_name = false){

        if ($table_name === false)
            $query ="delete from `$this->tablename` where `$this->tablename`.role_id = $role_id";
        else
            $query = "delete from `$this->tablename` where `$this->tablename`.table_name = $table_name";

        return $this->search($query);

    }
}