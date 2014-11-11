<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 10/1/2014
 * Time: 9:12 AM
 */

include_once _PATH . 'base/ajaxcontroller.php';
include_once _PATH . 'base_models/object.class.php';
include_once _PATH . 'include/db_connect.php';
include_once _PATH . 'base_models/table.class.php';

class DBController extends AjaxController{

    private $tables = array();
    private $table_names = array();
    private $object;

    function DBController(){
        $this->object = new ObjectModel();
        $query = "SELECT
                    TABLE_NAME
                  FROM information_schema.TABLES
                  WHERE
                    TABLE_SCHEMA='".DATABASE."'
                  AND LEFT(TABLE_NAME, 4)<>'tbl_'";

        $result = $this->object->search($query, array('table_name'));

        foreach($result as $table){
            $this->tables[$table['table_name']] = new TableModel($table['table_name']);
            array_push($this->table_names, $table['table_name']);
        }
    }

    function gettables($arg){
        if (array_key_exists('table_name', $arg) && $arg['table_name'] != null){
            $this->reply($this->tables[$arg['table_name']]);
        }
        else {
            $this->reply($this->tables);
        }
    }

    function gettablenames($arg, $is_ajax = true){
        if ($is_ajax)
            $this->reply($this->table_names);
        else
            return $this->table_names;
    }

    function getdetails($arg){
        $this->reply($this->tables[$arg['table_name']]->getColumnNames());
    }
}