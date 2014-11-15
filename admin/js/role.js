/**
 * Created by sh.hasanzadeh on 8/20/14.
 */
var url = "index.php";
var role_sections = ['edit-role-section',''];

$(document).ready( function(){
    var post = "control=role&action=getlist";

    ajaxCall(post, url, shownotification('wait'), showRoleListSuccess, removenotification);
});


/* Buttons */
$("#btn-add-role").on('click', function(){
    var post = "control=role&action=addrole&title="+$("#txt-new-role").val();

    ajaxCall(post, url, shownotification('Wait'), addNewRoleSuccess, removenotification);
});
$("#btn-edit-role").on('click', function(){
    var post = "control=role&action=editrole&title="+$("#txt-edit-role").val()+"&id="+$("#edit-role-id").val();

    //alert(post);

    ajaxCall(post, url,shownotification('Wait'), editRoleSuccess, removenotification);
});
$("#btn-assign-permission-role").on('click', function(){
    var sThisVal =[];
    $('input:checkbox.myClass:checked').each(function () {
        sThisVal.push(this.checked ? $(this).val() : "");
    });

    sThisVal = (sThisVal.length > 0) ? sThisVal : 'false';

    var post = "control=role&action=doassignperm&id="+ $('#assign-permission-role-id').val();
    post += "&perm=" + sThisVal;

    //alert(post);

    ajaxCall(post, url, shownotification('Wait'), assignPermissionSuccess, removenotification);
});
$("#btn-show-table-columns").on('click', function(){
    var post = "control=role&action=assigntablepermission&table_name="+$("#lst-table-names").val()+"&id="+$('#assign-permission-role-id').val();

    alert(post);

    //ajaxCall(post, url, shownotification('wait'), showTableDetailsSuccess, removenotification());
});

/* Operational Functions */
function deleteRole(id){
    if (confirm("Are you sure you want to delete the role?")){
        var post = "control=role&action=deleterole&id="+id;

        ajaxCall(post, url, shownotification("Wait.."), deleteRoleSuccess, removenotification);
    }
    else{
        return false;
    }
}

function editRole(id){
    $("#edit-role-id").val(id);
    var post = "control=role&action=getrole&id="+id;

    ajaxCall(post, url, shownotification("wait"), loadRoleSuccess, removenotification);
}

function assignRolePermissions(id){

    $('#assign-permission-role-id').val(id);

    var post = "control=role&action=assignpermission&id="+id;

    ajaxCall(post, url, shownotification('Wait'), showAssignPermissionSuccess, removenotification);

}

function assignRoleTablePermissions(id){
    $('#assign-permission-role-id').val(id);

    var post = "control=db&action=gettablenames";

    ajaxCall(post, url, shownotification('Wait'), showAssignTablePermissionSuccess, removenotification);
}

/* Ajax Success Functions*/


function showAssignTablePermissionSuccess(data){
    data = JSON.parse(data);

    $("#lst-table-names").html('');
    $.each(data, function(i, table){
        var option = "<option id='"+table+"'>"+table+"</option>";

        $("#lst-table-names").append(option);
    });
}

function assignPermissionSuccess(data){
    data = JSON.parse(data);

    if (data != false && data != 'false'){
        $("#assign-permission-role-title").val('');
        $("#tbl-assign-permission-role >thead").html('');
        $("#tbl-assign-permission-role >tbody").html('');

        alert("Permissions assigned successfully.");

        $("#assign-permission-role").fadeOut();
    }
}

function editRoleSuccess(data){
    //alert (data);
    data = JSON.parse(data);

    if (data != false && data != "false"){
        $("#edit-role-section").fadeOut();
        //toggleBoxes('edit-role-section', role_sections);
        $("#txt-edit-role").val("");

        var post = "control=role&action=getlist";

        ajaxCall(post, url, shownotification('wait'), showRoleListSuccess, removenotification);
    }
    else{
        alert("Item couldn't be edited. Please try again.");
    }
}

function showAssignPermissionSuccess(data){
    data = JSON.parse(data);

    var objects = data['objects'];
    var rights = data['rights'];
    var role = data['role'];
    var assigned = data['assigned'];

    //alert(assigned);

    //alert();
    $("#assign-permission-role-title").val('');
    $.each(role, function(i,v){
        $("#assign-permission-role-title").val(v['title']);
    });

    $('#tbl-assign-permission-role > tbody').html('');
    $.each(objects, function(i,v){
        var row = "<tr id='row_"+objects[i]['id']+"'>";
        row += "<td>"+v['id']+"</td>";
        row += "<td>"+v['title']+"</td>";

        for (i=0; i<rights.length; i++){
            var isAssigned = false;
            $.each(assigned, function(ii,vv){
                //alert(vv['id']);
                if (vv['object_id'] == v['id'] && vv['right_id'] == rights[i]['id']){
                    //alert(vv['id']);
                    isAssigned = true;
                }
            });

            if (isAssigned){
                row += "<td><input class='myClass' checked type='checkbox' id='chk_"+rights[i]['id']+"' value='"+v['id']+"-"+rights[i]['id']+"'></td>"
            }
            else {
                row += "<td><input class='myClass' type='checkbox' id='chk_"+rights[i]['id']+"' value='"+v['id']+"-"+rights[i]['id']+"'></td>"
            }

        }
        row += "</tr>";
        $('#tbl-assign-permission-role > tbody').append(row);
    });

    $('#tbl-assign-permission-role > thead').html('');
    var row = "<tr><td>id</td><td>Object</td>";
    $.each(rights, function(i,v){
        row += "<td>"+v['title']+"</td>";
    });
    row += "</tr>";
    $('#tbl-assign-permission-role > thead:first').append(row);

    $("#assign-permission-role").fadeIn();
}

function loadRoleSuccess(data){
    //alert(data);

    data = JSON.parse(data);

    $("#txt-edit-role").val('');

    $.each(data, function(i,v){
        $("#txt-edit-role").val(v['title']);
    });

    toggleBoxes('edit-role-section', role_sections);
    //$("#edit-role-section").fadeIn();
}

function deleteRoleSuccess(data){
    data = JSON.parse(data);

    if( data != false && data != "false"){
        var post = "control=role&action=getlist";

        ajaxCall(post, url, shownotification('wait'), showRoleListSuccess, removenotification);
    }
    else{
        alert("Couldn't delete the item. Please try again.");
    }
}

function showRoleListSuccess(data){
    //alert(data);

    data = JSON.parse(data);

    $('#tbl-roles-list > tbody').html('');

    $.each(data, function(i,v){
        var row = "<tr><td>"+i+"</td>";
        row += "<td>"+v['title']+"</td>";
        row += "<td><a class='iconTable' href='#' onclick='deleteRole("+v['id']+");' >"+"<i class='fa fa-trash-o'>del</i>"+"</a></td>";
        row += "<td><a class='iconTable' href='#' onclick='editRole("+v['id']+");whitebg();'> "+"<i class='fa fa-edit'>edit</i>"+"</a></td>";
        row += "<td><a class='iconTable' href='#' onclick='assignRolePermissions("+v['id']+");whitebg();'> "+"<i class='fa fa-edit'>assign</i>"+"</a></td>";
        row += "<td><a class='iconTable' href='#' onclick='assignRoleTablePermissions("+v['id']+");whitebg();'> "+"<i class='fa fa-edit'>assign</i>"+"</a></td>";
        row += "</td></tr>";

        $('#tbl-roles-list > tbody:first').append(row);
    });

//    toggleBoxes('role-section',boxes);
}

function addNewRoleSuccess(data){
    data = JSON.parse(data);
    if (data != false && data != "false"){
        $("#txt-new-role").val("");
        var post = "control=role&action=getlist";

        ajaxCall(post, url, shownotification('wait'), showRoleListSuccess, removenotification);
    }
    else {
        alert("Error in inserting new object. Please try again.");
    }
}