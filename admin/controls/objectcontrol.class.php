<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 6/16/14
 * Time: 10:07 AM
 */

require_once _PATH . 'base/ajaxcontroller.php';
require_once _PATH . 'base_models/object.class.php';

if (!isset($_SESSION)) {session_start();}

class ObjectController extends AjaxController{

    private $object;

    function ObjectController(){
        $this->object = new ObjectModel();
    }

    function getlist($arg){
        $this->reply($this->object->getList());
    }

    function addobject($arg){
        $c_id = (isset($_SESSION['CID'])) ? $_SESSION['CID'] : null;
        return $this->reply($this->object->insert(array(strtolower($arg['title']), $c_id)));
    }

    function deleteobject($arg){
        return $this->reply($this->object->delete($arg['id']));
    }

    function getobject($arg){
        return $this->reply($this->object->getList($arg['id']));
    }

    function editobject($arg){
        return $this->reply($this->object->update(array('title'=>$arg['title']),$arg['id']));
    }
}