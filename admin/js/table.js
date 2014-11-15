/**
 * Created by sh.hasanzadeh on 10/1/2014.
 */

var url = 'index.php';


$(document).ready(function(){
    var post = "control=db&action=gettablenames";

    ajaxCall(post, url, shownotification('wait'), showTablesSuccess, removenotification);
});
/* General */
function Close(box){

    $("#"+box).fadeOut();
    //$("#"+box).addClass('hidden');
}

/* Operational Functions */
function showTableDetails(table_name){
    var post = "control=db&action=getdetails&table_name="+table_name;

    //alert(post);

    ajaxCall(post, url, shownotification('wait'), showTableDetailsSuccess, removenotification());
}

/* AJAX Success Functions */
function showTableDetailsSuccess(data){
    //alert('hi');
    data = JSON.parse(data);

    $("#tbl-table-columns > tbody").html('');

    $.each(data, function(i, col){
        var row = "<tr><td>"+i+"</td><td>"+col+"</td></tr>";

        $("#tbl-table-columns > tbody").append(row);
    });

    $("#details-table-section").removeClass('hidden');
    $("#details-table-section").fadeIn();
}

function showTablesSuccess(data){
    data = JSON.parse(data);

    $("#tbl-tables-list > tbody").html('');

    $.each(data, function(i, table){
        var row = "<tr><td>"+(i+1)+"</td><td>"+table+"</td><td><a href='#' onclick='return showTableDetails("+"\""+table+"\""+");'>Details</a></td></tr>";

        $("#tbl-tables-list > tbody").append(row);
    });
}