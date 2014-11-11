<?php
	if (!isset($_SESSION)) { session_start(); }

?>
<!DOCTYPE HTML>
<html>
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- styles -->
        <link href="style/style.css" rel="stylesheet">
        <!-- Java Scripts -->
        <script src="js/jquery.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script src="js/utility.js"></script>
        <script src="js/form-generator.js"></script>
        <script src="js/formgenerator.js"></script>
        <script src="js/jquery.form.js"></script>
        <script src="js/jquery.validate.js"></script>
        <script src="js/valid.js"></script>
        <!-- persian caledar -->
        <link rel="stylesheet" href="style/js-persian-cal.css">
        <link rel="stylesheet" href="style/jquery-ui.css">
        <script type="text/javascript" src="js/toggles.min.js"></script>
		<script type="text/javascript" src="js/js-persian-cal.min.js"></script>

    <link rel="icon" type="image/png" href="images/fav.png"/>
<?php
	if ($_SESSION['member']->CheckLogin()) {
?>
    <title><?php echo $_SESSION['name_of_user']; ?></title>

<?php } else { ?>
	<title>ورود به سیستم</title>
    <link href="style/login.css" rel="stylesheet">
<?php } ?>
</head>
<body>
<div id="wrapper">
    <section id="msg" class="wait hide"></section>
    <section class="whitebg hide"></section>
<?php
	if ($_SESSION['member']->CheckLogin()) {
?>
<div class="header noprint">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">Navigation</div>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li><a href="index.php?control=main&action=home" class="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

                <?php
                if ($_SESSION['ACL']->checkPermission($_SESSION['CID'], 'Change Request', 'full|view|update|delete')){
                    ?>
                    <li><a href="index.php?control=main&action=crlist">CR List</a></li>
                <?php
                }
                ?>
                <?php
                    if ($_SESSION['ACL']->checkPermission($_SESSION['CID'], 'Change Request', 'full|add')){
                ?>
                        <li><a href="index.php?control=main&action=cr" class="dashboard"><i class="fa fa-dashboard"></i>Add Change Request</a></li>
                <?php
                    }
                ?>
            </ul>
            <ul>
                <li><a href="index.php?control=main&action=logout"><i class="fa fa-power-off"></i> Log Out</a></li>
            </ul>
        </div>
    </nav>
</div>


<?php
	}
?>