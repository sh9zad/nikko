<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 10/14/2014
 * Time: 1:14 PM
 */

if (!isset($_SESSION)) {session_start();}

include_once _PATH . "base/ajaxcontroller.php";
include_once _PATH . "base_controls/acl.class.php";
include_once _PATH . "models/services.class.php";
include_once _PATH . "models/alias.class.php";

class ServiceController extends AjaxController{
    private $service_model;
    private $service_alias;
    private $acl;

    function ServiceController(){
        $this->service_model = new ServiceModel();
        $this->service_alias = new AliasModel();
        $this->acl = new ACLController();
    }

    function getserviceid($arg){
        if (isset($arg['service'])){
            return $this->service_alias->getServiceID($arg['service']);
        }
        else {
            return false;
        }
    }

    function getlist($arg){
        if (!isset($arg['id'])) {
            $result['services'] = $this->service_model->getList();
            $result['alias'] = $this->service_alias->getList();
        }
        else{
            $result['services'] = $this->service_model->getList($arg['id']);
            $result['alias'] = $this->service_alias->getAliasByService($arg['id']);
        }
        $this->reply($result);
    }

    function addservice($arg){
        if($_SESSION['CID'] == 1 || $this->acl->checkPermission($_SESSION['CID'], "service", "full|add")) {
            $this->reply($this->service_model->insert(array($arg['service'])));
        }
        else {
            $result['error'] = true;
            $result['msg'] = "Permission denied for adding service.";

            $this->reply($result);
        }
    }

    function deleteservice($arg){
        $result = array();
        if ($_SESSION['CID'] == 1 || $this->acl->checkPermission($_SESSION['CID'], "service", "full|delete")){
            if ($this->service_model->delete($arg['id']) == true){
                $result['error'] = false;
                $result['msg'] = "Record deleted successfully";
            }
            else {
                $result['error'] = true;
                $result['msg'] = $this->service_model->error;
            }
        }
        else {
            $result['error'] = true;
            $result['msg'] = "Permission denied for DELETE action.";
        }

        $this->reply($result);
    }

    function updateservice($arg){
        $result = array();

        if ($_SESSION['CID'] == 1 || $this->acl->checkPermission($_SESSION['CID'], 'service', 'full|edit')) {
            if ($this->service_model->update(array('title' => $arg['service']), $arg['id']) != false) {
                $result['error'] = false;
                $result['msg'] = "Service Update Completed.";
            } else {
                $result['error'] = true;
                $result['msg'] = $this->service_model->error;
            }
        } else {
            $result['error'] = true;
            $result['msg'] = "Permission denied for service update";
        }

        $this->reply($result);
    }

    function addalias($arg){
        $result = array();
        if($_SESSION['CID'] == 1 || $this->acl->checkPermission($_SESSION['CID'], "alias", "full|add")){
            $id = $this->service_alias->insert(array($arg['service_id'], $arg['alias']));
            if( $id != false){
                $result['error'] = false;
                $result['id'] = $id;
                $result['msg'] = "Alias added successfully.";
            }
            else {
                $result['error'] = true;
                $result['msg'] = $this->service_alias->error;
            }
        }
        else {
            $result['error'] = true;
            $result['msg'] = 'Permission denied for adding alias.';
        }

        $this->reply($result);
    }
}