<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 8/20/14
 * Time: 4:47 PM
 */
include_once 'common/header.tmpl.php';
if (!$_SESSION['member']->CheckLogin())
{
    header('Location: ../index.php?control=main&action=enter');
}
?>
    <!-- Settings Section -->
    <section id="settings-section" class="section-wrapper">
        <h1>Settings</h1>
        <div class="row">
            <div class="col-lg-12">
            </div>
        </div>
    </section>
    <script type="text/javascript" src="js/setting.js"></script>
<?php
include_once 'common/footer.tmpl.php';