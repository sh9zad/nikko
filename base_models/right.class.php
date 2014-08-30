<?php
/**
 * Created by PhpStorm.
 * User: Shervin
 * Date: 5/29/14
 * Time: 5:35 PM
 */

$_SERVER['DOCUMENT_ROOT'].'/localkeeper3g/base/model.class.php';

class RightModel extends Model{

    function RightModel(){
        parent::Model('tbl_rights');

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