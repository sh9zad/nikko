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


if (!isset($_SESSION)) {session_start();}

class MainController extends Controller{

    private $members;


    function MainController(){
        parent::Controller();
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
        $this->_load_view('user');
    }

    function object(){
        $this->_load_view('object');
    }

    function role(){
        $this->_load_view('role');
    }

    function right(){
        $this->_load_view('right');
    }

    function setting(){
        $this->_load_view('setting');
    }

    function table(){
        $this->_load_view('table');
    }
}