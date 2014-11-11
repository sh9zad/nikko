<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 8/20/14
 * Time: 3:12 PM
 */
include_once 'common/header.tmpl.php';
if (!$_SESSION['member']->CheckLogin())
{
    header('Location: ../index.php?control=main&action=enter');
}
?>


<!-- Object Section -->
<section id="objects-section" class="section-wrapper">
    <h1>Object</h1>
    <div class="row">
        <div class="col-lg-4">
            <form class="validate">
                <label> Add New Object Title:</label>
                <div class="form-group"><input type="text" name="name" id="txt-new-object" class="form-control" placeholder="Object Title"></div>
                <div class="form-group"><input type="button" class="btn btn-success" id="add-new-object" value="Add New Object"></div>
            </form>
        </div>
        <div class="col-lg-8">
            <label> Display Object Data:</label>
            <div class="table-responsive overflow">
                <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-objects-list">
                    <thead>
                    <tr>
                        <th class="header"><i class="fa fa-columns"></i></i></th><th class="header">Title <i class="fa fa-sort"></i></th><th class="header center">Del</th><th class="header center">Edit</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <div id="edit-object-section" class="col-lg-6 absoluteBox" style="display: none;">
            <div class="panel panel-primary fixedBox">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Update Object Title
                        <button type="button" class="close" onclick="return boxClose()">×</button>
                    </h3>
                </div>
                <input type="hidden" id="edit-object-id">
                <div class="panel-body">
                    <form class="validate">
                        <label>Object Title:</label>
                        <div class="form-group"><input name="name" type="text" id="txt-edit-object" class="form-control" placeholder="Object Title" /></div>
                        <div class="form-group"><input type="button" class="btn btn-warning" id="btn-edit-object" value="Update"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

    <script type="text/javascript" src="js/object.js"></script>
<?php
include_once 'common/footer.tmpl.php';