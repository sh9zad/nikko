/**
 * Created by sh.hasanzadeh on 8/20/14.
 */
var url = "index.php";

$(document).ready(function(){
    var post = "control=object&action=getlist";

    ajaxCall(post, url, shownotification('wait'), showObjectListSuccess, removenotification);
});

/* Buttons */
$("#add-new-object").on('click', function(){
    var post = "control=object&action=addobject&title="+$("#txt-new-object").val();
    alert(post);
    //ajaxCall(post, url,shownotification('Wait'), addNewObjectSuccess, removenotification);
});

$("#btn-edit-object").on('click', function(){
    var post = "control=object&action=editobject&title="+$("#txt-edit-object").val()+"&id="+$("#edit-object-id").val();
    //alert(post);
    ajaxCall(post, url,shownotification('Wait'), editObjectSuccess, removenotification);
});

/* Operational Functions */
function deleteObject(id){
    //alert(id);

    if (confirm("Are you sure you want to delete the object?")){
        var post = "control=object&action=deleteobject&id="+id;

        ajaxCall(post, url, shownotification("Wait.."), deleteObjectSuccess, removenotification);
    }
    else{
        return false;
    }
}

function editObject(id){
    $("#edit-object-id").val(id);
    var post = "control=object&action=getobject&id="+id;

    ajaxCall(post, url, shownotification("wait"), loadObjectSuccess, removenotification);
}

/* Ajax Success Functions*/
function editObjectSuccess(data){
    data = JSON.parse(data);

    if (data != false && data != "false"){
        $("#edit-object-section").fadeOut();
        $("#txt-edit-object").val("");

        var post = "control=object&action=getlist";

        ajaxCall(post, url, shownotification('wait'), showObjectListSuccess, removenotification)
    }
    else{
        alert("Item couldn't be edited. Please try again.");
    }
}

function loadObjectSuccess(data){
    data = JSON.parse(data);

    $("#txt-edit-object").val('');
    $.each(data, function(i,v){
        $("#txt-edit-object").val(v['title']);
    });

    $("#edit-object-section").fadeIn();
}

function deleteObjectSuccess(data){
    data = JSON.parse(data);

    if( data != false && data != "false"){
        var post = "control=object&action=getlist";

        ajaxCall(post, url, shownotification('wait'), showObjectListSuccess, removenotification)
    }
    else{
        alert("Couldn't delete the item. Please try again.");
    }
}

function showObjectListSuccess(data){
    //console.log(data);
    data = JSON.parse(data);

    $('#tbl-objects-list > tbody').html('');

    $.each(data, function(i,v){
        var row = "<tr><td>"+i+"</td>";
        row += "<td>"+v['title']+"</td>";
        row += "<td><a href='#' class='iconTable' onclick='deleteObject("+v['id']+");' >"+"<i class='fa fa-trash-o'>del</i>"+"</a></td>";
        row += "<td><a href='#' class='iconTable' onclick='editObject("+v['id']+");whitebg();'> "+"<i class='fa fa-edit'>edit</i>"+"</a></td>";
        row += "</td></tr>";

        $('#tbl-objects-list > tbody:first').append(row);
    });

    //toggleBoxes('objects-section', boxes);
}

function addNewObjectSuccess(data){
    data = JSON.parse(data);
    if (data != false && data != "false"){
        $("#txt-new-object").val("");
        var post = "control=object&action=getlist";

        ajaxCall(post, url, shownotification('wait'), showObjectListSuccess, removenotification)
    }
    else {
        alert("Error in inserting new object. Please try again.");
    }
}