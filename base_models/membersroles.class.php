<?php
/**
 * Created by PhpStorm.
 * User: Shervin
 * Date: 5/29/14
 * Time: 5:35 PM
 */

include_once $_SERVER['DOCUMENT_ROOT'].'/localkeeper3g/base/model.class.php';

class MembersRolesModel extends Model{

    function MembersRolesModel(){
        parent::Model('tbl_members_roles');

        $this->schema = array(
            "id" => "key",
            "member_id" => "required",
            "role_id" => "required"
        );

        $this->cols = array(
            "id", "member_id", "role_id"
        );
    }
}