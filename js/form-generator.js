/**
 * Created by sh.hasanzadeh on 7/12/14.
 */

function formGenerator(){
    var fnc = "";
    var all_selects = [];

    this.generateULFormEmpty = function(cols, schema, label, ids){

        var output = "";

        $.each(cols, function(i,v){

            if (label[i] == '0' || label[i] == 0){
                return;
            }

            output += "<div class='col-lg-6'><label>"+label[i]+"</label><div class='form-group'>";

            //var d = (data != null && data[v] != null) ? data[v] : null;
            var id = (ids != null && ids[i] != null && ids[i] != '0') ? ids[i] : null;

            //alert(id);
            output += getType(schema[i], id, null);

            output += "</div></div>";

            fnc = '';
        });

        return output;
    };

    this.generateTableForm = function(cols, schema,label, ids, data){
        var output = "<thead><tr>";

        $.each(cols, function(i,v){
            if (label[i] == '0' || label[i] == 0)
                return;
            output += "<td>"+label[i]+"</td>";
        });
        output += "</tr></thead>";

        output += "<tbody>";
        $.each(data, function(i,v){
            output += "<tr>";
            $.each(cols, function(ii,vv){
                if (label[ii] == '0' || label[ii] == 0)
                    return;
                var d = (v != null && v[vv] != null ) ? v[vv] : null;
                var id = (ids != null && ids[ii] != null && ids[ii] != '0') ? ids[ii]+"-"+i : null;

                output += "<td>"+getType(schema[ii], id, d);
                if (fnc.length > 1){
                    output += data['id'] + ");'>Edit</a>";
                }
                output += "</td>";
            });
            output += "</tr>";
        });
        output += "</tbody>";

        return output;
    };
    this.generateTableDataShow = function(cols,label,data){
        var output = "<thead><tr>";
        output += "<th>#</th>";
        $.each(cols, function(i,v){
            if (label[i] == '0' || label[i] == 0)
                return;
            output += "<th>"+label[i]+"</th>";
        });
        output += "</tr>";
        output += "<tbody><tr>";
        $.each(data, function(i,v){
            output += "<tr>";
            output += "<td>"+i+"</td>";
            $.each(cols, function(ii,vv){
                if (label[ii] == '0' || label[ii] == 0)
                    return;
                var d = (v != null && v[vv] != null ) ? v[vv] : null;
                //var id = (ids != null && ids[ii] != null && ids[ii] != '0') ? ids[ii]+"-"+i : null;

                output += "<td>"+ d;
                if (fnc.length > 1){
                    //output += data['id'] + ");'>Edit</a>";
                }
                output += "</td>";
            });
        });
        output += "</tr></tbody>";

        return output;
    };
    this.generateTableData = function(cols, schema,label, ids, control ,data){
        var did = "";
        var output = "<thead><tr>";
        output += "<th>#</th>";
        $.each(cols, function(i,v){
            if (label[i] == '0' || label[i] == 0)
                return;
            output += "<th>"+label[i]+"</th>";
        });
        output += "<th>Actions</th>";
        output += "</tr></thead>";
        output += "<tbody>";
        $.each(data, function(i,v){
            output += "<tr>";
            output += "<td>"+i+"</td>";
            $.each(cols, function(ii,vv){
                if (label[ii] == '0' || label[ii] == 0)
                    return;
                var d = (v != null && v[vv] != null ) ? v[vv] : null;
                var id = (ids != null && ids[ii] != null && ids[ii] != '0') ? ids[ii]+"-"+i : null;

                output += "<td>"+ d;
                if (fnc.length > 1){
                    //output += data['id'] + ");'>Edit</a>";
                }
                output += "</td>";
            });
            did = v['id'];
            output += '<span class="button-group"><td><a class="button icon edit" onclick="editItem('+did+',\''+control+'\')">ویرایش</a>';
            output += '<a class="button icon remove danger" onclick="deleteItem('+did+',\''+control+'\')">حذف</a>';
            if(control == 'topic'){
                output += '<a class="button icon remove mail" onclick="sendTopic('+did+',\''+control+'\')">ارسال</a>';
            }
            output += "</td></span></tr>";
        });
        output += "</tbody>";

        return output;
    };

    this.generateULFrom = function(cols, schema, label, ids, data, selects){
        //alert(data);
        all_selects = selects || [];
        var output = "";

        $.each(cols, function(i,v){
            if (label[i] == '0' || label[i] == 0 || label[i] == 'id'){
                return;
            }

            output += "<div class='col-lg-6'><label>"+label[i]+"</label><div class='form-group'>";

            var d = (data != null && data[v] != null) ? data[v] : null;
            var id = (ids != null && ids[i] != null && ids[i] != '0') ? ids[i] : null;

            //alert(id);
            output += getType(schema[i], id, d);
            if (fnc.length > 1){
                output += data['id'] + ");' class='input-group-addon custom-addon'><i class='fa fa-edit'></i></a></div>";
            }
            output += "</div></div>";

            fnc = '';
            //alert(this.fnc);
        });

        return output;
    };

    function generateSelectUL (id, all, selected, value_col, onchange){
        var output = "";
        onchange = onchange || '';
        value_col = value_col || '';
        output += "<select class='form-control select' name='select"+RandomNumber()+"' id='"+id+"' ";
        if(onchange != null && onchange != ''){
            output += "  disabled >";
        }
        else {
            output += ">";
        }

        $.each(all, function(i, item){
            output += "<option value='"+item['id']+"' ";

            if (item['id'] == selected)
                output += "selected";

            output += " >";

            output += item[value_col] +"</option>";
        });


        output += "</select>";
        if(onchange != null && onchange != ''){
            output += "<span onclick='return "+onchange+"();' class='input-group-addon btn-info-latlon'><i class='fa fa-edit'></i></span>";
            //output += "<a href='#' onclick='return "+onchange+"();'> Change </a> ";
        }
        return output;
    }

    function getType(type, id, data){
        //alert(type);
        fnc = "";
        var output = "<input type =";

        if(type == 'txt' || type == 'text'){
            output += "'text' class='form-control digit' name='number"+RandomNumber()+"' ";
        }
        else if (type.indexOf("txt|") >= 0){
            type = type.split("|");

            output += "'text' class='form-control digit' name='number"+RandomNumber()+"' ";
            fnc = type[1];
        }
        else if(type == 'num'){
            output += "'text' class='form-control digit' name='number"+RandomNumber()+"' ";
        }
        else if (type.indexOf("num|") >= 0){
            type = type.split("|");

            output += "'text' class='form-control digit' name='number"+RandomNumber()+"' ";
            fnc = type[1];
        }
        else if (type == 'chbx' || type.indexOf('chbx|') >= 0){
            output += "'checkbox'"

            if (type.indexOf('chbx|') > 0){
                var attr = type.split('|');
                output += " "+attr;
            }
            else{
                if (data == 1 || data == '1'){
                    output += " checked ";
                }
            }
        }
        else if (type.indexOf('select|') >= 0){
            var attr = type.split('|');

            output = generateSelectUL(attr[4], all_selects[attr[1]], attr[5], attr[2], attr[3]);
        }
        else{
            output += "'text' class='form-control digit'  name='number"+RandomNumber()+"'";
        }

        if (data != null && data != 'null' && type.indexOf('select|') < 0){
            output += " value='"+data+"'";
        }

        if (id != null && type.indexOf('select|') < 0){
            output += " id='"+id+"' ";
        }

        if (type.indexOf('select|') < 0)
            output += (fnc == '') ? ">" : "><a href='#' onclick='return "+fnc+"(";
        return output;
    };
}