<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 6/17/14
 * Time: 10:41 AM
 */

require_once _PATH . 'base/ajaxcontroller.php';
require_once _PATH . 'base_models/right.class.php';

if (!isset($_SESSION)) {session_start();}

class RightController extends AjaxController{

    private $right;

    function RightController(){
        $this->right = new RightModel();
    }

    function getlist($arg){
        $this->reply($this->right->getList());
    }

    function addright($arg){
        $this->reply($this->right->insert(array($arg['title'])));
    }

    function deleteright($arg){
        $this->reply($this->right->delete($arg['id']));
    }

    function getright($arg){
        $this->reply($this->right->getList($arg['id']));
    }

    function editright($arg){
        return $this->reply($this->right->update(array('title'=>$arg['title']),$arg['id']));
    }

}
