/**
 * Created by sh.hasanzadeh on 8/23/14.
 */

class FormGenerator {
    private schema : string [];
    private labels : string [];
    private ids : string [];
    private cols : string[];

    private data : any[];
    private chbx_data : any[];
    private select_data : any[];
    private checked_data : any[];

    constructor(schema : string[], labels : string[], ids : string[]){
        this.schema = schema;
        this.labels = labels;
        this.ids = ids;
    }

    /* Get Set Members*/
    set checkboxData(data : any[]){ this.chbx_data = data }

    set selectData(data : any[]) { this.select_data = data }

    set formdata(data : any[]) { this.data = data }

    set columns(data : string[]) { this.cols = data }

    set checked(data : any[]) { this.checked_data = data }

    createEmptyFormList(data? : any[], cols? : any[]):string{
        alert(data);
       if (data) {this.data = data; }
       if (cols) {this.cols = cols; }
       //console.log(this.cols);
       //console.log(this.data);
//console.log(this.schema);
       var output : string;

        output = "<ul>";
        var count = 0;
        this.schema.forEach((item) => {
            if(item == '0' ){

            }
            else if (item.substr(0, 3) == 'txt' || item.substr(0, 3) == 'num'){
                //console.log(this.cols[count]);
                //console.log(this.data[this.cols[count]]);
                if (this.data)
                    output += this.createTextBoxLI(item, this.ids[count], this.labels[count], this.data[this.cols[count]]);
                else
                    output += this.createTextBoxLI(item, this.ids[count], this.labels[count]);
            }
            else if (item.substr(0, 6) == 'select'){
                if (this.data)
                    output += this.createSelectLI(item, this.ids[count], this.labels[count], this.data[this.cols[count]]);
                else
                    output += this.createSelectLI(item, this.ids[count], this.labels[count]);
            }
            else if (item.substr(0, 4) == 'chbx'){
                if (this.checked_data)
                    output += this.createCheckBoxLI(item, this.ids[count], this.labels[count], this.cols[count]);
                else
                    output += this.createCheckBoxLI(item, this.ids[count], this.labels[count]);
            }
            else if (item.substr(0, 8) == "textarea"){
                if (this.data) {
                    output += this.createTextAreaLI(item, this.ids[count], this.labels[count], this.data[this.cols[count]]);
                }
                else {
                    output += this.createTextAreaLI(item, this.ids[count], this.labels[count]);
                }
            }
            else if (item.substr(0, 4) == "date"){
                if (this.data) {
                    output += this.createDatePicker(item, this.ids[count], this.labels[count]);
                }
                else{
                    output += this.createDatePicker(item, this.ids[count], this.labels[count]);
                }
            }
            else if (item.substr(0, 3) == "img"){
                if (this.data){
                    output += this.createImageLI(item, this.ids[count], this.labels[count], this.data[this.cols[count]]);
                }
                else{
                    output += this.createImageLI(item, this.ids[count], this.labels[count]);
                }
            }


            count++;
        });

        output += "</ul>";
        return output;
    }

    createFormList() : string {

        return "";
    }

    createTable():string{
        var output : string;


        output = "<thead>";
        this.labels.forEach((item) => {
            if(item != '0'){
                output += "<th>"+item+"</th>"
            }
        });
        output += "</thead>";
        output += "<tbody>";
        for(var i = 0; i < this.data.length; i++){
            output += "<tr>";
            this.schema.forEach((item, index) => {
                if (item != '0' && item.substr(0, 4) != 'link'){
                    output += "<td>"+this.data[i][this.cols[index]]+"</td>";
                }
                else if(item.substr(0, 4) == 'link'){
                    var attr = item.split('|');

                    output += "<td><a href='#' onclick='return "+attr[2]+"("+this.data[i]['id']+"); ' >"+attr[1]+"</a></td>";
                }
            });
            output += "</tr>";
        }
        output += "</tbody>";
        return output;
    }

    private createDatePicker(date_schema : string, date_id : string, date_label : string, data? : string) : string{
        //alert(date_label);
        var input = "";
        var attr = date_schema.split("|");

        input += "<li>"+date_label+"</li>";
        input += "<li><input type='text' id='"+date_id+"' ";
        if(data)
            input += "value='"+data+"' ";
        input += "></li>";
        input += "<script>$(function(){ $(\"#"+date_id+"\").datepicker({dateFormat:'yy/mm/dd'}).datepicker('setDate',new Date());});</script>"

        return input;
    }

    private createTextAreaLI(txt_schema : string, txt_id : string, txt_label : string, data? : string) : string {
        var input = "";
        var attr = txt_schema.split('|');
        input += "<li>"+txt_label+"</li>";
        input += "<li><textarea id='"+txt_id+"' rows='"+attr[1]+"' cols='"+attr[2]+"' >";
        if (data)
            input += data;
        input += "</textarea>";
        input += "</li>";

        return input;
    }

    private createTextBoxLI(txt_schema : string, txt_id : string, txt_label : string, data? : string) : string {
        var input = "";
        var type : string;
        var attr : string[];
        var isMultiLine : number;
        isMultiLine = 0;

        input += "<li>"+txt_label+"</li>";
        if(txt_schema.substr(0,3) == 'txt'){
            type = "text";
        }
        else if (txt_schema.substr(0,3) == 'num'){
            type = 'number';
        }

        //alert(txt_schema);
        input += "<li><input type='"+type+"' ";

        input += " id='"+txt_id+"' ";
        input += (data) ? "value='"+data+"'" : "";
        input += "></li>";
        return input;
    }

    private createSelectLI(select_schema : string, select_id : string, select_label : string, data? : any) : string {

        var input = "<li>"+select_label+"</li>";

        var attr = select_schema.split('|');

        input += "<ul><li><select id='"+select_id+"' >";
        this.select_data[attr[1]].forEach((item) => {
            input += "<option value='"+item['id']+"'";
            if (data && data == item['id']) {
                input += " selected ";
            }
            input += ">";

            var text = attr[2].split(',');
            //alert(text);
            text.forEach((col) => {
                input += item[col] + " ";
            });
            "</option>";
        });
        input += "</select></li></ul>";

        return input;
    }

    private createCheckBoxLI(chbx_schema : string, chbx_id : string, chbx_label :string, column? : string) : string{
        var input = "";
        if(chbx_schema.length > 4 && chbx_schema.substr(0, 5) == 'chbx|'){
            input += "<li>"+chbx_label+"</li><ul>";
            var attr : string[];
            attr = chbx_schema.split("|");

            if(this.chbx_data[attr[1]]){
                var count : number;
                count = 0;
                this.chbx_data[attr[1]].forEach((item, index) => {
                    input += "<li><input type='checkbox' value='"+item['id']+"' ";
                    if(column){
                        var col : any[];
                        col = column.split('|');
                        if(this.checked_data[col[0]]){
                            this.checked_data[col[0]].forEach((chbx)=>{
                                //console.log(chbx['ct_id'] + " - " + item['id']);
                                if(chbx[col[1]] == item['id'])
                                    input += "checked ";
                            });
                        }
                    }
                    input += " class='"+chbx_id+"' id='"+chbx_id+index+"'>"+item[attr[2]]+"</li>";
                });
                count++;
            }

            input += "</ul>"
        }
        else if (chbx_schema.length == 4){
            input += "<li><input type='checkbox' id='"+chbx_id+"'>"+chbx_label+"</li>"
        }

        return input;
    }

    private createImageLI(img_schema : string, img_id : string, img_label : string, data? : any) : string {
        var input = "<li>"+img_label+"</li>";
        input += "<li><img id="+img_id+" src="+data+" class='profile_image'></li>";
        return input
    }

    private createElement(type:string){

    }
}