<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 5/24/14
 * Time: 4:40 PM
 */
include_once 'common/header.tmpl.php';

if (isset($_SESSION['ER'])){ ?>
    <div class="alert alert-dismissable alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
            <strong><?php echo($_SESSION['ER']) ?></strong>
    </div>
<?php unset($_SESSION['ER']); } ?>

<section id="section">
 <div id="login">
    <div id="banner">
        <img class="left" src="style/images/logo.png" alt="logo" />
        <img class="right" id="loginLogo" src="style/images/login.png" alt="login" />
    </div>
    <form action="index.php" method="post" autocomplete="off">
        <input type="hidden" name="control" value="main">
        <input type="hidden" name="action" value="login">
    <ul class="right forgotPass">
        <li><span>Forgot Your Password?</span></li>
        <li><div class="toggle-light right" data-toggle-on="true" data-toggle-height="13" data-toggle-width="40"></div></li>
    </ul>
    <ul class="left">
        <li><input class="textBox" name="username" type="text" id="username" autocomplete="off" placeholder="Username"></li>
        <li><input class="textBox" name="pass" type="password" id="pass" autocomplete="off" placeholder="Password"></li>
        <li><button type="submit" id="btn_system_login"></button></li>
        <li><span>Dont Register? Register Now!</span></li>
    </ul>
    </form>
 </div>
</section>
<script type="text/javascript" src="js/login.js"></script>
<?php
include_once 'common/footer.tmpl.php';