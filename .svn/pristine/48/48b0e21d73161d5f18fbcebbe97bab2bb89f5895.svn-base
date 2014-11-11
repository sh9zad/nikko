<?php
/**
 * Created by PhpStorm.
 * User: hossein.sajjadi
 * Date: 11/2/14
 * Time: 10:02 AM
 */

if (!isset($_SESSION)) {session_start();}

include_once _PATH . "base/ajaxcontroller.php";
include_once _PATH . "base_controls/acl.class.php";
include_once _PATH . "models/categories.class.php";

class CategoriesController extends AjaxController{
    private $categories;
    function CategoriesController(){
        $this->categories = new CategoriesModel();
    }
    function getcategories($arg){
        if ($_SESSION['ACL']->checkPermission($_SESSION['CID'], 'forum', 'full')){
            $tables = array(); $result = array();
            $result['table'] = $this->categories->getTableInfo();
            $result['data'] = $this->categories->getList();
            return $this->reply($result);
        }
    }
    function addcategories($arg){
        if ($_SESSION['ACL']->checkPermission($_SESSION['CID'], 'forum', 'full')){
            return $this->reply($this->categories->insert(array($arg['catname'],$arg['mokeyword'])));
        }
    }
    function deletecat($arg){
        if ($_SESSION['ACL']->checkPermission($_SESSION['CID'], 'forum', 'full')){
            return $this->reply($this->categories->delete($arg['id']));
        }
    }
}