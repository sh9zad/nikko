<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 5/24/14
 * Time: 4:36 PM
 */
include __DIR__ . "/include/settings.inc";
include __DIR__ . "/include/constants.inc";

require_once _PATH . "controls/maincontrol.class.php";
require_once _PATH . "base/members.class.php";
require_once _PATH . "base_controls/acl.class.php";
require_once _PATH  . "controls/categoriescontrol.class.php";
require_once _PATH  . "controls/topiccontrol.class.php";
require_once _PATH . "controls/servicecontrol.class.php";

if (!isset($_SESSION)) {session_start();}

/**/

$members = new Members();
$acl = new ACLController();
$cat = new CategoriesController();
$topic = new TopicController();
$service = new ServiceController();

$_SESSION['member'] = $members;
$_SESSION['ACL'] = $acl;

$allowed = array("main-enter");

//print_r($_GET);
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
    if(isset($_SESSION['CID']) && $acl->isAdministrator($_SESSION['CID'])){
        header('Location: admin/index.php');
    }
    $action =  ($_SESSION['member']->CheckLogin()) ? 'home' : 'enter';
}

$main = new MainController();

switch($control){
    case "members":
        $members->run($action, (isset($_POST['action'])) ? $_POST : $_GET);
        break;
    case "main":
        $main->run($action, (isset($_POST['action'])) ? $_POST : $_GET);
        break;
    case "cat":
        $cat->run($action, (isset($_POST['action'])) ? $_POST : $_GET);
        break;
    case "topic":
        $topic->run($action, (isset($_POST['action'])) ? $_POST : $_GET);
        break;
    case "service":
        $service->run($action, (isset($_POST['action'])) ? $_POST : $_GET);
        break;
    default:
        $_POST['Error'] = "<h1>NIKKO Framework</h1><br>
                            <h2>Error: <br></h2>
                            Controller Not Found: <strong>$control</strong> <br>";
        echo $_POST['Error'];
        break;
    }
