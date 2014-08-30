<?php
/**
 * Created by PhpStorm.
 * User: Shervin
 * Date: 5/29/14
 * Time: 5:35 PM
 */


include_once $_SERVER['DOCUMENT_ROOT'].'/localkeeper3g/base/model.class.php';

class ObjectModel extends Model{

    function ObjectModel(){
        parent::Model('tbl_objects');

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