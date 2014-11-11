<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 10/15/2014
 * Time: 10:40 AM
 */
include_once 'common/header.tmpl.php';
if (!$_SESSION['member']->CheckLogin())
{
    header('Location: ../index.php?control=main&action=enter');
}
?>
    <!-- Services Section -->
    <section id="settings-section" class="section-wrapper">
        <h1>Service & Alias</h1>
        <div class="row">
            <div class="col-lg-6">
                <h2>Services</h2>
                <section id="service-section">
                    <table id="tbl-service-list" class="table table-bordered table-hover table-striped tablesorter">
                        <thead>
                            <tr class="header">
                                <td><i class="fa fa-columns"> </i></td>
                                <td>Title</td>
                                <td>Show Alias</td>
                                <td>Edit</td>
                                <td>Delete</td>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <!-- Edit Service Box -->
                    <div id="edit-service-section" class="panel panel-primary fixedBox hidden">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-long-arrow-right"></i>
                                Update Service
                                <button class="close" onclick="return boxClose()" type="button">×</button>
                            </h3>
                        </div>
                        <input id="edit-service-id" type="hidden" value="1">
                        <div class="panel-body">
                            <form class="validate" id="frm-edit-service">
                                <label>Service Title:</label>
                                <div class="form-group">
                                    <input id="txt-edit-service" class="form-control" type="text">
                                </div>
                                <div class="form-group">
                                    <input id="btn-edit-service" class="btn btn-success" type="submit" value="Edit">
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <!-- Add Service -->
                <form id="frm-add-new-service">
                    <h3>Add New Service</h3>
                    <ul style="list-style: none;" >
                        <li><label>Service Name:</label></li>
                        <li><input class="form-control" type="text" id="txt-new-service-name"></li>
                        <li><input class="btn btn-success" type="submit" value="Add"></li>
                    </ul>
                </form>
            </div>
            <div class="col-lg-6">
                <section id="alias-section" class="hidden">
                    <h2>Alias</h2>
                    <div id="alias-service"></div>
                    <div id="alias-msg"></div>
                    <table id="tbl-alias-list" class="table table-bordered table-hover table-striped tablesorter hidden">
                        <thead>
                        <tr class="header">
                            <td><i class="fa fa-columns"> </i></td>
                            <td>Title</td>
                            <td>Edit</td>
                            <td>Delete</td>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <!-- Add Alias -->
                    <form id="frm-add-new-alias">
                        <h3>Add New Alias</h3>
                        <ul style="list-style: none;" >
                            <li><label>Alias Name:</label></li>
                            <li><input class="form-control" type="text" id="txt-new-alias-name"></li>
                            <li><input class="btn btn-success" type="submit" value="Add"></li>
                        </ul>
                    </form>
                </section>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="js/service.js"></script>
<?php
include_once 'common/footer.tmpl.php';