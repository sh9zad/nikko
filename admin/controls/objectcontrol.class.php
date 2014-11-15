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
        return $this->reply($this->object->insert(array($arg['title'])));
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