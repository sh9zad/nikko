<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 5/24/14
 * Time: 5:34 PM
 */
require_once 'common/header.tmpl.php';
if (!isset($_SESSION)) {session_start();}
if (!$_SESSION['member']->CheckLogin()){
    header('Location: index.php?control=main&action=enter');
}
?>

    <script type="text/javascript" src="js/service.js"></script>
<?php
require_once 'common/footer.tmpl.php';