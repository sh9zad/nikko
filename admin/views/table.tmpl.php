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
    <section id="objects-section" class="section-wrapper">
        <h1>Tables</h1>
        <div class="row">
            <div class="col-lg-12">
                <label> Display Tables' Data:</label>
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
        <div id="details-table-section" class="col-lg-6 absoluteBox" style="display: none;">
            <div class="panel panel-primary fixedBox">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Table Details
                        <button type="button" class="close" onclick="return boxClose()">×</button>
                    </h3>
                </div>
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