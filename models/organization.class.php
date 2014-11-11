<?php
/**
 * Created by PhpStorm.
 * User: Shervin
 * Date: 5/29/14
 * Time: 5:35 PM
 */

include_once _PATH . 'base/model.class.php';

class OrganizationModel extends Model{

    function OrganizationModel()
    {
        parent::Model('organization');

        $this->cols = array(
            "id", "name", "head", "parent_division", "child_trail"
        );

        $this->labels = array(
            "0", "Title", "Head", "Parent Division", "0"
        );

        $this->schema = array(
            "0", "txt", "select|members|name,familyname", "select|divisions|name", "0"
        );

        $this->ids = array(
            "0", "txt-division-name", "txt-division-head", "txt-division-parent", "0"
        );
    }

    function getRoot(){
        $query = "SELECT * FROM `$this->tablename` WHERE `id` = `parent_division`";

        //return $query;
        return $this->search($query);
    }

    function getChildern($trail, $depth = null){
        $query = "SELECT * FROM `$this->tablename` WHERE `child_trail` LIKE '$trail%' ";
        if ($depth != null)
            $query .= "AND ROUND((LENGTH(`child_trail`)-LENGTH(REPLACE(`child_trail`, ',', '')))/LENGTH(',')) = " . ($depth * 2) ;
        else
            $query .= "AND ROUND((LENGTH(`child_trail`)-LENGTH(REPLACE(`child_trail`, ',', '')))/LENGTH(',')) > " . (round((strlen($trail) - strlen(str_replace(',', '', $trail)))/strlen(',')));

        //return $query;

        return $this->search($query);
    }

    function deleteDivision($id){
        if (sizeof($this->getList($id)) > 0)
            $division = $this->getList($id)[0];
        else
            return true;
        $query = "DELETE FROM `$this->tablename` WHERE `id` = $id OR `child_trail` LIKE '".$division['child_trail']."%'";

        //return $query;

        return $this->search($query, array('result'));
    }

    function insert($arg){
        $query = "INSERT INTO `$this->tablename` (`name`, `head`, `parent_division`, `child_trail`)  VALUES (";

        foreach($arg as $data){
            if ($data == null)
                $query .= " NULL, ";
            else
                $query .= "'$data', ";
        }

        $query = substr($query,0,-2);
        $query .= " )";

        //return $query;

        $result = $this->search($query, array('result'));

        if (is_array($result)){
            //return 'helo';
            $result = $this->connection->insert_id;
        }
        else {
            $result = false;
        }

        return $result;
    }

    //function get
}