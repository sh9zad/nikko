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
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script src="../js/utility.js"></script>
        <script src="js/jquery.validate.js"></script>
        <script src="js/jquery.ba-hashchange.js"></script>

        <!-- Ubuntu Admin Panel -->

        <!-- CSS -->
        <link href="style/include/css/bootstrap.min.css" rel="stylesheet">
        <link href="style/include/css/animate.min.css" rel="stylesheet">
        <link href="style/include/css/font-awesome.min.css" rel="stylesheet">
        <link href="style/include/css/form.css" rel="stylesheet">
        <link href="style/include/css/calendar.css" rel="stylesheet">
        <link href="style/include/css/media-player.css" rel="stylesheet">
        <link href="style/include/css/style.css" rel="stylesheet">
        <link href="style/include/css/icons.css" rel="stylesheet">
        <link href="style/include/css/generics.css" rel="stylesheet">

        <!-- Ubuntu Admin Panel End -->



        <!-- admin boot strap links -->
        <!--link rel="stylesheet" type="text/css" href="js/bootstrap/css/bootstrap.min.css" /-->
        <!--link rel="stylesheet" type="text/css" href="js/font-awesome/css/font-awesome.min.css" /-->
        <!--link rel="stylesheet" type="text/css" href="style/admin.css" /-->

        <!--script type="text/javascript" src="js/bootstrap/js/bootstrap.min.js"></script-->
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
<body id="skin-blur-violate">
<section id="msg" class="wait hide"></section>

<?php
	if ($_SESSION['member']->CheckLogin()) {
?>

        <header id="header" class="media">
            <a href="#" id="menu-toggle"></a>
            <a class="logo pull-left" href="index.php">NIKKO Ver 2.0.1</a>

            <div class="media-body">
                <div class="media" id="top-menu">
                    <div id="time" class="pull-right">
                        <span id="hours"></span>
                        :
                        <span id="min"></span>
                        :
                        <span id="sec"></span>
                    </div>

                    <div class="media-body">
                        <input type="text" class="main-search">
                    </div>
                </div>
            </div>
        </header>
        <section id="main" class="p-relative" role="main">

    <!-- Sidebar -->
    <aside id="sidebar">

        <!-- Sidbar Widgets -->
        <div class="side-widgets overflow">
            <!-- Profile Menu -->
            <div class="text-center s-widget m-b-25 dropdown" id="profile-menu">
                <a href="#" data-toggle="dropdown">
                    <img class="profile-pic animated" src="style/include/img/profile-pic.png" alt="">
                </a>
                <ul class="dropdown-menu profile-menu">
                    <li><a href="#">My Profile</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                    <li><a href="#">Messages</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                    <li><a href="#">Settings</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                    <li><a href="../index.php?control=main&action=logout">Sign Out</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                </ul>
                <h4 class="m-0"><?php echo $_SESSION['name_of_user']; ?></h4>
            </div>

            <!-- Calendar -->
            <div class="s-widget m-b-25">
                <div id="sidebar-calendar"></div>
            </div>

            <!-- Feeds -->
            <div class="s-widget m-b-25">
                <h2 class="tile-title">
                    News Feeds
                </h2>

                <div class="s-widget-body">
                    <div id="news-feed"></div>
                </div>
            </div>

            <!-- Projects -->
            <div class="s-widget m-b-25">
                <h2 class="tile-title">
                    Projects on going
                </h2>

                <div class="s-widget-body">
                    <div class="side-border">
                        <small>Joomla Website</small>
                        <div class="progress progress-small">
                            <a href="#" data-toggle="tooltip" title="" class="progress-bar tooltips progress-bar-danger" style="width: 60%;" data-original-title="60%">
                                <span class="sr-only">60% Complete</span>
                            </a>
                        </div>
                    </div>
                    <div class="side-border">
                        <small>Opencart E-Commerce Website</small>
                        <div class="progress progress-small">
                            <a href="#" data-toggle="tooltip" title="" class="tooltips progress-bar progress-bar-info" style="width: 43%;" data-original-title="43%">
                                <span class="sr-only">43% Complete</span>
                            </a>
                        </div>
                    </div>
                    <div class="side-border">
                        <small>Social Media API</small>
                        <div class="progress progress-small">
                            <a href="#" data-toggle="tooltip" title="" class="tooltips progress-bar progress-bar-warning" style="width: 81%;" data-original-title="81%">
                                <span class="sr-only">81% Complete</span>
                            </a>
                        </div>
                    </div>
                    <div class="side-border">
                        <small>VB.Net Software Package</small>
                        <div class="progress progress-small">
                            <a href="#" data-toggle="tooltip" title="" class="tooltips progress-bar progress-bar-success" style="width: 10%;" data-original-title="10%">
                                <span class="sr-only">10% Complete</span>
                            </a>
                        </div>
                    </div>
                    <div class="side-border">
                        <small>Chrome Extension</small>
                        <div class="progress progress-small">
                            <a href="#" data-toggle="tooltip" title="" class="tooltips progress-bar progress-bar-success" style="width: 95%;" data-original-title="95%">
                                <span class="sr-only">95% Complete</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Side Menu -->
        <ul class="list-unstyled side-menu">
            <li><a class="sa-side-home" href="index.php?control=main&action=home" id="users-menu-item"><span class="menu-item">Dashboard</span></a></li>
            <?php
            if(($acl->isAdministrator($_SESSION['CID']) && $acl->checkPermission($_SESSION['CID'], 'users', 'full|view|delete|update|insert')) || $acl->isSuperAdmin($_SESSION['CID'])) {?>
                <li><a class="sa-side-typography" href="index.php?control=main&action=user" id="users-menu-item"><span class="menu-item"> User</span></a></li>
            <?php }
            if(($acl->isAdministrator($_SESSION['CID']) && $acl->checkPermission($_SESSION['CID'], 'objects', 'full|view|delete|update|insert')) || $acl->isSuperAdmin($_SESSION['CID'])) {?>
                <li><a class="sa-side-widget" href="index.php?control=main&action=object" id="objects-menu-item"><span class="menu-item"> Objects</span></a></li>
            <?php }
            if(($acl->isAdministrator($_SESSION['CID']) && $acl->checkPermission($_SESSION['CID'], 'tables', 'full|view|delete|update|insert')) || $acl->isSuperAdmin($_SESSION['CID'])) {?>
                <li><a class="sa-side-table" href="index.php?control=main&action=table" id="objects-menu-item"><span class="menu-item"> Tables</span></a></li>
            <?php }
            if(($acl->isAdministrator($_SESSION['CID']) && $acl->checkPermission($_SESSION['CID'], 'roles', 'full|view|delete|update|insert')) || $acl->isSuperAdmin($_SESSION['CID'])) {?>
                <li><a class="sa-side-form" href="index.php?control=main&action=role" id="roles-menu-item"><span class="menu-item"> Roles</span></a></li>
            <?php }
            if(($acl->isAdministrator($_SESSION['CID']) && $acl->checkPermission($_SESSION['CID'], 'rights', 'full|view|delete|update|insert')) || $acl->isSuperAdmin($_SESSION['CID'])) {?>
                <li><a class="sa-side-photos" href="index.php?control=main&action=right" id="rights-menu-item"><span class="menu-item"> Rights</span></a></li>
            <?php }
            if(($acl->isAdministrator($_SESSION['CID']) && $acl->checkPermission($_SESSION['CID'], 'settings', 'full|view|delete|update|insert')) || $acl->isSuperAdmin($_SESSION['CID'])) {?>
                <li><a class="sa-side-chart" href="index.php?control=main&action=setting" id="settings-menu-item"><span class="menu-item"> Settings</span></a></li>
            <?php } ?>










            <!--li>
                <a class="sa-side-typography" href="typography.html">
                    <span class="menu-item">Users</span>
                </a>
            </li>
            <li>
                <a class="sa-side-widget" href="content-widgets.html">
                    <span class="menu-item">Widgets</span>
                </a>
            </li>
            <li class="active">
                <a class="sa-side-table" href="tables.html">
                    <span class="menu-item">Tables</span>
                </a>
            </li>
            <li class="dropdown">
                <a class="sa-side-form" href="#">
                    <span class="menu-item">Form</span>
                </a>
                <ul class="list-unstyled menu-item">
                    <li><a href="form-elements.html">Basic Form Elements</a></li>
                    <li><a href="form-components.html">Form Components</a></li>
                    <li><a href="form-examples.html">Form Examples</a></li>
                    <li><a href="form-validation.html">Form Validation</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="sa-side-ui" href="#">
                    <span class="menu-item">User Interface</span>
                </a>
                <ul class="list-unstyled menu-item">
                    <li><a href="buttons.html">Buttons</a></li>
                    <li><a href="labels.html">Labels</a></li>
                    <li><a href="images-icons.html">Images &amp; Icons</a></li>
                    <li><a href="alerts.html">Alerts</a></li>
                    <li><a href="media.html">Media</a></li>
                    <li><a href="components.html">Components</a></li>
                    <li><a href="other-components.html">Others</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="sa-side-photos" href="#">
                    <span class="menu-item">PHOTO GALLERY</span>
                </a>
                <ul class="list-unstyled menu-item">

                    <li><a href="photo-gallery-alt.html">Photo Gallery</a></li>
                </ul>
            </li>
            <li>
                <a class="sa-side-chart" href="charts.html">
                    <span class="menu-item">Charts</span>
                </a>
            </li>
            <li>
                <a class="sa-side-folder" href="file-manager.html">
                    <span class="menu-item">File Manager</span>
                </a>
            </li>
            <li>
                <a class="sa-side-calendar" href="calendar.html">
                    <span class="menu-item">Calendar</span>
                </a>
            </li>
            <li class="dropdown">
                <a class="sa-side-page" href="#">
                    <span class="menu-item">Pages</span>
                </a>
                <ul class="list-unstyled menu-item">
                    <li><a href="list-view.html">List View</a></li>
                    <li><a href="profile-page.html">Profile Page</a></li>
                    <li><a href="messages.html">Messages</a></li>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="404.html">404 Error</a></li>
                </ul>
            </li-->
        </ul>

    </aside>



<!--div class="header noprint">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
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
</div-->
<?php
	}
?>
    <section id="content" class="container">