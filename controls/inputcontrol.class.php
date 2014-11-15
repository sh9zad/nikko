<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 10/12/2014
 * Time: 10:38 AM
 */

require_once _PATH . "base/controller.php";
require_once _PATH . "base_controls/acl.class.php";
require_once _PATH . "models/inputs.class.php";

if (!isset($_SESSION)) {session_start();}

class InputController extends Controller{
    private $input_model;
    private $acl;

    function InputController(){
        $this->input_model = new InputModel();
        $this->acl = new ACLController();
    }

    function insert_input($arg, $is_test = false){
        $result = $this->input_model->insert($arg);
        //echo $result;
        if ($is_test == true) {
            if ($result != 0) {
                $record = $this->input_model->getList($result)[0];
                $_SESSION['record'] = $record;
                unset($_SESSION['error']);
            } else {
                $_SESSION['error'] = "Error in Inserting Record";
            }

            header('Location: index.php');
        }
        elseif($is_test == false){
            return $result;
        }
    }

    function getrecord($arg){
        return $this->input_model->getList($arg['id']);
    }
}