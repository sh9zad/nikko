var url = "index.php";
var change_boxes = ["box-show-home","box-show-category-list" , "box-show-topic-list","box-show-sent-topics"];
var change_event = ["show-box-add-topic" , "show-box-search-topic"];
$("#btn-show-home").on('click', function(){
    shownotification();
    toggleBoxes('box-show-home',change_boxes);
    removenotification();
});
$("#btn-show-cat-list").on('click', function(){
    var post = "control=cat&action=getcategories";
    ajaxCall(post, url, shownotification(''), showCategoriesSuccess, removenotification);
});
$("#btn-add-categories").on('click', function(){
    var post = "control=cat&action=addcategories&catname="+$('#txt-add-catname').val()+"&mokeyword="+$('#txt-add-mokeyword').val();
    ajaxCall(post, url, shownotification(''), AddCategoriesSuccess, removenotification);
});
$("#btn-show-topic-list").on('click', function(){
    var post = "control=topic&action=gettopic";
    ajaxCall(post, url, shownotification(''), showTopicSuccess, removenotification);
});
$("#btn-add-topic").on('click', function(){
    var post = "control=topic&action=addtopic&desc="+$('#txt-description-topic').val()+"&cat_id="+$('#lst-categories').val();
    ajaxCall(post, url, shownotification(''), addTopicSuccess, removenotification);
});
$("#btn-show-topic-sent-list").on('click', function(){
    var post = "control=topic&action=getsenttopics";
    ajaxCall(post, url, shownotification(''), ShowSentTopicSuccess, removenotification);
});
$('#lst-categories').change(function(){
    var post = "control=topic&action=gettopicbycat&cid="+$('#lst-categories').val();
    ajaxCall(post, url, shownotification(''), showTopicSuccess2, removenotification);
});
$("#btn-show-box-add-topic").on('click', function(){
    toggleBoxes("show-box-add-topic" , change_event);
});
$("#btn-show-box-search-topic").on('click', function(){
    toggleBoxes("show-box-search-topic" , change_event);
});
$('#btn-search-topic').on('click' , function(){
    var post = "control=topic&action=searchtopic&startS="+$('#txt-subject-start').val()+"&finishS="+$('#txt-subject-finish').val()+"&startD="+$('#txt-date-start').val()+"&finishD="+$('#txt-date-finish').val();
    ajaxCall(post, url, shownotification(''), showTopicSuccess2, removenotification);
});

function ShowSearchTopicSuccess(data){
    console.log(data);

}
function showTopicSuccess2(data){
    console.log(data);
    $('#box-show-topic-list table').html('');
    data = JSON.parse(data);
    var table = [];
    table = data['table'];
    var myFormGenerator = new formGenerator();
    var search = myFormGenerator.generateTableData(table['cols'], table['schema'],table['labels'], table['ids'], table['control'],data['data']);
    $('#box-show-topic-list table').append(search);
    toggleBoxes('box-show-topic-list',change_boxes);
}
function addTopicSuccess(data){
    //console.log(data);
}
function showTopicSuccess(data){
    $('#box-show-topic-list table').html('');
    $('#lst-categories').html('');
    //console.log(data);
    data = JSON.parse(data);
    var table = [];
    var cat = [];
    table = data['table'];
    var myFormGenerator = new formGenerator();
    var search = myFormGenerator.generateTableData(table['cols'], table['schema'],table['labels'], table['ids'], table['control'],data['topic']);
    $.each(data['category'], function(i,v){
        $('#lst-categories').append('<option value='+v['id']+'>'+ v['category_name'] + '</option>');
    });
    $('#box-show-topic-list table').append(search);
    toggleBoxes('box-show-topic-list',change_boxes);
}
function AddCategoriesSuccess(data){

}
function showCategoriesSuccess(data){
    $('#box-show-category-list table').html('');
    //console.log(data);
    data = JSON.parse(data);
    var table = [];
    var cat = [];
    table = data['table'];
    var myFormGenerator = new formGenerator();
    var search = myFormGenerator.generateTableData(table['cols'], table['schema'],table['labels'], table['ids'], table['control'] ,data['data']);
    //console.log(search);
    //$('#box-show-category-list table').append(search);
    $('#box-show-category-list table').append(search);
    toggleBoxes('box-show-category-list',change_boxes);
}

function deleteItem(id,control){
    var action = 'delete'+control;
    if (confirm("Are you sure?")){
        var post = "control="+control+"&action="+action+"&id="+id;
        ajaxCall(post, url, shownotification(''), deleteItemSuccess, removenotification);
    }
    else{
        return false;
    }
}
function editItem(id,control){
    var action = edit+control;
    if (confirm("Are you sure?")){
        var post = "control="+control+"&action="+action+"&id="+id;
        ajaxCall(post, url, shownotification(''), deleteItemSuccess, removenotification);
    }
    else{
        return false;
    }
}

function deleteItemSuccess(data){

}

function ShowSentTopicSuccess(data){
    $('#box-show-sent-topics table').html('');
    //console.log(data);
    data = JSON.parse(data);
    var table = [];
    var cat = [];
    table = data['table'];
    var myFormGenerator = new formGenerator();
    var search = myFormGenerator.generateTableDataShow(table['cols'],table['labels'],data['data']);
    //console.log(search);
    //$('#box-show-category-list table').append(search);
    $('#box-show-sent-topics table').append(search);
    toggleBoxes('box-show-sent-topics',change_boxes);
}
function sendTopic(id,control){
    var post = "control=topic&action=senttopic&tid="+id;
    //alert(post);
    ajaxCall(post, url, shownotification(''), showSentTopicSuccess, removenotification);
}
function showSentTopicSuccess(data){
    if(data != 'false'){
        alert('تاپیک مورد نظر با موفقیت ارسال شد.')
    }
    console.log(data)
}