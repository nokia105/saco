var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        ajax : {
        url     : "/savingCreate",
        contentType: "application/json; charset=utf-8", 
        type: "GET" 
    },
 
        table: "#savings",
        fields: [ {
                label: "Saving Date:",
                name: "saving_date",
                type:"datetime"
            }, {
                label: "Member ID:",
                name: "member_id"
            }, {
                label: "Amount:",
                name: "amount"
            },              
            {
                label: "Saving Code:",
                name: "saving_code"
            }
        ]
    } );
 

    $('#savings').DataTable( {
        dom: "Bfrtip",

        ajax : {
        url:   "/savingCreate", 
        dataType: "json",
        contentType: "application/json; charset=utf-8", 
        type: "GET"
        }, 

        
        columns: [
             { data: "saving_date",
             "render": function (data) {
                var date = new Date(data);
                var month = date.getMonth() + 1;
                return (month.length > 1 ? month : "0" + month) + "/" + date.getDate() + "/" + date.getFullYear();
            }
           },  
            { data: "member_id" },   
            { data: "amount" },
             { data: "saving_code" }
        ],
        select: true,
        severSide:true,
        buttons: [
            { extend: "create", editor: editor },
            { extend: "edit",   editor: editor },
            { extend: "remove", editor: editor }
        ]
    } );
} );
 

  