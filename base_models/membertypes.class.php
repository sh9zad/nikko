<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 11/8/2014
 * Time: 5:28 PM
 */

include_once _PATH. 'base/model.class.php';

class MemberTypeModel extends Model{

    function MemberTypeModel(){
        parent::Model('tbl_member_types');

        $this->schema = array(
            "id" => "key",
            "title" => "required"
        );

        $this->cols = array(
            "id", "title"
        );

        $this->labels = array(
            "ردیف", "عنوان"
        );
    }
}