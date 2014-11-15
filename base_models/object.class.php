<?php
/**
 * Created by PhpStorm.
 * User: Shervin
 * Date: 5/29/14
 * Time: 5:35 PM
 */


include_once _PATH. 'base/model.class.php';

class ObjectModel extends Model{

    function ObjectModel(){
        parent::Model('tbl_objects');

        $this->schema = array(
            "id" => "0",
            "title" => "txt",
            "creator_id" => "0"
        );

        $this->cols = array(
            "id", "title", "creator_id"
        );

        $this->labels = array(
            "ردیف", "عنوان", "سازنده"
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
}