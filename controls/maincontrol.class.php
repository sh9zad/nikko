<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 3/16/14
 * Time: 1:10 PM
 */

//require_once "../include/constants.inc";
require_once _PATH . "base/controller.php";
//require_once _PATH . "base/members.class.php";
require_once _PATH . "base_controls/acl.class.php";

if (!isset($_SESSION)) {session_start();}

//print_r($_SESSION);

class MainController extends Controller{

    private $members;
    private $acl;

    function MainController(){
        $this->members = (isset($_SESSION['member'])) ? $_SESSION['member'] : new Members();
        $this->acl = (isset($_SESSION['ACL'])) ? $_SESSION['ACL'] : new ACLController();

        parent::Controller();


    }

    function enter(){
        if (isset($_SESSION['member']) && $_SESSION['member']->CheckLogin())
            $this->_load_view('home');
        else
            $this->_load_view('login');
    }

    function login($arg){

        if (isset($arg['username']) && isset($arg['pass'])) {
            $_SESSION['RES'] = $_SESSION['member']->login($arg['username'], $arg['pass']);
            $_SESSION['ER']  = $_SESSION['member']->getError();


            //$this->_load_view('home');

            if ($_SESSION['RES'] == false || !strcmp($_SESSION['RES'] ,'false')){
                $this->_load_view('login');
            }else
            {
                $_SESSION['ACL'] = $this->acl;
                $this->acl->setUser($_SESSION['CID']);

                if ($this->acl->isSuperAdmin($_SESSION['CID']) || $this->acl->isAdministrator($_SESSION['CID'])){
                    header('Location: admin/index.php');
                }
                else {
                    //print_r($_SESSION['ACL']->getRole($_SESSION['CID']));
                    $this->_load_view('home');
                }
            }

        }
    }

    function lists(){
        $this->_load_view('list');
    }

    function logout(){
        $this->members->LogOut();
        header('Location: index.php?control=main&action=enter');
    }

    function service(){
        $this->_load_view("service");
    }

}