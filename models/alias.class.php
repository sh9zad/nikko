<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 10/14/2014
 * Time: 1:12 PM
 */

include_once _PATH . 'base/model.class.php';
include_once _PATH . 'models/services.class.php';

class AliasModel extends Model
{
    function AliasModel()
    {
        parent::Model('service_alias');

        $this->cols = array(
            "id", "service_id", "alias"
        );

        $this->labels = array(
            "0", "0", "Alias"
        );

        $this->schema = array(
            "0", "0", "txt"
        );

        $this->ids = array(
            "0", "txt-service-alias"
        );
    }

    function getServiceID($alias_name){
        $query = "SELECT * FROM `$this->tablename` WHERE `alias` = '$alias_name'";

        return $this->search($query);
    }

    function getAliasByService($service_id){
        $query = "SELECT * FROM `$this->tablename` WHERE `service_id` = $service_id";

        //return $query;

        return $this->search($query);
    }
}