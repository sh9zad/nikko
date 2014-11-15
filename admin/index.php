<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 5/24/14
 * Time: 4:36 PM
*/
include $_SERVER['DOCUMENT_ROOT'] . '/organization/' . "include/constants.inc";


require_once _PATH . "admin/controls/maincontrol.class.php";
require_once _PATH . "base_controls/acl.class.php";
require_once _PATH . "base_controls/db.class.php";

require_once _PATH . "admin/controls/maincontrol.class.php";
require_once _PATH . "admin/controls/objectcontrol.class.php";
require_once _PATH . "admin/controls/rolecontol.class.php";
require_once _PATH . "admin/controls/rightcontrol.class.php";
require_once _PATH . "admin/controls/usercontrol.class.php";

if (!isset($_SESSION)) {session_start();}

$action = "";

if (!isset($_SESSION['member']) || !$_SESSION['member']->CheckLogin() || !isset($_SESSION['CID']))
    header('Location: ../index.php?control=main&action=enter');

if (isset($_POST['control'])) {
    $control = $_POST['control'];
} elseif (isset($_GET['control'])) {
    $control = $_GET['control'];
} else {
    $control = 'main';
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} elseif (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'enter';
}


$acl_controller = new ACLController();
$main = new MainController();
$object = new ObjectController();
$role = new RoleController();
$right = new RightController();
$user = new UserController();
$db = new DBController();

//$city = new CityProvinceController();

if(!$acl_controller->isAdministrator($_SESSION['CID'])){
    $control = 'main';
    $action = 'notadmin';
}

switch($control){
    case "user":
        $user->run($action, (isset($_POST['action'])) ? $_POST : $_GET);
        break;
    case "main":
        $main->run($action, (isset($_POST['action'])) ? $_POST : $_GET);
        break;
    case "object":
        $object->run($action, (isset($_POST['action'])) ? $_POST : $_GET);
        break;
    case "role":
        $role->run($action, (isset($_POST['action'])) ? $_POST : $_GET);
        break;
    case "right":
        $right->run($action, (isset($_POST['action'])) ? $_POST : $_GET);
        break;
    case "city":
        $city->run($action, (isset($_POST['action'])) ? $_POST : $_GET);
        break;
    case "db":
        $db->run($action, (isset($_POST['action'])) ? $_POST : $_GET);
        break;
    default:
        $_POST['Error'] = "Controller Not Found";
        print_r($_POST);
        break;
}