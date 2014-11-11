<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 10/12/2014
 * Time: 10:33 AM
 */

include_once _PATH . 'base/model.class.php';

class InputModel extends Model
{
    function InputModel()
    {
        parent::Model('tbl_inputs');

        $this->cols = array(
            "id", "message", "sender", "scode", "text", "date", "is_processed"
        );

        $this->labels = array(
            "0", "Message", "From", "To", "Text", "Date", "Processed"
        );

        $this->schema = array(
            "0", "txt", "txt", "txt", "txt", "txt", "num"
        );

        $this->ids = array(
            "0", "txt-input-message", "txt-input-from", "txt-input-to", "txt-input-test", "txt-input-message-date", "txt-input-message-processed"
        );
    }

    function insert($arg){
        $query = "INSERT INTO `$this->tablename` (`message`, `sender`, `scode`, `text`)  VALUES (";
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
            $result = $this->connection->insert_id;
        }
        else {
            $result = false;
        }

        return $result;
    }
}