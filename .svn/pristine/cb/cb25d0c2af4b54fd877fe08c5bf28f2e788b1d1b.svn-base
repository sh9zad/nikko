<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 8/20/14
 * Time: 3:09 PM
 */
include_once 'common/header.tmpl.php';
if (!$_SESSION['member']->CheckLogin())
{
    header('Location: ../index.php?control=main&action=enter');
}
?>

    <!-- Right Section -->
    <section id="right-section" class="section-wrapper">
        <h1>Rights</h1>
        <div class="row">
            <div class="col-lg-4">
                <form class="validate">
                    <label>Add New Right</label>
                    <div class="form-group"><input name="name" type="text" class="form-control" placeholder="Rights Title" id="txt-new-right"></div>
                    <div class="form-group"><input type="button" id="btn-add-right" class="btn btn-success" value="Add New Rights"></div>
                </form>
            </div>
            <div class="col-lg-8">
                <label> Display Right Data:</label>
                <div class="table-responsive overflow">
                    <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-right-list">
                        <thead>
                        <tr>
                            <th class="header"><i class="fa fa-columns"></i></th><th>Title <i class="fa fa-sort"></i></th><th class="header center">Del</th><th class="header center">Edit</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div id="edit-right-section" class="col-lg-6 absoluteBox" style="display: none;">
                <div class="panel panel-primary fixedBox">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Update Rights
                            <button type="button" class="close" onclick="return boxClose()">×</button>
                        </h3>
                    </div>
                    <input type="hidden" id="edit-right-id">
                    <div class="panel-body">
                        <form class="validate">
                            <label>Rights Title:</label>
                            <div class="form-group"><input type="text" id="txt-edit-right" class="form-control" /></div>
                            <div class="form-group"><input type="button" class="btn btn-success" id="btn-edit-right" value="Edit"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="js/right.js"></script>
<?php
include_once 'common/footer.tmpl.php';