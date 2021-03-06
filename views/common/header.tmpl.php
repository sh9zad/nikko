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
        <!--link href="style/style.css" rel="stylesheet">
        <link href="include/bootstrap.css" rel="stylesheet" /-->
        <script src="js/jquery.js"></script>

        <!--script src="include/bootstrap.js" type="text/javascript" /-->
        <script src="js/jquery-ui.js"></script>
        <script src="js/utility.js"></script>
        <script src="js/form-generator.js"></script>
        <script src="js/formgenerator.js"></script>
        <!--script src="js/jquery.form.js"></script>
        <script src="js/jquery.validate.js"></script>
        <script src="js/valid.js"></script-->

        <link rel="stylesheet" href="include/element/css/reset.css" />
        <link rel="stylesheet" href="include/element/css/visualize.css" />
        <link rel="stylesheet" href="include/element/css/datatables.css" />
        <link rel="stylesheet" href="include/element/css/buttons.css" />
        <link rel="stylesheet" href="include/element/css/checkboxes.css" />
        <link rel="stylesheet" href="include/element/css/inputtags.css" />
        <link rel="stylesheet" href="include/element/css/main.css" />

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
    <section id="msg" class="wait hide"></section>
    <section class="whitebg hide"></section>
<?php
	if ($_SESSION['member']->CheckLogin()) {
?>
        <div id="gradient">
            <div id="stars">
                <div id="container">

                    <header>
                        <!-- Logo -->
                        <h1 id="logo">Admin Control Panel</h1>

                        <!-- User info -->
                        <div id="userinfo">
                            <img src="include/element/img/avatar.png" alt="Bram Jetten" />
                            <div class="intro">
                                Welcome Bram<br />
                                You have <a href="index.php?control=main&action=logout">LogOut</a>
                            </div>
                        </div>

                    </header>

                    <!-- The application "window" -->
                    <div id="application">

                        <!-- Primary navigation -->
                        <nav id="primary">
                            <ul>
                                <li class="current">
                                    <a href="index.php">
                                        <span class="icon dashboard"></span>
                                        پیشخوان
                                    </a>
                                </li>

                                <li>
                                    <a href="index.php?control=main&action=service">
                                        <span class="icon pencil"></span>
سرویس ها
                                    </a>
                                </li>

                                <!--li>
                                    <a href="/tables">
                                        <span class="icon tables"></span>
                                        پیام های برگزیده
                                    </a>
                                </li>

                                <li>
                                    <a href="/charts">
                                        <span class="icon chart"></span>
                                        نمودار
                                    </a>
                                </li>

                                <li>
                                    <a href="/notifications">
                                        <span class="icon modal"></span>
                                        پیام های دریافتی
                                        <span class="badge">4</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="/gallery">
                                        <span class="icon gallery"></span>
                                        گزارش
                                    </a>
                                </li>

                                <!--li>
                                    <a href="/buttons">
                                        <span class="icon anchor"></span>
                                        Icons/buttons
                                    </a>
                                </li-->
                            </ul>

                            <input type="text" id="search" placeholder="جستجو کنید..." />
                        </nav>

                        <!-- Secondary navigation -->
<?php
	}
?>