/**
 * Created by sh.hasanzadeh on 10/15/2014.
 */
var url = "index.php";
var service_id = 0;

$(document).ready(function(){
    var post = "control=service&action=getlist";

    ajaxCall(post, url, shownotification('wait'), showListSuccess, removenotification());
});

/* Operational Function */
function showAlias(id){
    service_id = id;
    var post = "control=service&action=getlist&id="+id;

    ajaxCall(post, url, shownotification('wait'), showServiceAlias, removenotification());
}

function deleteService(id){
    if (confirm("Are you sure you want to delete this service?")){
        var post = "control=service&action=deleteservice&id="+id;

        ajaxCall(post, url, shownotification('wait'), deleteServiceSuccess, removenotification());
    }
    else {
        return false;
    }
}

function editService(id){
    $("#edit-service-section").addClass('hidden');

    var post = "control=service&action=getlist&id="+id;

    ajaxCall(post, url, shownotification('wait'), showServiceDetails, removenotification());
}

function editAlias(id){

}

/* Form Submit */
$("#frm-edit-service").on('submit', function () {
    if ($("#txt-edit-service").val().trim().length > 0){
        var post = "control=service&action=updateservice&service="+$("#txt-edit-service").val()+"&id="+$("#edit-service-id").val();

        ajaxCall(post, url, shownotification('wait'), editServiceSuccess, removenotification());
    }
    else {
        alert("Error");
    }
    return false;
});

$("#frm-add-new-alias").on('submit', function () {
    if (($("#txt-new-alias-name").val().trim().length > 0) && (service_id != 0)){
        var post = "control=service&action=addalias&alias="+$("#txt-new-alias-name").val()+"&service_id="+service_id;

        ajaxCall(post, url, shownotification('wait'), addAliasSuccess, removenotification());
    }
    else {
        alert("Error");
    }
    return false;
});

$("#frm-add-new-service").on('submit', function () {
    if ($("#txt-new-service-name").val().trim().length > 0){
        var post = "control=service&action=addservice&service="+$("#txt-new-service-name").val();

        ajaxCall(post, url, shownotification('wait'), addServiceSuccess, removenotification());
    }
    else {
        alert("Error");
    }
    return false;
});

/* AJAX Success calls */
function addAliasSuccess(data){
    data = JSON.parse(data);

    if (data['error'] == false){
        alert(data['msg']);
        $("#txt-new-alias-name").val('');

        var post = "control=service&action=getlist&id="+service_id;

        ajaxCall(post, url, shownotification('wait'), showServiceAlias, removenotification());

    }
}

function showServiceAlias(data){
    data = JSON.parse(data);
    $("#alias-service").html("Service Name: <strong>"+ data['services'][0]['title'] + "</strong>");

    if(data['alias'].length > 0){
        $("#alias-msg").fadeOut();
        $("#tbl-alias-list > tbody").html('');

        $.each(data['alias'], function(i, alis){
            var row = "<tr>" +
                    "<td>"+alis['id']+"</td>"+
                    "<td>"+alis['alias']+"</td>"+
                    "<td><a href='#' onclick='return editAlias("+alis['id']+")'><i class='fa fa-edit'> Edit</i></a></td>"+
                    "<td><a href='#' onclick='return deleteAlias("+alis['id']+")'><i class='fa fa-trash-o'> Delete</i></a></td>"+
                "</tr>";

            $("#tbl-alias-list > tbody").append(row);
        });

        $("#tbl-alias-list").removeClass('hidden');
        $("#tbl-alias-list").fadeIn();
    }
    else {
        $("#alias-msg").html('<strong>No alias Available.</strong>');
        $("#alias-msg").fadeIn();
        $("#tbl-alias-list").fadeOut();
    }

    $("#alias-section").removeClass('hidden');
}

function editServiceSuccess(data){
    data = JSON.parse(data);

    if (data['error'] == false || data['error'] == "false"){
        alert(data['msg']);

        $("#edit-service-section").fadeOut('hidden');
        $("#edit-service-section").addClass('hidden');

        var post = "control=service&action=getlist";

        ajaxCall(post, url, shownotification('wait'), showListSuccess, removenotification());
    }
    else {
        alert(data['msg']);
        return false;
    }
}

function showServiceDetails(data){
    data = JSON.parse(data);

    $("#edit-service-id").val(data['services'][0]['id']);
    $("#txt-edit-service").val(data['services'][0]['title']);

    $("#edit-service-section").fadeIn();
    $("#edit-service-section").removeClass('hidden');
}

function deleteServiceSuccess(data){
    //alert(data);
    data = JSON.parse(data);

    if (data['error'] == false || data['error'] == 'false'){
        alert(data['msg']);
        var post = "control=service&action=getlist";

        ajaxCall(post, url, shownotification('wait'), showListSuccess, removenotification());
    }
    else if (data['error'] == true || data['error'] == 'true'){
        alert(data['msg']);
        return false;
    }
}

function addServiceSuccess(data){
    //alert(data);
    data = JSON.parse(data);

    if(data['error'] == 'false' || data['error'] == false){
        $("#txt-new-service-name").val('');
        var post = "control=service&action=getlist";

        ajaxCall(post, url, shownotification('wait'), showListSuccess, removenotification());
    }
    else if(data['error'] == 'true' || data['error'] == true){
        alert(data['msg']);
    }
}

function showListSuccess(data){
    //alert(data);
    data = JSON.parse(data);

    var services = data['services'];
    var alias = data['alias'];

    if (services.length > 0){
        $("#tbl-service-list > tbody").html('');

        $.each(services, function(i, service){
            var row = "<tr>" +
                    "<td>"+service['id']+"</td>"+
                    "<td>"+service['title']+"</td>"+
                    "<td><a href='#' onclick='return showAlias("+service['id']+")'>Show</a></td>"+
                    "<td><a href='#' onclick='return editService("+service['id']+")'><i class='fa fa-edit'> Edit</i></a></td>"+
                    "<td><a href='#' onclick='return deleteService("+service['id']+")'><i class='fa fa-trash-o'> Delete</i></a></td>"+
                "</tr>";

            $("#tbl-service-list > tbody").append(row);
        });

        $("#tbl-service-list").removeClass('hide');
        $("#tbl-service-list").fadeIn();

    }
    else{
        $("#tbl-service-list").fadeOut();
    }
}