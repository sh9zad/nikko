/**
 * Created by sh.hasanzadeh on 8/20/14.
 */
var url = 'index.php';

$(document).ready( function(){
    var post = "control=right&action=getlist";

    ajaxCall(post, url, shownotification('wait'), showRightListSuccess, removenotification);
});

/* Buttons */
$("#btn-add-right").on('click', function(){
    var post = "control=right&action=addright&title="+$("#txt-new-right").val();

    ajaxCall(post, url, shownotification('Wait'), addNewRightSuccess, removenotification);
});
$("#btn-edit-right").on('click', function(){
    var post = "control=right&action=editright&title="+$("#txt-edit-right").val()+"&id="+$("#edit-right-id").val();

    //alert(post);

    ajaxCall(post, url,shownotification('Wait'), editRightSuccess, removenotification);
});

/* Operational Functions */
function deleteRight(id){
    if (confirm("Are you sure you want to delete the role?")){
        var post = "control=right&action=deleteright&id="+id;

        ajaxCall(post, url, shownotification("Wait.."), deleteRightSuccess, removenotification);
    }
    else{
        return false;
    }
}

function editRight(id){
    $("#edit-right-id").val(id);
    var post = "control=right&action=getright&id="+id;

    ajaxCall(post, url, shownotification("wait"), loadRightSuccess, removenotification);
}

/* Ajax Success Functions */
function editRightSuccess(data){
    //alert (data);
    data = JSON.parse(data);

    if (data != false && data != "false"){
        $("#edit-right-section").fadeOut();
        $("#edit-right-section").addClass('hide');
        $("#txt-edit-right").val("");

        var post = "control=right&action=getlist";

        ajaxCall(post, url, shownotification('wait'), showRightListSuccess, removenotification);
    }
    else{
        alert("Item couldn't be edited. Please try again.");
    }
}

function loadRightSuccess(data){
    data = JSON.parse(data);

    $("#txt-edit-right").val('');

    $.each(data, function(i,v){
        $("#txt-edit-right").val(v['title']);
    });

    $("#edit-right-section").fadeIn();
    $("#edit-right-section").removeClass('hide');
}

function deleteRightSuccess(data){
    data = JSON.parse(data);

    if( data != false && data != "false"){
        var post = "control=right&action=getlist";

        ajaxCall(post, url, shownotification('wait'), showRightListSuccess, removenotification);
    }
    else{
        alert("Couldn't delete the item. Please try again.");
    }
}

function addNewRightSuccess(data){
    data = JSON.parse(data);
    if (data != false && data != "false"){
        $("#txt-new-right").val("");
        var post = "control=right&action=getlist";

        ajaxCall(post, url, shownotification('wait'), showRightListSuccess, removenotification);
    }
    else {
        alert("Error in inserting new object. Please try again.");
    }
}

function showRightListSuccess(data){
    data = JSON.parse(data);

    $('#tbl-right-list > tbody').html('');

    $.each(data, function(i,v){
        var row = "<tr><td>"+i+"</td>";
        row += "<td>"+v['title']+"</td>";
        row += "<td><a class='iconTable' href='#' onclick='deleteRight("+v['id']+");' >"+"<i class='fa fa-trash-o'>del</i>"+"</a></td>";
        row += "<td><a class='iconTable' href='#' onclick='editRight("+v['id']+");whitebg();'> "+"<i class='fa fa-edit'>edit</i>"+"</a></td>";
        row += "</td></tr>";

        $('#tbl-right-list > tbody:first').append(row);
    });
}
