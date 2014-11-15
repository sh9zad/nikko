<?php
include_once _PATH . "base_controls/acl.class.php";
	if (!isset($_SESSION)) { session_start(); }
    $acl = new ACLController($_SESSION['CID']);
?>
<!DOCTYPE HTML>
<html>
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Java Scripts -->
        <script src="js/jquery.js"></script>
        <script src="../js/utility.js"></script>
        <script src="js/jquery.validate.js"></script>
        <script src="js/jquery.ba-hashchange.js"></script>
        <!-- admin boot strap links -->
        <link rel="stylesheet" type="text/css" href="js/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="js/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="style/admin.css" />

        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/bootstrap/js/bootstrap.min.js"></script>
        <!--------------->
        <!-- persian caledar -->
        <link rel="stylesheet" href="../style/js-persian-cal.css">
		<script type="text/javascript" src="../js/js-persian-cal.min.js"></script>

    <link rel="icon" type="image/png" href="../images/fav.png"/>
<?php
	if ($_SESSION['member']->CheckLogin()) {
?>
    <title><?php echo $_SESSION['name_of_user']; ?></title>
<?php } else { ?>
	<title>ورود به سیستم</title>
<?php } ?>
</head>
<body>
<div id="wrapper">
    <section id="msg" class="wait hide"></section>

<?php
	if ($_SESSION['member']->CheckLogin()) {
?>
<div class="header noprint">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <?php
                    if(($acl->isAdministrator($_SESSION['CID']) && $acl->checkPermission($_SESSION['CID'], 'users', 'full|view|delete|update|insert')) || $acl->isSuperAdmin($_SESSION['CID'])) {?>
                <li><a href="index.php?control=main&action=user" id="users-menu-item"><i class="fa fa-user"></i> User</a></li>
                <?php }
                    if(($acl->isAdministrator($_SESSION['CID']) && $acl->checkPermission($_SESSION['CID'], 'objects', 'full|view|delete|update|insert')) || $acl->isSuperAdmin($_SESSION['CID'])) {?>
                <li><a href="index.php?control=main&action=object" id="objects-menu-item"><i class="fa fa-briefcase"></i> Objects</a></li>
                <?php }
                    if(($acl->isAdministrator($_SESSION['CID']) && $acl->checkPermission($_SESSION['CID'], 'tables', 'full|view|delete|update|insert')) || $acl->isSuperAdmin($_SESSION['CID'])) {?>
                <li><a href="index.php?control=main&action=table" id="objects-menu-item"><i class="fa fa-briefcase"></i> Tables</a></li>
                <?php }
                    if(($acl->isAdministrator($_SESSION['CID']) && $acl->checkPermission($_SESSION['CID'], 'roles', 'full|view|delete|update|insert')) || $acl->isSuperAdmin($_SESSION['CID'])) {?>
                <li><a href="index.php?control=main&action=role" id="roles-menu-item"><i class="fa fa-table"></i> Roles</a></li>
                <?php }
                    if(($acl->isAdministrator($_SESSION['CID']) && $acl->checkPermission($_SESSION['CID'], 'rights', 'full|view|delete|update|insert')) || $acl->isSuperAdmin($_SESSION['CID'])) {?>
                <li><a href="index.php?control=main&action=right" id="rights-menu-item"><i class="fa fa-check-square"></i> Rights</a></li>
                <?php }
                    if(($acl->isAdministrator($_SESSION['CID']) && $acl->checkPermission($_SESSION['CID'], 'services', 'full|view|delete|update|insert')) || $acl->isSuperAdmin($_SESSION['CID'])) {?>
                <li><a href="index.php?control=main&action=service" id="rights-menu-item"><i class="fa fa-check-square"></i> Services</a></li>
                <?php }
                    if(($acl->isAdministrator($_SESSION['CID']) && $acl->checkPermission($_SESSION['CID'], 'settings', 'full|view|delete|update|insert')) || $acl->isSuperAdmin($_SESSION['CID'])) {?>
                <li><a href="index.php?control=main&action=setting" id="settings-menu-item"><i class="fa fa-wrench"></i> Settings</a></li>
                <?php } ?>
            </ul>
            <ul class="nav navbar-nav navbar-right navbar-user">
                <li class="dropdown user-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Welcome, <?php echo $_SESSION['name_of_user']; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="../index.php?control=main&action=logout"><i class="fa fa-power-off"></i> Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
     </nav>
</div>
<?php
	}
?>