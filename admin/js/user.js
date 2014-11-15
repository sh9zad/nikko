/**
 * Created by sh.hasanzadeh on 8/20/14.
 */
var url = "index.php";
var user_sections = ['edit-user-section','assign-role-section'];

$(document).ready(function(){
    var post = "control=user&action=getlist";
    ajaxCall(post, url, shownotification('wait'), showUsersSectionSuccess, removenotification);
});

/* Buttons */
$("#add-new-user").on('click', function(){
    var post = "control=user&action=adduser&name="+$("#txt-new-user-name").val();
    post += "&family="+$("#txt-new-user-family").val();
    post += "&username="+$("#txt-new-user-username").val();
    post += "&pass="+$("#txt-new-user-password").val();
    post += "&email="+$("#txt-new-user-email").val();

    //alert(post);

    ajaxCall(post, url, shownotification("Wait"), addNewUserSuccess, removenotification);
});

$("#edit-new-user").on('click', function(){
    var post = "control=user&action=edituser&name="+$("#txt-edit-user-name").val();
    post += "&family="+$("#txt-edit-user-family").val();
    post += "&username="+$("#txt-edit-user-username").val();
    post += "&pass="+$("#txt-edit-user-password").val();
    post += "&email="+$("#txt-edit-user-email").val();
    post += "&id="+$("#edit-edit-id").val();

    //alert(post);

    ajaxCall(post, url,shownotification('Wait'), editUserSuccess, removenotification);
});

$("#btn-do-assign-role").on('click', function(){
//alert('hi');
    var roles = [];
    $('#lst-all-roles-selected option').each(function() {
        roles.push($(this).val());
    });

    if (roles.lenght < 1){
        alert("Please select a role.");
        return false;
    }
    roles = (roles == '') ? 'false' : roles;
    //alert();
    var post = "control=role&action=doassign";
    post += "&user_id="+$("#edit-role-user-id").val();
    post += "&roles="+roles;


    //alert(post);
    ajaxCall(post, url, shownotification(" "), assignRolesSuccess, removenotification);

});

/*list select functions*/
$('#selectitem').click(function() {
    return !$('#lst-all-roles option:selected').appendTo('#lst-all-roles-selected');
});
$('#removeitem').click(function() {
    return !$('#lst-all-roles-selected option:selected').appendTo('#lst-all-roles');
});

/* General Operations */
function deleteUser(id){
    if (confirm("Are you sure you want to delete the role?")){
        var post = "control=user&action=deleteuser&id="+id;

        ajaxCall(post, url, shownotification("Wait.."), deleteUserSuccess, removenotification);
    }
    else{
        return false;
    }
}

function editUser(id){
    $("#edit-edit-id").val(id);
    var post = "control=user&action=getuser&id="+id;

    ajaxCall(post, url, shownotification("wait"), loadUserSuccess, removenotification);
}

function getUserRole(id){
    $("#edit-role-user-id").val(id);

    var post = "control=role&action=assign&user_id="+id;

    ajaxCall(post, url, shownotification("Wait"), showAssignSectionSuccess, removenotification);
}

/* Ajax Success Functions */
function assignRolesSuccess(data){
    data = JSON.parse(data);

    if (data != 'false' && data != false){
        $("#lst-all-users").val('');
        $('#lst-all-roles').html('');
        $("#lst-all-roles-selected").html('');
        alert("Roles successfully assigned.");

        $("#assign-role-section").fadeOut();
    }
    else{
        alert("System error please try again later.");
    }
}

function addNewUserSuccess(data){
    //alert(data);

    data = JSON.parse(data);
    if (data['success'] == 1 || data['success'] == "1"){
        $("#txt-new-user-name").val("");
        $("#txt-new-user-family").val("");
        $("#txt-new-user-username").val("");
        $("#txt-new-user-password").val("");
        $("#txt-new-user-email").val("");
        var post = "control=user&action=getlist";

        ajaxCall(post, url, shownotification("Wait"), showUsersSectionSuccess, removenotification);
    }
    else if (data['success'] == 0 || data['success'] == "0"){
        alert(data['msg'] + " Suggestion: " + data['suggestion']);
        $("#txt-new-user-username").val(data['suggestion']);
    }
}

function showUsersSectionSuccess(data){
    //alert(data);

    data = JSON.parse(data);

    $('#tbl-users-list > tbody').html('');

    $.each(data, function(i,v){
        var row = "<tr><td>"+i+"</td>";
        row += "<td>"+v['name']+"</td>";
        row += "<td>"+v['familyname']+"</td>";
        row += "<td>"+v['username']+"</td>";
        row += "<td>"+v['email']+"</td>";
        row += "<td><a href='#' class='iconTable' onclick='deleteUser("+v['id']+");' >"+"<i class='fa fa-trash-o'>del</i>"+"</a></td>";
        row += "<td><a href='#' class='iconTable' onclick='editUser("+v['id']+");whitebg();'> "+"<i class='fa fa-edit'>edit</i>"+"</a></td>";
        row += "<td><a href='#' class='iconTable' onclick='getUserRole("+v['id']+");whitebg();'> "+"<i class='fa fa-edit'>roles</i>"+"</a></td>";
        row += "</td></tr>";

        $('#tbl-users-list > tbody:first').append(row);
    });
}

function deleteUserSuccess(data){
    data = JSON.parse(data);

    if( data != false && data != "false"){
        var post = "control=user&action=getlist";

        ajaxCall(post, url, shownotification("Wait"), showUsersSectionSuccess, removenotification);
    }
    else{
        alert("Couldn't delete the item. Please try again.");
    }
}

function loadUserSuccess(data){
    data = JSON.parse(data);

    $("#txt-edit-user-name").val('');
    $("#txt-edit-user-family").val('');
    $("#txt-edit-user-username").val('');
    $("#txt-edit-user-password").val('');
    $("#txt-edit-user-email").val('');

    $.each(data, function(i,v){
        $("#txt-edit-user-name").val(v['name']);
        $("#txt-edit-user-family").val(v['familyname']);
        $("#txt-edit-user-username").val(v['username']);
        $("#txt-edit-user-password").val(v['password']);
        $("#txt-edit-user-email").val(v['email']);
    });

    toggleBoxes('edit-user-section', user_sections);
}

function showAssignSectionSuccess(data){

    data = JSON.parse(data);

    var users = data['users'];
    var roles_a = data['roles_a'];
    var roles_u = data['roles_u'];

    $("#lst-all-users").val('');
    $.each(users, function(i,v){
        $("#lst-all-users").val(v['name'] +" "+ v['familyname']);
    });

    $('#lst-all-roles').html('');
    $.each(roles_u, function(i,v){
        var option = "<option value='"+v['id']+"'>" + v['title'] + "</option>";

        $("#lst-all-roles").append(option);
    });

    $("#lst-all-roles-selected").html('');
    $.each(roles_a, function(i,v){
        var option = "<option value='"+v['id']+"'>" + v['title'] + "</option>";

        $("#lst-all-roles-selected").append(option);
    });

    toggleBoxes('assign-role-section', user_sections);
}

function editUserSuccess(data){
    data = JSON.parse(data);

    if (data != false && data != "false"){
        $("#edit-user-section").fadeOut();
        $("#txt-edit-user-name").val("");
        $("#txt-edit-user-family").val("");
        $("#txt-edit-user-username").val("");
        $("#txt-edit-user-password").val("");
        $("#txt-edit-user-email").val("");

        var post = "control=user&action=getlist";

        ajaxCall(post, url, shownotification("Wait"), showUsersSectionSuccess, removenotification);
    }
    else{
        alert("Item couldn't be edited. Please try again.");
    }


}

