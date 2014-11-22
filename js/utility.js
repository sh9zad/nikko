/******** Show/Hide Report Boxes ********/
$(document).ready(function(){

    $(".selectAll").click(function(){
        var element = $(this).closest('table').find('input:checkbox');
        $(element).prop("checked",$(element).prop("checked"))
    })
});

function boxCloseID(boxId){
    //alert(boxId);
    //$("#" + boxId).addClass('hide');
    $("#" + boxId).fadeOut();
}

function boxClose(){
//alert('box');
    //$('.absoluteBox').addClass('hidden');
    $('.absoluteBox').fadeOut();
    $('.fixedBox').fadeOut();
    $('.whitebg').fadeOut();
}
function whitebg(){
    $('.whitebg').fadeIn();
}
function removeItemArray(array,item){
    array.splice( $.inArray(item,array) ,1 );
    return array;
}
function toggleBoxes(box_id, boxes){
//alert(box_id);
	if (boxes.length > 0){
		for(var i=0; i< boxes.length; i++){
			if (box_id == boxes[i])
				$('#'+boxes[i]).fadeIn('slow');
			else
				$('#'+boxes[i]).fadeOut('fast');
		}
	}
    //special for edit sites
    //$('.section-all-edit').fadeIn();
	return false;
}
/***** END Show/Hide Report Boxes *******/
/************ UTILITY FUNCTIONS ****************/
function format(input){
    var nStr = input.value + '';
    nStr = nStr.replace( /\,/g, "");
    var x = nStr.split( '.' );
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while ( rgx.test(x1) ) {
        x1 = x1.replace( rgx, '$1' + ',' + '$2' );
    }
    input.value = x1 + x2;
}
function shownotification(msg){
    $('.whitebg').fadeOut();
    //whitebg();
	$('#msg').append('<p class="rtl">'+msg+'</p>');
	$('#msg').fadeIn();
}
function removenotification(){
    $('#msg').fadeOut();
	$('#msg').html('');
    //$('.whitebg').fadeOut();
}
function close_section(section){
	section = "#"+section;
	$(section).hide('slow');
}
function datedifference(start, finish){
	start = start.split("/");
	if (start.length != 3){ alert("تاریخ شروع اشتباه است"); return false; }

	finish = finish.split("/");
	if (finish.length != 3){ alert("تاریخ پایان اشتباه است"); return false; }

	var tmpstart = start[0];
	var tmpfinish = finish[0];

	if (tmpfinish < tmpstart){ alert("تاریخ پایان قبل از تاریخ شروع است"); return false; }
	if (tmpfinish > tmpstart){ return true; }

	var tmpstart = start[1];
	var tmpfinish = finish[1];
	if (tmpfinish < tmpstart){ alert("تاریخ پایان قبل از تاریخ شروع است"); return false; }
	if (tmpfinish > tmpstart){ return true; }

	var tmpstart = start[2];
	var tmpfinish = finish[2];
	if (tmpfinish < tmpstart){ alert("تاریخ پایان قبل از تاریخ شروع است"); return false; }
	if (tmpfinish > tmpstart){ return true; }
    
    return true;
}
function getAmount(amount){
	var tmpamount = '';
	amount = amount.split(",");
	alert(amount);
	for(i=0; i < amount.lenght; i++){
		tmpamount += amount[i];
	}
	return tmpamount;
}
function getduration(start, finish){
	//alert("hi");
	start = start.split(":");
	if (start.length <= 1){ alert("ساعت شروع اشتباه است"); return null; }

	finish = finish.split(":");
	if (finish.length <= 1){ alert("ساعت پایان اشتباه است"); return null; }

	var st = start[0];
	var fin = finish[0];

	if (start[1]  == "15") { st += '.25';  } else if(start[1]  == "30") { st += '.50';  } else if (start[1]  == "45") { st += '.75';  }
	if (finish[1] == "15") { fin += '.25'; } else if(finish[1] == "30") { fin += '.50'; } else if (finish[1] == "45") { fin += '.75'; }

	var duration = fin - st;


	return duration;
}
/********** AJAX FUNCTION *************/
function ajaxCall(post, url, beforeSend, success, done){
    var control = '?control=main&action=';
	$.ajax({
		type: "POST",
		url: url,
		data: post,
		datatype: 'json',
		beforeSend: beforeSend,
		success: success,
		error: function(jqXHR,error, errorThrown) {


            if((window.location.href.indexOf(control+"siteaudit") > -1) || (window.location.href.indexOf(control+"uploadimage") > -1)) {
                control.log("Ajax Call Failed.");
                return false;
            }

            else if(jqXHR.status&&jqXHR.status==400){
                 alert(jqXHR.responseText);
            }else{
                alert("Something went wrong: "+error+"----"+errorThrown);
            }
		}
	})
        .fail(function(){
            if((window.location.href.indexOf(control+"siteaudit") > -1) || (window.location.href.indexOf(control+"uploadimage") > -1)) {
                control.log("Ajax Call Failed.");
                return false;
            }
            else{
                alert("Ajax Call Failed.");
            }
        })
        .done( done );
}

function donothing(){}

function shortString(str, limit)
{
    if(str.length < 50)
    {
        return str;
    }
    else
    {
        str = str.substring(0,limit) + '<a href="#" class="more-link">Read More...</a>';
        return str;
    }
}

var uniqueRandoms = [];
var numRandoms = 10000;
function RandomNumber() {
    // refill the array if needed
    if (!uniqueRandoms.length) {
        for (var i = 0; i < numRandoms; i++) {
            uniqueRandoms.push(i);
        }
    }
    var index = Math.floor(Math.random() * uniqueRandoms.length);
    var val = uniqueRandoms[index];

    // now remove that value from the array
    uniqueRandoms.splice(index, 1);

    return val;
}