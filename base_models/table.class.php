<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 10/1/2014
 * Time: 9:15 AM
 */

include_once _PATH . 'base/model.class.php';
include_once _PATH . 'include/db_connect.php';

class TableModel extends Model{

    function TableModel($table_name){
        $this->tablename = $table_name;

        $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".DATABASE."' AND TABLE_NAME = '$this->tablename'";

        $result = $this->search($query, array('COLUMN_NAME'));

        $this->cols = array();

        foreach($result as $col_name){
            array_push($this->cols, $col_name['COLUMN_NAME']);
        }
    }

    function getColumnNames(){
        return $this->cols;
    }
}