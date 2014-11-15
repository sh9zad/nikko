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


    <!-- User Section -->
    <section id="users-section" class="section-wrapper">
        <h1>Users</h1>
        <div class="row">
            <form class="validate">
                <div class="col-lg-3">
                    <label>Add New User Data</label>

                    <div class="form-group"><input type="text" name="name" id="txt-new-user-name" class="form-control"  placeholder="Enter Name" /></div>

                    <div class="form-group"><input type="text" name="family" id="txt-new-user-family" class="form-control" placeholder="Enter Family" /></div>

                    <div class="form-group"><input type="text" name="user" id="txt-new-user-username" class="form-control" placeholder="Enter Username" /></div>

                    <div class="form-group"><input type="text" name="pass" id="txt-new-user-password" class="form-control" placeholder="Enter Password" /></div>

                    <div class="form-group"><input type="text" name="email" id="txt-new-user-email" class="form-control" placeholder="Enter Email"/></div>

                    <div class="form-group"><select type="text" name="type" id="txt-new-user-type" class="form-control" ></select></div>
                    <div class="form-group"><input type="button" class="btn btn-success" name="btn" id="add-new-user" value="Add New User "></div>
                </div>
            </form>
            <div class="col-lg-9">
                <label>Display User Data</label>
                <div class="table-responsive overflow">
                    <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-users-list">
                        <thead>
                        <tr>
                            <th class="header"><i class="fa fa-columns"></i></th><th class="header">Name <i class="fa fa-sort"></i></th><th class="header">Family <i class="fa fa-sort"></i></th><th class="header">Username <i class="fa fa-sort"></i></th><th class="header">Email <i class="fa fa-sort"></i></th><th class="header">Del</th><th class="header">Edit</th><th class="header">Roles</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <div id="edit-user-section" class="hide col-lg-6 absoluteBox">
                <div class="panel panel-primary fixedBox">
                    <input type="hidden" id="edit-edit-id">

                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Edit User
                            <button type="button" class="close" onclick="return boxClose()">×</button>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <label> Name:</label>
                        <form class="validate">
                            <div class="form-group"><input name="name" class="form-control" type="text" id="txt-edit-user-name"></div>
                            <label> Family Name:</label>
                            <div class="form-group"><input name="name" class="form-control" type="text" id="txt-edit-user-family"></div>
                            <label> Username:</label>
                            <div class="form-group"><input name="userpass" class="form-control" type="text" id="txt-edit-user-username"></div>
                            <label> Password:</label>
                            <div class="form-group"><input name="userpass" class="form-control" type="text" id="txt-edit-user-password"></div>
                            <label> Email:</label>
                            <div class="form-group"><input name="email" class="form-control" type="text" id="txt-edit-user-email"></div>
                            <input type="button" class="btn btn-warning" id="edit-new-user" value="Update">
                        </form>
                    </div>
                </div>
            </div>
            <div id="assign-role-section" class="hide col-lg-6 absoluteBox">
                <div class="panel panel-primary fixedBox">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Assign Roles
                            <button type="button" class="close" onclick="return boxClose()">×</button>
                        </h3>
                    </div>
                    <input type="hidden" id="edit-role-user-id">
                    <div class="panel-body">
                        <label>User:</label>
                        <div class="form-group"><input class="form-control" type="text" disabled id="lst-all-users"></div>

                        <label>Roles List:</label>
                        <div class="form-group"><select multiple="" class="form-control" id="lst-all-roles"></select>
                            <ul class="pager">
                                <li><a href="#" id="selectitem"><i class="fa fa-arrow-down">>></i></a></li>
                                <li><a href="#" id="removeitem"><i class="fa fa-arrow-up"><<</i></a></li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label>Selected Roles</label>
                            <select multiple="" class="form-control" id="lst-all-roles-selected"></select>
                        </div>
                        <input type="button" id="btn-do-assign-role" value="Assign" class="btn btn-warning" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="js/user.js"></script>
<?php
include_once 'common/footer.tmpl.php';