<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 6/17/14
 * Time: 1:22 PM
 */

require_once _PATH . 'base/ajaxcontroller.php';
require_once _PATH . 'base/members.class.php';
include_once _PATH . 'base_models/object.class.php';
include_once _PATH . 'base_models/membertypes.class.php';
include_once _PATH . 'base_controls/acl.class.php';


if (!isset($_SESSION)) {session_start();}

class UserController extends AjaxController{

    private $members;
    private $object;
    private $member_types;
    private $acl;

    function UserController(){
        $this->members = (isset($_SESSION['member'])) ? $_SESSION['member'] : new Members();
        $this->object = new ObjectModel();
        $this->member_types = new MemberTypeModel();
        $this->acl = new ACLController();
    }

    function getlist($arg){
        $result = array();

        if (isset($arg['id'])){
            $result['user'] = $this->members->getList($arg['id']);
            if (sizeof($result['user']) > 0 && $result['user'] != false) {
                $result['user'] = $result['user'][0];
                $result['error'] = "false";
                $result['table_info'] = $this->members->getTableInfo();
            }
            else {
                $result['error'] = "true";
            }
        }
        else {
            $result['users'] = $this->members->getAllUsers();
            $result['types'] = $this->member_types->getList();
        }
        $this->reply($result);
    }

    function deleteuser($arg){
        $this->reply($this->members->delete($arg['id']));
    }

    function adduser($arg){
        if ($this->acl->isSuperAdmin($_SESSION['CID']) || $this->acl->checkPermission($_SESSION['CID'], 'user', 'full|add')){
            $duplicate = $this->members->checkUsername($arg['username']);
            //echo($duplicate);
            $result = array();

            if (is_array($duplicate) && $duplicate[0] > 0){
                $result['success'] = 0;
                $result['msg'] = "Duplicate Username.";

                do{
                    $suggestion = substr($arg['name'], 0, 2) . substr($arg['family'], 0 , 2) . rand(111,222);
                    $duplicate = $this->members->checkUsername($suggestion);
                }while(!is_array($duplicate) || $duplicate[0] == 0);

                $result['suggestion'] = $suggestion;
            }
            else {
                $type = (isset($arg['type'])) ? $arg['type'] : 2;
                $data = array($arg['name'], $arg['family'], $arg['username'], md5($arg['pass']), $type, 1,$arg['email'], 1);
                $result['success'] = 1;
                $result['id'] = $this->members->insert($data);
            }

            $this->reply($result);
        }
        else{

        }
    }

    function getuser($arg){
        $this->reply($this->members->getList($arg['id']));
    }

    function edituser($arg){
        $this->reply($this->members->update(array('name'=>$arg['name'], 'familyname'=>$arg['family'], 'username'=>$arg['username'], 'password'=>$arg['pass'], 'email'=>$arg['email']), $arg['id']));
    }

    function getdashboard($arg){
        $result = null;
        if (!isset($_SESSION['ACL']))
        {
            return $this->reply(null);
        }
        else {
            if ($_SESSION['CID'] == 1){
                $tmp = $this->members->getAllUsers();

                $result['users_no']  = sizeof($tmp);
                $result['u_a_users'] = sizeof($this->members->getUnAssignedUsers());
                $result['object_no'] = sizeof($this->object->getList());
            }
        }

        $this->reply($result);
    }

    function resetpass($arg){
        $this->reply($this->members->resetPassword($arg['user_id'], $arg['pass']));
    }
}
