/**
 * Created by shervin on 11/23/14.
 */
var url = 'index.php';

$(document).ready( function(){
    var post = "control=user&action=getlist&id="+$("#user-id").val();

    ajaxCall(post, url, shownotification('wait'), showUserInfoSuccess, removenotification);
});


/* AJAX Return Success */
function showUserInfoSuccess(data){
    data = JSON.parse(data);

    if (data['error'] == 'false' || data['error'] == false){
        var formGen = new FormGenerator(data['table_info']['schema'], data['table_info']['labels'], data['table_info']['ids']);

        $("#section-user-info").html(formGen.createEmptyFormList(data['user'], data['table_info']['ids']));
    }
    else {
        alert(data['msg']);
    }
}