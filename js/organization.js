/**
 * Created by sh.hasanzadeh on 9/24/2014.
 */
var url = "index.php";
var treeItems = {};
var items = [];
var table_info = [];
var orgDiagram = null;
var selectedItem = null;
var selectedItemParent = null;

$(window).load(function () {
    var post = "control=organization&action=getlist";

    ajaxCall(post, url, shownotification('wait'), showChartSuccess, removenotification());
});

/* Menu Items */
$("#view-tree").on('click', function(){
    alert('hi');
});

$("#view-add-division").on('click', function(){
    var post = "control=organization&action=getlist&for=form";

    ajaxCall(post, url, shownotification('wait'), showAddDivisionFormSuccess, removenotification());
});

/* Button Clicks */
$("#close-operations").on("click", function(){
    $("#operations-section").fadeOut();
});
$("#add-child-here").on("click", function(){
    if (selectedItem != null){
        var post = "control=organization&action=getlist&for=tree";
        post += (selectedItemParent != null) ? "&tree="+selectedItemParent.id : "";

        //alert(post);
        ajaxCall(post, url, shownotification('wait'), showListSuccess, removenotification());

    }
    else {
        alert('No item is selected.');
    }
});
$("#delete-division").on("click", function(){
    if (selectedItem != null){
        if(confirm("Are you sure? All sub-divisions will be deleted too.")) {
            var post = "control=organization&action=deletedivision&id=" + selectedItem.id;

            //alert(post);
            ajaxCall(post, url, shownotification('wait'), showListSuccess, removenotification());
        }
    }
    else {
        alert('No item is selected.');
    }
});

/* operational Functions */
function onTemplateRender(event, data) {
    var element = data.element.find("[name=selectiontext]");
    if (element.text() != data.context["title"]) {
        element.text(data.context["title"]);
    }

    var checkBox = data.element.find("[name=checkbox]");
    checkBox.prop("checked", data.isSelected);
}

function getContactTemplate() {
    var result = new primitives.orgdiagram.TemplateConfig();
    result.name = "contactTemplate";

    result.itemSize = new primitives.common.Size(160, 30);
    result.minimizedItemSize = new primitives.common.Size(3, 3);
    result.highlightPadding = new primitives.common.Thickness(2, 2, 2, 2);


    var itemTemplate = jQuery(
        '<div class="bp-item bp-nopadding bp-corner-all bt-item-frame">'
        + '<div style="left: 4px; top: 4px; width: 152px; height: 20px;" class="bp-item bp-selectioncheckbox-frame"><label><nobr><input class="bp-selectioncheckbox" name="checkbox" value="on" type="checkbox">&nbsp;<span name="selectiontext" class="bp-selectiontext">Selected</span></nobr></label></div>'
        + '</div>'
    ).css({
            width: result.itemSize.width + "px",
            height: result.itemSize.height + "px"
        });
    result.itemTemplate = itemTemplate.wrap('<div>').parent().html();

    return result;
}

function addDivision(){
    var post = "control=organization&action=adddivision&name="+ $("#txt-division-name").val()+"&head="+$("#txt-division-head").val();
    if ($('#txt-division-parent').length){
        post += "&parent="+$("#txt-division-parent").val();
    }
    else if (selectedItem != null){

        post += "&parent="+selectedItem.id;
    }

    //alert(post);
    ajaxCall(post, url, shownotification('wait'), addDivisionSuccess, removenotification());
}

function addDivisionForm(){
    //alert(JSON.stringify(table_info));
    var data = {};
    $.each(table_info['ids'], function(i, id){
        //alert(table_info['schema'][i]);
        if (table_info['schema'][i] != 0){
            data[id] = $('#'+id).val();
        }
    });
    var post = "control=organization&action=adddivision&from=form&data="+JSON.stringify(data);
    //alert(post);

    ajaxCall(post, url, shownotification('wait'), addDivisionSuccess, removenotification());
}

function LoadItems(selector) {
    var index, len;
    for (index = 0, len = items.length; index < len; index += 1) {
        treeItems[items[index].id] = items[index];
    }

    selector.orgDiagram("option", {
        items: items,
        cursorItem: 0
    });
    selector.orgDiagram("update");
}

function onSelectionChanged(e, data) {
    //alert("hi");

    var selectedItems = jQuery("#basicdiagram").orgDiagram("option", "selectedItems");
    if(selectedItems.length == 1) {
        $("#operations-section").fadeIn();
        selectedItem = treeItems[selectedItems[0]];
        if (data.parentItem != null)
            selectedItemParent = data.parentItem;
        else
            selectedItemParent = null;
    }
    else {
        $("#operations-section").fadeOut();
        selectedItem = null;
        selectedItemParent = null;
    }
    //alert(selectedItem.id);
   /* var message = "";
    for (var index = 0; index < selectedItems.length; index += 1) {
        var itemConfig = treeItems[selectedItems[index]];
        if (message != "") {
            message += ", ";
        }
        message += "<b>'" + itemConfig.id + "'</b>";
        //alert("hi");
    }
    message += (data.parentItem != null ? " Parent item <b>'" + data.parentItem.title + "'" : "");
    jQuery("#southpanel").empty().append("User selected next items: " + message);*/
}

/* AJAX Success Call */
function showAddDivisionFormSuccess(data){
    data = JSON.parse(data);

    table_info = data['table'];
    var myFormGen = new FormGenerator(data['table']['schema'], data['table']['labels'], data['table']['ids']);
    myFormGen.selectData = data['select'];

    $("#add-division-sep-section").html(myFormGen.createEmptyFormList());
    $("#add-division-sep-section").append("<input type='submit' value='Add' onclick='return addDivisionForm();' id='btn-add-division'>");
    //$("#add-division").fadeIn();
}

function showChartSuccess(data){
    data = JSON.parse(data);
    items = [];

    //alert(data['select']['divisions']);

    var options = new primitives.orgdiagram.Config();



    $.each(data['select']['divisions'], function(i, division){
        items.push( new primitives.orgdiagram.ItemConfig({
            id: division['id'],
            parent: division['parent_division'],
            title: division['name'],
            description: null,
            image: null
        }));
    });

    var templates = [getContactTemplate()];

    options.items = items;
    options.cursorItem = 0;
    options.onSelectionChanged = onSelectionChanged,
    //options.hasSelectorCheckbox = primitives.common.Enabled.True;
    options.minimalVisibility = 2;
    options.templates = templates;
    options.onItemRender = onTemplateRender;
    options.defaultTemplateName = "contactTemplate";

    if (selectedItem != null){
        jQuery("#basicdiagram").orgDiagram("update");
        selectedItem = null;

        close_section('add-division-form');
        close_section('add-division');
        close_section('operations-section');
        selectedItemParent = null;
    }
    else {
        jQuery("#basicdiagram").orgDiagram(options);
    }

    LoadItems(jQuery("#basicdiagram"));
}

function addDivisionSuccess(data){
    data = JSON.parse(data);

    if (data != false){
        alert(data);
        var post = "control=organization&action=getlist";

        ajaxCall(post, url, shownotification('wait'), showChartSuccess, removenotification());
    }
}

function showListSuccess(data){

    data = JSON.parse(data);

    var myFormGen = new FormGenerator(data['table']['schema'], data['table']['labels'], data['table']['ids']);
    myFormGen.selectData = data['select'];

    alert(myFormGen.createEmptyFormList());
    $("#add-division-form").html(myFormGen.createEmptyFormList());
    $("#add-division-form").append("<input type='submit' value='Add' onclick='return addDivision();' id='btn-add-division'>");
    $("#add-division").fadeIn();
}