<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 3/16/14
 * Time: 1:10 PM
 */

//require_once "../include/constants.inc";
require_once _PATH . "base/controller.php";
require_once _PATH . "base/members.class.php";
require_once _PATH . "base_controls/acl.class.php";


if (!isset($_SESSION)) {session_start();}

class MainController extends Controller{

    private $members;
    private $acl;

    function MainController(){
        parent::Controller();
        $this->acl = new ACLController();
    }

    function notadmin(){
       $this->_load_view('accessdenied');
    }

    function enter(){
        $this->_load_view('home');
    }

    function login($arg){

        if (isset($arg['username']) && isset($arg['pass'])) {
            $_SESSION['RES'] = $_SESSION['member']->login($arg['username'], $arg['pass']);
            $_SESSION['ER']  = $_SESSION['member']->getError();

            $this->_load_view('home');
        }
    }

    function home(){
        $this->_load_view('home');
    }

    function lists(){
        $this->_load_view('list');
    }

    function LogOut(){
        $this->members->LogOut();
        header('Location: index.php?control=main&action=main');
    }

    function user(){
        if ($this->acl->checkPermission($_SESSION['CID'], 'users', 'full|view|add|delete|update') || $this->acl->isSuperAdmin($_SESSION['CID']))
            $this->_load_view('user');
        else
            $this->notadmin();
    }

    function object(){
        if ($this->acl->checkPermission($_SESSION['CID'], 'users', 'full|view|add|delete|update') || $this->acl->isSuperAdmin($_SESSION['CID']))
            $this->_load_view('object');
        else
            $this->notadmin();
    }

    function role(){
        if ($this->acl->checkPermission($_SESSION['CID'], 'users', 'full|view|add|delete|update') || $this->acl->isSuperAdmin($_SESSION['CID']))
            $this->_load_view('role');
        else
            $this->notadmin();
    }

    function right(){
        if ($this->acl->checkPermission($_SESSION['CID'], 'users', 'full|view|add|delete|update') || $this->acl->isSuperAdmin($_SESSION['CID']))
            $this->_load_view('right');
        else
            $this->notadmin();
    }

    function setting(){
        if ($this->acl->checkPermission($_SESSION['CID'], 'users', 'full|view|add|delete|update') || $this->acl->isSuperAdmin($_SESSION['CID']))
            $this->_load_view('setting');
        else
            $this->notadmin();
    }

    function service(){
        if ($this->acl->checkPermission($_SESSION['CID'], 'users', 'full|view|add|delete|update') || $this->acl->isSuperAdmin($_SESSION['CID']))
            $this->_load_view('service');
        else
            $this->notadmin();
    }

    function table(){
        if ($this->acl->checkPermission($_SESSION['CID'], 'users', 'full|view|add|delete|update') || $this->acl->isSuperAdmin($_SESSION['CID']))
            $this->_load_view('table');
        else
            $this->notadmin();
    }

    function profile(){
        $this->_load_view('profile');
    }
}