<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 9/20/14
 * Time: 4:13 PM
 */
if (!isset($_SESSION)) {session_start();}

include_once _PATH . "views/common/header.tmpl.php";

?>
<h1>Organization Menu</h1>
<nav>
    <ul>
        <li><a href="#" id="view-tree" >View Tree</a></li>
        <li><a href="#" id="view-add-division" >Add Division</a></li>
    </ul>
</nav>
<!-- View Tree Section -->
    <link rel="stylesheet" href="js/orgchart/js/jquery/ui-lightness/jquery-ui-1.10.2.custom.css" />
    <script type="text/javascript" src="js/orgchart/js/jquery/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="js/orgchart/js/jquery/jquery-ui-1.10.2.custom.min.js"></script>

    <script type="text/javascript" src="js/orgchart/js/primitives.min.js"></script>
    <link href="js/orgchart/css/primitives.latest.css" media="screen" rel="stylesheet" type="text/css" />

<section id="show-tree">
    <h2>Organization Tree</h2>
    <div id="basicdiagram" style="width: 100%; height: 480px; border-style: dotted; border-width: 1px;" ></div>
    <div class="operations" id="operations-section" style="display: none;">
        <h3 style="float: left">Operations</h3>
        <ul style="float: left">
            <li><a href="#" id="add-child-here">Add Child</a></li>
            <li><a href="#" id="delete-division">Delete</a></li>
            <li><a href="#" id="edit-division">Edit</a></li>
        </ul>
    </div>
    <div id="southpanel"></div>
</section>
<!-- ADD Division Tree View Section -->
<section class="add-division-section" id="add-division" style="display: none;">
    <h2 style="float: left">Add Division</h2>
    <a href="#" onclick="return close_section('add-division');" style="float: right" >Close</a>
    <div id="add-division-form"></div>
</section>

<!-- ADD New Division Separate Section -->
<section id="add-division-sep-section">
    <h2>Add Division</h2>
</section>
    <script type="text/javascript" src="js/organization.js"></script>
<?php
include_once _PATH . "views/common/footer.tmpl.php";