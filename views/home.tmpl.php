<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 5/24/14
 * Time: 5:34 PM
 */
require_once 'common/header.tmpl.php';

if (!$_SESSION['member']->CheckLogin()){
    header('Location: index.php?control=main&action=enter');
}
?>
<div id="page-wrapper" class="siteHtml">
    <h1>Home</h1>
    <nav>
        <ul>
            <li><a href="index.php?control=main&action=organization">Organization</a></li>
        </ul>
    </nav>
</div>
<script type="text/javascript" src="js/home.js"></script>
<?php
require_once 'common/footer.tmpl.php';