<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 10/1/2014
 * Time: 10:16 AM
 */

include_once 'common/header.tmpl.php';
if (!$_SESSION['member']->CheckLogin())
{
    header('Location: ../index.php?control=main&action=enter');
}
?>
    <ol class="breadcrumb hidden-xs">
        <li><a href="#">Home</a></li>
        <li class="active">TABLE</li>
    </ol>
    <h4 class="page-title">TABLE</h4>
    <!-- User Section -->
    <!-- Object Section -->
    <section class="block-area" id="defaultStyle">
        <div class="row">
            <div class="col-lg-12">
                <label> List of Database Tables:</label>
                <div class="table-responsive overflow">
                    <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-tables-list">
                        <thead>
                        <tr>
                            <th class="header"><i class="fa fa-columns"></i></i></th><th class="header">Title <i class="fa fa-sort"></i></th><th class="header center">Details</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="details-table-section" class="col-lg-11 hidden">
            <div class="tile">
                <h3 class="tile-title"><i class="fa fa-long-arrow-right"></i> Table Details
                    <button type="button" class="close" onclick="return Close('details-table-section')">×</button>
                </h3>
                <input type="hidden" id="edit-object-id">
                <div class="panel-body">
                    <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-table-columns">
                        <thead>
                            <tr><th class="header"><i class="fa fa-columns"></i></th><th class="header">Column Name</th></tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
    </section>


    <script type="text/javascript" src="js/table.js"></script>
<?php
include_once 'common/footer.tmpl.php';