/**
 * Created by sh.hasanzadeh on 8/23/14.s
 */
var FormGenerator = (function () {
    function FormGenerator(schema, labels, ids) {
        this.schema = schema;
        this.labels = labels;
        this.ids = ids;
    }
    Object.defineProperty(FormGenerator.prototype, "checkboxData", {
        /* Get Set Members*/
        set: function (data) {
            this.chbx_data = data;
        },
        enumerable: true,
        configurable: true
    });

    Object.defineProperty(FormGenerator.prototype, "selectData", {
        set: function (data) {
            this.select_data = data;
        },
        enumerable: true,
        configurable: true
    });

    Object.defineProperty(FormGenerator.prototype, "formdata", {
        set: function (data) {
            this.data = data;
        },
        enumerable: true,
        configurable: true
    });

    Object.defineProperty(FormGenerator.prototype, "columns", {
        set: function (data) {
            this.cols = data;
        },
        enumerable: true,
        configurable: true
    });

    Object.defineProperty(FormGenerator.prototype, "checked", {
        set: function (data) {
            this.checked_data = data;
        },
        enumerable: true,
        configurable: true
    });

    FormGenerator.prototype.createEmptyFormList = function (data, cols) {
        var _this = this;
        if (data) {
            this.data = data;
        }
        if (cols) {
            this.cols = cols;
        }

        //console.log(this.cols);
        //console.log(this.data);
        //console.log(this.schema);
        var output;

        output = "<!--ul-->";
        var count = 0;
        this.schema.forEach(function (item) {
            if (item == '0') {
            } else if (item.substr(0, 3) == 'txt' || item.substr(0, 3) == 'num') {
                //console.log(this.cols[count]);
                //console.log(this.data[this.cols[count]]);
                if (_this.data)
                    output += _this.createTextBoxLI(item, _this.ids[count], _this.labels[count], _this.data[_this.cols[count]]);
                else
                    output += _this.createTextBoxLI(item, _this.ids[count], _this.labels[count]);
            } else if (item.substr(0, 6) == 'select') {
                if (_this.data)
                    output += _this.createSelectLI(item, _this.ids[count], _this.labels[count], _this.data[_this.cols[count]]);
                else
                    output += _this.createSelectLI(item, _this.ids[count], _this.labels[count]);
            } else if (item.substr(0, 4) == 'chbx') {
                if (_this.checked_data)
                    output += _this.createCheckBoxLI(item, _this.ids[count], _this.labels[count], _this.cols[count]);
                else
                    output += _this.createCheckBoxLI(item, _this.ids[count], _this.labels[count]);
            } else if (item.substr(0, 8) == "textarea") {
                if (_this.data) {
                    output += _this.createTextAreaLI(item, _this.ids[count], _this.labels[count], _this.data[_this.cols[count]]);
                } else {
                    output += _this.createTextAreaLI(item, _this.ids[count], _this.labels[count]);
                }
            } else if (item.substr(0, 4) == "date") {
                if (_this.data) {
                    output += _this.createDatePicker(item, _this.ids[count], _this.labels[count]);
                } else {
                    output += _this.createDatePicker(item, _this.ids[count], _this.labels[count]);
                }
            }

            count++;
        });

        output += "<!--/ul-->";
        return output;
    };

    FormGenerator.prototype.createFormList = function () {
        return "";
    };

    FormGenerator.prototype.createTable = function () {
        var _this = this;
        var output;

        output = "<thead>";
        this.labels.forEach(function (item) {
            if (item != '0') {
                output += "<th>" + item + "</th>";
            }
        });
        output += "</thead>";
        output += "<tbody>";
        var element;
        var modal;
        for (var i = 0; i < this.data.length; i++) {
            output += "<tr>";
            this.schema.forEach(function (item, index) {
                if (item != '0' && item.substr(0, 4) != 'link') {
                    output += "<td>" + _this.data[i][_this.cols[index]] + "</td>";
                } else if (item.substr(0, 4) == 'link') {
                    var attr = item.split('|');
                    if(attr[1] == 'Delete'){
                        element = '<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>';
                        modal = '';
                    }
                    else if(attr[1] == 'Details'){
                        element = '<button class="btn btn-default btn-xs"><i class="fa fa-exclamation-circle"></i></button>';
                        modal = 'href="index.htm#myModal-2" data-toggle="modal"';
                    }
                    else if(attr[1]  == 'Download') {
                        element = '<button class="btn btn-info btn-xs"><i class="fa fa-cloud-download"></i></button>';
                        modal = '';
                    }
                    else if(attr[1] == 'Email'){
                        element = '<button class="btn btn-success btn-xs"><i class="fa fa-envelope-o"></i></button>';
                        modal = 'href="index.htm#myModal-1" data-toggle="modal"';
                    }
                    else if(attr[1] == 'Edit'){
                        element = '<button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button>';
                        modal = '';
                    }
                    else{
                        element = attr[1];
                        modal = '';
                    }
                    output += "<td><a "+modal+" onclick='return " + attr[2] + "(" + _this.data[i]['id'] + "); ' >" + element + "</a></td>";
                }
            });
            output += "</tr>";
        }
        output += "</tbody>";
        return output;
    };

    FormGenerator.prototype.createDatePicker = function (date_schema, date_id, date_label, data) {
        //alert(date_label);
        var input = "";
        var attr = date_schema.split("|");

        input += "<div class='col-lg-3'><label>"+ date_label +"</label><div class='form-group'>";
        input += "<input class='form-control' type='text' id='" + date_id + "' ";
        if (data)
            input += "value='" + data + "' ";
        input += "></div></div>";
        input += "<script>$(function(){ $(\"#" + date_id + "\").datepicker({dateFormat:'yy/mm/dd'}).datepicker('setDate',new Date());});</script>";

        return input;
    };

    FormGenerator.prototype.createTextAreaLI = function (txt_schema, txt_id, txt_label, data) {
        var input = "";
        var attr = txt_schema.split('|');
        input += "<div class='col-lg-6'><div class='form-group textareaHeight'><label>" + txt_label + "</label>";
        input += "<textarea class='form-control' id='" + txt_id + "' rows='" + attr[1] + "' cols='" + attr[2] + "' >";
        if (data)
            input += data;
        input += "</textarea>";
        input += "</div></div>";

        return input;
    };

    FormGenerator.prototype.createTextBoxLI = function (txt_schema, txt_id, txt_label, data) {
        var input = "";
        var type;
        var attr;
        var isMultiLine;
        isMultiLine = 0;

        input += "<div class='col-lg-3'><label>"+ txt_label +"</label><div class='form-group'>";
        if (txt_schema.substr(0, 3) == 'txt') {
            type = "text";
        } else if (txt_schema.substr(0, 3) == 'num') {
            type = 'number';
        }

        //alert(txt_schema);
        input += "<input class='form-control' type='" + type + "' ";

        input += " id='" + txt_id + "' ";
        input += (data) ? "value='" + data + "'" : "";
        input += "></div></div>";
        return input;
    };

    FormGenerator.prototype.createSelectLI = function (select_schema, select_id, select_label, data) {
        var input = "<div class='col-lg-3'><label>"+ select_label +"</label><div class='form-group'>";

        var attr = select_schema.split('|');

        input += "<select class='form-control' id='" + select_id + "' >";
        this.select_data[attr[1]].forEach(function (item) {
            input += "<option value='" + item['id'] + "'";
            if (data && data == item['id']) {
                input += " selected ";
            }
            input += ">";

            var text = attr[2].split(',');

            //alert(text);
            text.forEach(function (col) {
                input += item[col] + " ";
            });
            "</option>";
        });
        input += "</select></div></div>";

        return input;
    };

    FormGenerator.prototype.createCheckBoxLI = function (chbx_schema, chbx_id, chbx_label, column) {
        var _this = this;
        var input = "";
        if (chbx_schema.length > 4 && chbx_schema.substr(0, 5) == 'chbx|') {
            input += "<div class='col-lg-3 marginbtm'><div class='btn-group'><button data-toggle='dropdown' class='btn btn-white fontsmall' type='button'>" + chbx_label + "<button data-toggle='dropdown' class='btn btn-white dropdown-toggle fontsmall' type='button'><span class='caret'></span></button></button><ul role='menu' class='dropdown-menu'>";
            var attr;
            attr = chbx_schema.split("|");

            if (this.chbx_data[attr[1]]) {
                var count;
                count = 0;
                this.chbx_data[attr[1]].forEach(function (item, index) {
                    input += "<li><a href='#'><label><input type='checkbox' value='" + item['id'] + "' ";
                    if (column) {
                        var col;
                        col = column.split('|');
                        if (_this.checked_data[col[0]]) {
                            _this.checked_data[col[0]].forEach(function (chbx) {
                                //console.log(chbx['ct_id'] + " - " + item['id']);
                                if (chbx[col[1]] == item['id'])
                                    input += "checked ";
                            });
                        }
                    }
                    input += " class='" + chbx_id + "' id='" + chbx_id + index + "'>" + item[attr[2]] + "</label></a>";
                });
                count++;
            }

            input += "</li></ul></div></div>";
        } else if (chbx_schema.length == 4) {
            input += "<label><input type='checkbox' id='" + chbx_id + "'>" + chbx_label + "</label>";
        }

        return input;
    };

    FormGenerator.prototype.createElement = function (type) {
    };
    return FormGenerator;
})();
//# sourceMappingURL=formgenerator.js.map
