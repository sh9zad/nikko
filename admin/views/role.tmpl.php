<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 8/20/14
 * Time: 4:18 PM
 */
include_once 'common/header.tmpl.php';
if (!$_SESSION['member']->CheckLogin())
{
    header('Location: ../index.php?control=main&action=enter');
}
?>

<!-- Role Section -->
<section id="role-section" class="section-wrapper">
    <h1>Roles</h1>
    <div class="row">
        <div class="col-lg-4">
            <label>Add New Role</label>
            <form class="validate">
                <div class="form-group"><input name="name" type="text" class="form-control" placeholder="Role Title" id="txt-new-role"></div>
                <div class="form-group"><input type="button" id="btn-add-role" class="btn btn-success" value="Add New Role"></div>
            </form>
        </div>
        <div class="col-lg-8">
            <label> Display Role Data:</label>
            <div class="table-responsive overflow">
                <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-roles-list">
                    <thead>
                    <tr>
                        <th class="header"><i class="fa fa-columns"></i></th>
                        <th>Title <i class="fa fa-sort"></i></th>
                        <th class="header center">Del</th>
                        <th class="header center">Edit</th>
                        <th class="header center">Permission</th>
                        <th class="header center">Permission By Table</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <div id="edit-role-section" class="col-lg-6 absoluteBox" style="display: none;">
            <div class="panel panel-primary fixedBox">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Update Role Title
                        <button type="button" class="close" onclick="return boxClose()">×</button>
                    </h3>
                </div>
                <input type="hidden" id="edit-role-id">
                <div class="panel-body">
                    <form class="validate">
                        <label>Role Title:</label>
                        <div class="form-group"><input type="text" id="txt-edit-role" class="form-control" placeholder="Role Title" /></div>
                        <div class="form-group"><input type="button" class="btn btn-warning" id="btn-edit-role" value="Update"></div>
                    </form>
                </div>
            </div>
        </div>
        <div id="assign-permission-role" class="col-lg-6 absoluteBox" style="display: none;">
            <div class="panel panel-primary fixedBox">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Assign Permissions
                        <button type="button" class="close" onclick="return boxClose()">×</button>
                    </h3>
                </div>
                <input type="hidden" id="assign-permission-role-id">
                <div class="panel-body">
                    <label>Role Name</label>
                    <div class="form-group"><input type="text" class="form-control" disabled id="assign-permission-role-title"></div>
                    <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-assign-permission-role">
                        <thead></thead>
                        <tbody></tbody>
                    </table>
                    <div class="form-group"><input type="button" id="btn-assign-permission-role" class="btn btn-warning" value="Assign"></div>
                </div>
            </div>
        </div>

        <section id="assign-table-columns-section">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Assign Table Access</h2>
                    <label>Select Table:</label>
                    <div class="form-group"><select id="lst-table-names"></select></div>
                    <div class="form-group"><input type="button" class="btn btn-warning" id="btn-show-table-columns" value="Show"><div class="form-group">
                </div>
            </div>
        </section>
    </div>

</section>
    <script type="text/javascript" src="js/role.js"></script>
<?php
include_once 'common/footer.tmpl.php';