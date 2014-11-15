<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 10/14/2014
 * Time: 1:10 PM
 */

include_once _PATH . 'base/model.class.php';

class ServiceModel extends Model
{
    function ServiceModel()
    {
        parent::Model('services');

        $this->cols = array(
            "id", "title"
        );

        $this->labels = array(
            "0", "Title"
        );

        $this->schema = array(
            "0", "txt"
        );

        $this->ids = array(
            "0", "txt-service-title"
        );
    }

    function insert($data){
        $result = array();
        $res = parent::insert($data);

        if ($res == false){
            $result['error'] = true;

            if ($this->getMySQLErrorNo() == 1062){
                $result['msg'] = "Error: Duplicated Service Name.";
            }
            else
            {
                $result['msg'] = $this->error;
            }
        }
        else{
            $result['error'] = false;
            $result['id'] = $res;
        }

        return $result;
    }
}