<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 6/16/14
 * Time: 9:31 AM
 */
include_once 'common/header.tmpl.php';
if (!$_SESSION['member']->CheckLogin())
{
    header('Location: ../index.php?control=main&action=enter');
}
?>
    <div id="page-wrapper">
    <!-- Settings Section -->
    <section id="settings-section" class="hide">
    <div class="row">
        <div class="col-lg-12">
            <h1>Setting <small style="font-size: 17px;">Setting</small></h1>
            <ol class="breadcrumb">
                <li><a href="#" class="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active"><i class="fa fa-wrench"></i> Setting</li>
            </ol>
        </div>
    </div>
    <div class="row">
    <div class="col-lg-12">
    <div class="bs-example">
    <ul class="nav nav-tabs customfontul" style="margin-bottom: 15px;">
        <li class="active"><a href="#province" data-toggle="tab" id="btn-show-provinces">Province</a></li>
        <li><a href="#city" data-toggle="tab" id="btn-show-cities">City</a></li>
        <li><a href="#factory" data-toggle="tab" id="btn-show-factory">Factory</a></li>
        <li><a href="#antenna" data-toggle="tab" id="btn-show-antenna">Antenna</a></li>
        <li><a href="#antennatype" data-toggle="tab" id="btn-show-antennatype">Antenna Type</a></li>
        <li><a href="#sitetype" data-toggle="tab" id="btn-show-sitetype">Site Type</a></li>
        <li><a href="#towertype" data-toggle="tab" id="btn-show-towertype">Tower Type</a></li>
        <li><a href="#nodebtype" data-toggle="tab" id="btn-show-nodebtype">NodeBType</a></li>
        <li><a href="#feedertype" data-toggle="tab" id="btn-show-feedertype">Fedder Type</a></li>
        <li><a href="#sitestatus" data-toggle="tab" id="btn-show-sitestatus">Site Status</a></li>
        <li><a href="#vendors" data-toggle="tab" id="btn-show-vendors">Vendors</a></li>
        <li><a href="#regions" data-toggle="tab" id="btn-show-regions">Regions</a></li>
        <li><a href="#ret" data-toggle="tab" id="btn-show-ret">Ret</a></li>
        <li><a href="#planner" data-toggle="tab" id="btn-show-planner">Planner</a></li>
        <li><a href="#cluster" data-toggle="tab" id="btn-show-cluster">Cluster</a></li>
        <li><a href="#sitecluster" data-toggle="tab" id="btn-show-sitecluster">Site Cluster</a></li>
        <li><a href="#label" data-toggle="tab" class="labels-sites-menu-item">Labels</a></li>
        <li><a href="#reset" data-toggle="tab" id="change-pass-menu-items">Reset Password</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active in" id="province">
        <section id="provinces-section" class="row">
            <div class="col-lg-4">
                <form class="validate">
                    <label>Add Province</label>
                    <div class="form-group"><input name="name" type="text" class="form-control" placeholder="Province Name" id="txt-add-province-title"></div>
                    <div class="form-group"><input type="button" id="btn-add-province" class="btn btn-success" disabled value="Add New Province"></div>
                </form>
            </div>
            <div class="col-lg-8">
                <label>Display Province</label>
                <div class="table-responsive overflow">
                    <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-provinces-lst">
                        <thead><tr><th class="header"><i class="fa fa-columns"></th><th class="header">Name <i class="fa fa-sort"></th><th class="header center">Del</th><th class="header center">Edit</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>


            <div id="edit-province-section" class="hide col-lg-6 absoluteBox">
                <div class="panel panel-primary fixedBox">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Update Province
                            <button type="button" class="close" onclick="return boxClose()">×</button>
                        </h3>
                    </div>
                    <input type="hidden" id="txt-edit-province-id">
                    <div class="panel-body">
                        <label>Province Title:</label>
                        <form class="validate">
                            <div class="form-group"><input name="name" type="text" id="txt-edit-province-title" class="form-control" /></div>
                            <div class="form-group"><input type="button" class="btn btn-success" id="btn-edit-province" value="Update Province"></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <div class="tab-pane fade" id="city">
        <section id="cities-section" class="row">
            <div class="col-lg-4">
                <form class="validate">
                    <label>Add City</label>
                    <div class="form-group"><input type="text" name="city" class="form-control" placeholder="City Name" id="txt-add-city-title"></div>
                    <div class="form-group"><input type="button" id="btn-add-city" class="btn btn-success" disabled value="Add New City"></div>
                </form>
            </div>
            <div class="col-lg-8">
                <label>Select Province</label>
                <div class="form-group"><select class="form-control" id="select-city-lst"></select></div>
                <div class="table-responsive overflow">
                    <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-city-lst">
                        <thead><tr><th class="header"><i class="fa fa-columns"></th><th class="header">Name <i class="fa fa-sort"></th><th class="header center">Del</th><th class="header center">Edit</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>


            <div id="edit-city-section" class="hide col-lg-6 absoluteBox">
                <div class="panel panel-primary fixedBox">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Update City
                            <button type="button" class="close" onclick="return boxClose()">×</button>
                        </h3>
                    </div>
                    <input type="hidden" id="txt-edit-city-id">
                    <div class="panel-body">
                        <form class="validate">
                            <label>City Name:</label>
                            <div class="form-group"><input type="text" name="city" id="txt-edit-city-title" class="form-control" /></div>
                            <div class="form-group"><input type="button" class="btn btn-success" id="btn-edit-city" value="Update City"></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <div class="tab-pane fade" id="factory">

        <div id="factory-section" class="row">
            <div class="col-lg-4">
                <form class="validate">
                    <label>Add Factory</label>
                    <div class="form-group"><input type="text" name="name" class="form-control" placeholder="Factory Name" id="txt-add-factory-title"></div>
                    <div class="form-group"><input type="button" id="btn-add-factory" class="btn btn-success" disabled value="Add New Factory"></div>
                </form>
            </div>
            <div class="col-lg-8">
                <label>Factory List</label>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-factory-lst">
                        <thead><tr><th class="header"><i class="fa fa-columns"></th><th class="header">Name <i class="fa fa-sort"></th><th class="header center">Del</th><th class="header center">Edit</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div id="edit-factory-section" class="hide col-lg-6 absoluteBox">
                <div class="panel panel-primary fixedBox">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Update Factory
                            <button type="button" class="close" onclick="return boxClose()">×</button>
                        </h3>
                    </div>
                    <input type="hidden" id="txt-edit-factory-id">
                    <div class="panel-body">
                        <form class="validate">
                            <label>Factory Name:</label>
                            <div class="form-group"><input type="text" name="name" id="txt-edit-factory-title" class="form-control" /></div>
                            <div class="form-group"><input type="button" class="btn btn-success" id="btn-edit-factory" value="Update Factory"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="tab-pane fade" id="antenna">
        <section id="antenna-section" class="row">
            <div class="col-lg-4">
                <form class="validate">
                    <label>Add Antenna</label>
                    <div class="form-group"><input type="text" name="name" class="form-control" placeholder="Antenna Model" id="txt-add-antenna-title"></div>
                    <div class="form-group"><input type="text" name="number" class="form-control" placeholder="Antenna Gain" id="txt-add-antenna-gain"></div>
                    <div class="form-group"><input type="text" name="number" class="form-control" placeholder="Antenna Length" id="txt-add-antenna-length"></div>
                    <div class="form-group"><input type="text" name="number" class="form-control" placeholder="Antenna Horiz" id="txt-add-antenna-horiz"></div>
                    <div class="form-group"><input type="text" name="number" class="form-control" placeholder="Antenna Vertic" id="txt-add-antenna-vertic"></div>
                    <div class="form-group"><input type="button" id="btn-add-antenna" class="btn btn-success" disabled value="Add Antenna"></div>
                </form>

            </div>
            <div class="col-lg-8">
                <label>Select Factory</label>
                <div class="form-group"><select class="form-control" id="select-factory-lst"></select></div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-antenna-lst">
                        <thead><tr><th class="header"><i class="fa fa-columns"></th><th class="header">Model <i class="fa fa-sort"></th><th class="header">Gain <i class="fa fa-sort"></th><th class="header">Length <i class="fa fa-sort"></th><th class="header">Horiz <i class="fa fa-sort"></th><th class="header">Vertic <i class="fa fa-sort"></th><th class="header center">Del</th><th class="header center">Edit</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <div id="edit-antenna-section" class="hide col-lg-6 absoluteBox">
                <div class="panel panel-primary fixedBox">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Update Antenna
                            <button type="button" class="close" onclick="return boxClose()">×</button>
                        </h3>
                    </div>
                    <input type="hidden" id="txt-edit-antenna-id">
                    <div class="panel-body">
                        <form class="validate">
                            <label>Antenna Model:</label>
                            <div class="form-group"><input type="text" name="name" id="txt-edit-antenna-model" class="form-control" /></div>
                            <div class="form-group"><input type="text" name="number" id="txt-edit-antenna-gain" class="form-control" /></div>
                            <div class="form-group"><input type="text" name="number" id="txt-edit-antenna-length" class="form-control" /></div>
                            <div class="form-group"><input type="text" name="number" id="txt-edit-antenna-horiz" class="form-control" /></div>
                            <div class="form-group"><input type="text" name="number" id="txt-edit-antenna-vertic" class="form-control" /></div>
                            <div class="form-group"><input type="button" class="btn btn-success" id="btn-edit-antenna" value="Update Antenna"></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <div class="tab-pane fade" id="antennatype">
        <div id="antennatype-section" class="row">
            <div class="col-lg-4">
                <form class="validate">
                    <label>Add Antenna Type</label>
                    <div class="form-group"><input type="text" name="name" class="form-control" placeholder="Antenna Type Name" id="txt-add-antennatype-title"></div>
                    <div class="form-group"><input type="button" id="btn-add-antennatype" disabled class="btn btn-success" value="Add New AntennaType"></div>
                </form>
            </div>
            <div class="col-lg-8">
                <label>Antenna Type List</label>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-antennatype-lst">
                        <thead><tr><th class="header"><i class="fa fa-columns"></th><th class="header">Name <i class="fa fa-sort"></th><th class="header center">Del</th><th class="header center">Edit</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div id="edit-antennatype-section" class="hide col-lg-6 absoluteBox">
                <div class="panel panel-primary fixedBox">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Update Antenna Type
                            <button type="button" class="close" onclick="return boxClose()">×</button>
                        </h3>
                    </div>
                    <input type="hidden" id="txt-edit-antennatype-id">
                    <div class="panel-body">
                        <form class="validate">
                            <label>Antenna Type Name:</label>
                            <div class="form-group"><input type="text" name="name" id="txt-edit-antennatype-title" class="form-control" /></div>
                            <div class="form-group"><input type="button" class="btn btn-success" id="btn-edit-antennatype" value="Update Antenna Type"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="tab-pane fade" id="sitetype">
        <div id="sitetype-section" class="row">
            <div class="col-lg-4">
                <form class="validate">
                    <label>Add Site Type</label>
                    <div class="form-group"><input type="text" name="name" class="form-control" placeholder="Site Type Name" id="txt-add-sitetype-title"></div>
                    <div class="form-group"><input type="button" id="btn-add-sitetype" class="btn btn-success" disabled value="Add New SiteType"></div>
                </form>
            </div>
            <div class="col-lg-8">
                <label>Site Type List</label>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-sitetype-lst">
                        <thead><tr><th class="header"><i class="fa fa-columns"></th><th class="header">Name <i class="fa fa-sort"></th><th class="header center">Del</th><th class="header center">Edit</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div id="edit-sitetype-section" class="hide col-lg-6 absoluteBox">
                <div class="panel panel-primary fixedBox">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Update Site Type
                            <button type="button" class="close" onclick="return boxClose()">×</button>
                        </h3>
                    </div>
                    <input type="hidden" id="txt-edit-sitetype-id">
                    <div class="panel-body">
                        <form class="validate">
                            <label>Site Type Name:</label>
                            <div class="form-group"><input type="text" name="name" id="txt-edit-sitetype-title" class="form-control" /></div>
                            <div class="form-group"><input type="button" class="btn btn-success" id="btn-edit-sitetype" value="Update Site Type"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="tab-pane fade" id="towertype">
        <div id="towertype-section" class="row">
            <div class="col-lg-4">
                <form class="validate">
                    <label>Add Tower Type</label>
                    <div class="form-group"><input type="text" name="name" class="form-control" placeholder="Tower Type Name" id="txt-add-towertype-title"></div>
                    <div class="form-group"><input type="button" disabled id="btn-add-towertype" class="btn btn-success" value="Add New TowerType"></div>
                </form>
            </div>
            <div class="col-lg-8">
                <label>Tower Type List</label>
                <div class="table-responsive overflow">
                    <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-towertype-lst">
                        <thead><tr><th class="header"><i class="fa fa-columns"></th><th class="header">Name <i class="fa fa-sort"></th><th class="header center">Del</th><th class="header center">Edit</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div id="edit-towertype-section" class="hide col-lg-6 absoluteBox">
                <div class="panel panel-primary fixedBox">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Update Tower Type
                            <button type="button" class="close" onclick="return boxClose()">×</button>
                        </h3>
                    </div>
                    <input type="hidden" id="txt-edit-towertype-id">
                    <div class="panel-body">
                        <form class="validate">
                            <label>Tower Type Name:</label>
                            <div class="form-group"><input type="text" name="name" id="txt-edit-towertype-title" class="form-control" /></div>
                            <div class="form-group"><input type="button" disabled class="btn btn-success" id="btn-edit-towertype" value="Update Tower Type"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="tab-pane fade" id="nodebtype">
        <div id="nodebtype-section" class="row">
            <div class="col-lg-4">
                <form class="validate">
                    <label>Add NodeBType Type</label>
                    <div class="form-group"><input type="text" name="name" class="form-control" placeholder="Antenna Type Name" id="txt-add-nodebtype-title"></div>
                    <div class="form-group"><input type="button" id="btn-add-nodebtype" disabled class="btn btn-success" value="Add New NodeBType"></div>
                </form>
            </div>
            <div class="col-lg-8">
                <label>Node B Type List</label>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-nodebtype-lst">
                        <thead><tr><th class="header"><i class="fa fa-columns"></th><th class="header">Name <i class="fa fa-sort"></th><th class="header center">Del</th><th class="header center">Edit</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div id="edit-nodebtype-section" class="hide col-lg-6 absoluteBox">
                <div class="panel panel-primary fixedBox">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Update Node B Type
                            <button type="button" class="close" onclick="return boxClose()">×</button>
                        </h3>
                    </div>
                    <input type="hidden" id="txt-edit-nodebtype-id">
                    <div class="panel-body">
                        <form class="validate">
                            <label>Node B Type Name:</label>
                            <div class="form-group"><input type="text" name="name" id="txt-edit-nodebtype-title" class="form-control" /></div>
                            <div class="form-group"><input type="button" class="btn btn-success" id="btn-edit-nodebtype" value="Update Node B Type"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="tab-pane fade" id="feedertype">
        <div id="feedertype-section" class="row">
            <div class="col-lg-4">
                <form class="validate">
                    <label>Add Feeder Type</label>
                    <div class="form-group"><input type="text" name class="form-control" placeholder="Feeder Type Name" id="txt-add-feedertype-title"></div>
                    <div class="form-group"><input type="button" id="btn-add-feedertype" disabled class="btn btn-success" value="Add New FeederType"></div>
                </form>
            </div>
            <div class="col-lg-8">
                <label>Feeder Type List</label>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-feedertype-lst">
                        <thead><tr><th class="header">id <i class="fa fa-sort"></th><th class="header">Name <i class="fa fa-sort"></th><th class="header center">Del</th><th class="header center">Edit</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div id="edit-feedertype-section" class="hide col-lg-6 absoluteBox">
                <div class="panel panel-primary fixedBox">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Update Feeder Type
                            <button type="button" class="close" onclick="return boxClose()">×</button>
                        </h3>
                    </div>
                    <input type="hidden" id="txt-edit-feedertype-id">
                    <div class="panel-body">
                        <form class="validate">
                            <label>Feeder Type Name:</label>
                            <div class="form-group"><input type="text" name="name" id="txt-edit-feedertype-title" class="form-control" /></div>
                            <div class="form-group"><input type="button" class="btn btn-success" disabled id="btn-edit-feedertype" value="Update Feeder Type"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="tab-pane fade" id="sitestatus">
        <div id="sitestatus-section" class="row">
            <div class="col-lg-4">
                <form class="validate">
                    <label>Add Site Status</label>
                    <div class="form-group"><input type="text" name class="form-control" placeholder="Site Status Name" id="txt-add-sitestatus-title"></div>
                    <div class="form-group"><input type="button" id="btn-add-sitestatus" disabled class="btn btn-success" value="Add New Site Status"></div>
                </form>
            </div>
            <div class="col-lg-8">
                <label>Site Status List</label>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-sitestatus-lst">
                        <thead><tr><th class="header">id <i class="fa fa-sort"></th><th class="header">Name <i class="fa fa-sort"></th><th class="header center">Del</th><th class="header center">Edit</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div id="edit-sitestatus-section" class="hide col-lg-6 absoluteBox">
                <div class="panel panel-primary fixedBox">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Update Site Status
                            <button type="button" class="close" onclick="return boxClose()">×</button>
                        </h3>
                    </div>
                    <input type="hidden" id="txt-edit-sitestatus-id">
                    <div class="panel-body">
                        <form class="validate">
                            <label>Site Status Name:</label>
                            <div class="form-group"><input type="text" name="name" id="txt-edit-sitestatus-title" class="form-control" /></div>
                            <div class="form-group"><input type="button" class="btn btn-success" disabled id="btn-edit-sitestatus" value="Update Site Status"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="tab-pane fade" id="vendors">
        <div id="vendors-section" class="row">
            <div class="col-lg-4">
                <form class="validate">
                    <label>Add Vendors</label>
                    <div class="form-group"><input type="text" name class="form-control" placeholder="Vendors Name" id="txt-add-vendors-title"></div>
                    <div class="form-group"><input type="button" id="btn-add-vendors" disabled class="btn btn-success" value="Add New Vendors"></div>
                </form>
            </div>
            <div class="col-lg-8">
                <label>Vendors List</label>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-vendors-lst">
                        <thead><tr><th class="header">id <i class="fa fa-sort"></th><th class="header">Name <i class="fa fa-sort"></th><th class="header center">Del</th><th class="header center">Edit</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div id="edit-vendors-section" class="hide col-lg-6 absoluteBox">
                <div class="panel panel-primary fixedBox">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Update Vendors
                            <button type="button" class="close" onclick="return boxClose()">×</button>
                        </h3>
                    </div>
                    <input type="hidden" id="txt-edit-vendors-id">
                    <div class="panel-body">
                        <form class="validate">
                            <label>Vendors Name:</label>
                            <div class="form-group"><input type="text" name="name" id="txt-edit-vendors-title" class="form-control" /></div>
                            <div class="form-group"><input type="button" class="btn btn-success" disabled id="btn-edit-vendors" value="Update Vendors"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="tab-pane fade" id="regions">
        <div id="regions-section" class="row">
            <div class="col-lg-4">
                <form class="validate">
                    <label>Add Regions</label>
                    <div class="form-group"><input type="text" name class="form-control" placeholder="Regions Name" id="txt-add-regions-title"></div>
                    <div class="form-group"><input type="button" id="btn-add-regions" disabled class="btn btn-success" value="Add New Regions"></div>
                </form>
            </div>
            <div class="col-lg-8">
                <label>Regions List</label>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-regions-lst">
                        <thead><tr><th class="header">id <i class="fa fa-sort"></th><th class="header">Name <i class="fa fa-sort"></th><th class="header center">Del</th><th class="header center">Edit</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div id="edit-regions-section" class="hide col-lg-6 absoluteBox">
                <div class="panel panel-primary fixedBox">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Update Regions
                            <button type="button" class="close" onclick="return boxClose()">×</button>
                        </h3>
                    </div>
                    <input type="hidden" id="txt-edit-regions-id">
                    <div class="panel-body">
                        <form class="validate">
                            <label>Regions Name:</label>
                            <div class="form-group"><input type="text" name="name" id="txt-edit-regions-title" class="form-control" /></div>
                            <div class="form-group"><input type="button" class="btn btn-success" disabled id="btn-edit-regions" value="Update Regions"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="tab-pane fade" id="ret">
        <div id="ret-section" class="row">
            <div class="col-lg-4">
                <form class="validate">
                    <label>Add Ret</label>
                    <div class="form-group"><input type="text" name class="form-control" placeholder="Ret Name" id="txt-add-ret-title"></div>
                    <div class="form-group"><input type="button" id="btn-add-ret" disabled class="btn btn-success" value="Add New Ret"></div>
                </form>
            </div>
            <div class="col-lg-8">
                <label>Ret List</label>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-ret-lst">
                        <thead><tr><th class="header">id <i class="fa fa-sort"></th><th class="header">Name <i class="fa fa-sort"></th><th class="header center">Del</th><th class="header center">Edit</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div id="edit-ret-section" class="hide col-lg-6 absoluteBox">
                <div class="panel panel-primary fixedBox">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Update Ret
                            <button type="button" class="close" onclick="return boxClose()">×</button>
                        </h3>
                    </div>
                    <input type="hidden" id="txt-edit-ret-id">
                    <div class="panel-body">
                        <form class="validate">
                            <label>Ret Name:</label>
                            <div class="form-group"><input type="text" name="name" id="txt-edit-ret-title" class="form-control" /></div>
                            <div class="form-group"><input type="button" class="btn btn-success" disabled id="btn-edit-ret" value="Update Ret"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="tab-pane fade" id="planner">
        <div id="planner-section" class="row">
            <div class="col-lg-4">
                <form class="validate">
                    <label>Add Planner</label>
                    <div class="form-group"><select class="form-control" placeholder="Planner Name" id="select-add-planner-title"></select></div>
                    <div class="form-group"><input type="button" id="btn-add-planner" class="btn btn-success" value="Add New Planner"></div>
                </form>
            </div>
            <div class="col-lg-8">
                <label>Planner List</label>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-planner-lst">
                        <thead><tr><th class="header">id <i class="fa fa-sort"></th><th class="header">Name <i class="fa fa-sort"></th><th class="header center">Del</th><th class="header center">Edit</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="tab-pane fade" id="cluster">
        <div id="ret-section" class="row">
            <div class="col-lg-4">
                <form class="validate">
                    <label>Add Ret</label>
                    <div class="form-group"><input type="text" name class="form-control" placeholder="Cluster Name" id="txt-add-cluster-title"></div>
                    <div class="form-group"><input type="button" id="btn-add-cluster" disabled class="btn btn-success" value="Add New Cluster"></div>
                </form>
            </div>
            <div class="col-lg-8">
                <label>Cluster List</label>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-cluster-lst">
                        <thead><tr><th class="header">id <i class="fa fa-sort"></th><th class="header">Name <i class="fa fa-sort"></th><th class="header center">Del</th><th class="header center">Edit</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div id="edit-cluster-section" class="hide col-lg-6 absoluteBox">
                <div class="panel panel-primary fixedBox">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Update Cluster
                            <button type="button" class="close" onclick="return boxClose()">×</button>
                        </h3>
                    </div>
                    <input type="hidden" id="txt-edit-cluster-id">
                    <div class="panel-body">
                        <form class="validate">
                            <label>Cluster Name:</label>
                            <div class="form-group"><input type="text" name="name" id="txt-edit-cluster-title" class="form-control" /></div>
                            <div class="form-group"><input type="button" class="btn btn-success" disabled id="btn-edit-cluster" value="Update Cluster"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="tab-pane fade" id="sitecluster">
        <div id="planner-section" class="row">
            <div class="col-lg-4">
                <form class="validate">
                    <label>Add Site Cluster</label>
                    <div class="form-group"><select class="form-control" id="select-sitecluster-lst"></select></div>
                    <div class="form-group"><input type="button" id="btn-add-sitecluster" class="btn btn-success" value="Add New Site Cluster"></div>
                </form>
            </div>
            <div class="col-lg-8">
                <label>Site Name List</label>
                <div class="form-group"><select class="form-control" placeholder="Planner Name" id="select-sitename-lst"></select></div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped tablesorter" id="tbl-sitecluster-lst">
                        <thead><tr><th class="header">id <i class="fa fa-sort"></th><th class="header">Cluster Name<i class="fa fa-sort"></th><th class="header">Site Name <i class="fa fa-sort"></th><th class="header center">Del</th><th class="header center">Edit</th></tr></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="tab-pane fade" id="label">
        <div class="btn-group tabularCustom" style="margin-bottom: 10px;">
            <button class="active btn btn-default"><a href="#sites" class="labels-sites-menu-item" data-toggle="tab">Edit Site Labels</a></button>
            <button class="btn btn-default"><a href="#user" data-toggle="tab" id="">Edit User Labels</a></button>
            <button class="btn btn-default"><a href="#roles" data-toggle="tab" id="">Edit Roles Labels</a></button>
            <button class="btn btn-default"><a href="#objects" data-toggle="tab" id="">Edit Objects Labels</a></button>
        </div>
        <div class="tab-content">
            <div class="row fade tab-pane active in" id="sites">
                <div id="edit-label-lst">
                </div>
                <div class="form-group"><input type="button" class="btn btn-warning" id="btn-assign-labels" value="Edit Label"></div>
            </div>
            <div class="row fade tab-pane" id="user">
                comming soon
            </div>
            <div class="row fade tab-pane" id="roles">
                comming soon
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="reset">
        <div class="col-lg-5">
            <div class="panel-body">
                <form class="validate">
                    <label>Please Select User for Reset Password</label>
                    <div class="form-group">
                        <select name="select" class="form-control" id="select-user-chng-pass"></select>
                    </div>
                    <label>Enter New Password</label>
                    <div class="form-group">
                        <input type="text" name="field1" id="chng-pass-new-1" class="form-control" placeholder="New Password" />
                    </div>
                    <label>Confirm New Password</label>
                    <div class="form-group">
                        <input type="text" name="field2" id="chng-pass-new-2" class="form-control" placeholder="Confirm New Password" />
                    </div>
                    <div class="form-group">
                        <button id="btn-change-pass" disabled class="btn btn-success">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </section>

    <script type="text/javascript" src="js/home.js"></script>
<?php
include_once 'common/footer.tmpl.php';