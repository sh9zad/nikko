/**
 * Created by sh.hasanzadeh on 8/20/14.
 */
var url = 'index.php';

$(document).ready(function(){
    var post = "control=city&action=getlist&isAjax=1";

    ajaxCall(post, url, shownotification("Wait"), showProvincesSuccess, removenotification);
});

/* Tab Select Functions */
$("#btn-show-cities").on('click', function(){
    var post = "control=city&action=getlistforcities";

    ajaxCall(post, url, shownotification("Wait"), showCitySuccess, removenotification);
});

$("#btn-show-provinces").on('click', function(){
    var post = "control=city&action=getlist&isAjax=1";

    ajaxCall(post, url, shownotification("Wait"), showProvincesSuccess, removenotification);
});

/* Buttons */
$("#btn-add-city").on('click', function(){

    var post = "control=city&action=addcity&title="+ $('#txt-add-city-title').val() + "&prov_id=" + $('#select-city-lst').val();

    ajaxCall(post, url, shownotification('Wait'), addCitySuccess, removenotification);
});

$("#btn-edit-city").on('click', function(){

    var post = "control=city&action=editcity&id="+ $('#txt-edit-city-id').val()+"&title="+$('#txt-edit-city-title').val();

    ajaxCall(post, url, shownotification('Wait'), editCitySuccess, removenotification);
});

$("#btn-add-province").on('click', function(){

    var post = "control=city&action=addprovince&title="+ $('#txt-add-province-title').val();

    ajaxCall(post, url, shownotification('Wait'), addProvinceSuccess, removenotification);
});

$("#btn-edit-province").on('click', function(){

    var post = "control=city&action=editprovince&id="+ $('#txt-edit-province-id').val()+"&title="+$('#txt-edit-province-title').val();

    //alert(post);

    ajaxCall(post, url, shownotification('Wait'), editProvinceSuccess, removenotification);
});

/* Operational Functions */
function editProvince(id){
    $("#txt-edit-province-id").val(id);
    var post = "control=city&action=getprovince&id="+id;

    ajaxCall(post, url, shownotification("wait"), loadProvinceSuccess, removenotification);
}

function deleteProvince(id){
    if (confirm("Are you sure you want to delete the object?")){
        var post = "control=city&action=deleteprovince&id="+id;

        //alert(post);

        ajaxCall(post, url, shownotification("Wait.."), deleteProvinceSuccess, removenotification);
    }
    else{
        return false;
    }
}

function deleteCity(id){
    if (confirm("Are you sure you want to delete the object?")){
        var post = "control=city&action=deletecity&id="+id;

        ajaxCall(post, url, shownotification("Wait.."), deleteCitySuccess, removenotification);
    }
    else{
        return false;
    }
}

function editCity(id){
    $("#txt-edit-city-id").val(id);
    var post = "control=city&action=getcity&id="+id;

    ajaxCall(post, url, shownotification("wait"), loadCitySuccess, removenotification);
}

/* Ajax Success Functions */
function editProvinceSuccess(data){
    data = JSON.parse(data);
    if (data == 'null' || data == null){
        alert("No Permission");
        return false;
    }
    else if (data != 'false' && data != false){

        var post = "control=city&action=getlist";

        ajaxCall(post, url, shownotification("Wait"), showProvincesSuccess, removenotification);
        $('#edit-province-section').fadeOut();
    }
    else {
        alert("Error please try again.");
    }
    return false;
}

function addProvinceSuccess(data){
    //alert(data);
    data = JSON.parse(data);
    if (data == 'null' || data == null){
        alert("No Permission");
        return false;
    }
    else if (data != 'false' && data != false){
        $('#txt-add-province-title').val('');

        var post = "control=city&action=getlist";

        ajaxCall(post, url, shownotification("Wait"), showProvincesSuccess, removenotification);
    }
    else {
        alert("Error please try again.");
    }
    return false;
}

function loadProvinceSuccess(data){
    //alert(data);
    data = JSON.parse(data);

    if (data == 'null' || data == null){
        alert("No Permission");
        return false;
    }
    else if (data != 'false' && data != false){

        $.each(data, function(i,v){
            $("#txt-edit-province-title").val(v['province']);
        });
        $('#edit-province-section').fadeIn();
    }
    else {
        alert("Error please try again.");
    }
    return false;
}

function deleteProvinceSuccess(data){
    data = JSON.parse(data);
    if (data == 'null' || data == null){
        alert("No Permission");
        return false;
    }
    else if (data != 'false' && data != false){

        var post = "control=city&action=getlist";

        ajaxCall(post, url, shownotification("Wait"), showProvincesSuccess, removenotification);
    }
    else {
        alert("Error please try again.");
    }
    return false;
}

function showProvincesSuccess(data){
    console.log(data);
    data = JSON.parse(data);
    $("#tbl-provinces-lst >tbody").html('');

    $.each(data, function(i,v){
        var row = "<tr>";
        row += "<td>"+i+"</td>";
        row += "<td>"+v['province']+"</td>";
        row += "<td><a class='iconTable' href='#' onclick='deleteProvince("+v['id']+");' >"+"<i class='fa fa-trash-o'></i>"+"</a></td>";
        row += "<td><a class='iconTable' href='#' onclick='editProvince("+v['id']+");whitebg();'> "+"<i class='fa fa-edit'></i>"+"</a></td>";
        row += "</tr>";

        $("#tbl-provinces-lst >tbody").append(row);
    });
}

function editCitySuccess(data){
    data = JSON.parse(data);
    if (data == 'null' || data == null){
        alert("No Permission");
        return false;
    }
    else if (data != 'false' && data != false){
        $('#txt-edit-city-title').val('');
        var post = "control=city&action=getcities&id="+$("#select-city-lst").val();

        ajaxCall(post, url, shownotification("Wait"), showCityOnlySuccess, removenotification);

        $("#edit-city-section").fadeOut();
    }
    else {
        alert("Error please try again.");
    }
    return false;
}

function addCitySuccess(data){
    data = JSON.parse(data);
    if (data == 'null' || data == null){
        alert("No Permission");
        return false;
    }
    else if (data != 'false' && data != false){
        $('#txt-add-city-title').val()
        var post = "control=city&action=getcities&id="+$("#select-city-lst").val();
        ajaxCall(post, url, shownotification("Wait"), showCityOnlySuccess, removenotification);
    }
    else {
        alert("Error please try again.");
    }
    return false;
}

function loadCitySuccess(data){
    //alert(data);

    $('#edit-city-section').fadeIn();
    data = JSON.parse(data);

    if (data == 'null' || data == null){
        alert("No Permission");
        return false;
    }
    else if (data != 'false' && data != false){
        $.each(data, function(i,v){
            $("#txt-edit-city-title").val(v['city']);
        });
        $("#edit-city-section").fadeIn();
    }
    else {
        alert("Error please try again.");
    }
    return false;

}

function deleteCitySuccess(data){
    data = JSON.parse(data);
    if (data == 'null' || data == null){
        alert("No Permission");
        return false;
    }
    else if (data != 'false' && data != false){

        var post = "control=city&action=getcities&id="+$("#select-city-lst").val();

        ajaxCall(post, url, shownotification("Wait"), showCityOnlySuccess, removenotification);
    }
    else {
        alert("Error please try again.");
    }
    return false;
}

function showCityOnlySuccess(data){
    data = JSON.parse(data);

    $("#tbl-city-lst >tbody").html('');
    $.each(data, function(i,v){
        //alert();
        var row = "<tr>";
        row += "<td>"+i+"</td>";
        row += "<td>"+v['city']+"</td>";
        row += "<td><a class='iconTable' href='#' onclick='deleteCity("+v['id']+");' >"+"<i class='fa fa-trash-o'></i>"+"</a></td>";
        row += "<td><a class='iconTable' href='#' onclick='editCity("+v['id']+");whitebg();'> "+"<i class='fa fa-edit'></i>"+"</a></td>";
        row += "</tr>";

        $("#tbl-city-lst >tbody").append(row);
    });
}

function showCitySuccess(data){
    //alert(data);
    data = JSON.parse(data);
    var prov = data['province'];
    var cities = data['cities'];

    $("#select-city-lst").html('');
    $.each(prov, function(i,v){
        var option = "<option value='"+v['id']+"'>"+v['province']+"</option>";

        $("#select-city-lst").append(option);
    });

    $("#tbl-city-lst >tbody").html('');
    $.each(cities, function(i,v){
        //alert();
        var row = "<tr>";
        row += "<td>"+v['id']+"</td>";
        row += "<td>"+v['city']+"</td>";
        row += "<td><a class='iconTable' href='#' onclick='deleteCity("+v['id']+");' >"+"<i class='fa fa-trash-o'></i>"+"</a></td>";
        row += "<td><a class='iconTable' href='#' onclick='editCity("+v['id']+");whitebg();'> "+"<i class='fa fa-edit'></i>"+"</a></td>";
        row += "</tr>";

        $("#tbl-city-lst >tbody").append(row);
    });
    //toggleBoxes('cities-section', settings_section);

}
