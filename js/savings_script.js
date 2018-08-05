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
                name: "savings.saving_date",
                type:"datetime"
            }, {
                label: "Member",
                name: "savings.member_id",
                 type: "select",
                 placeholder: "Select a member"
            }, 
            {
                label: "Amount:",
                name: "savings.amount"
            },              
            {
                label: "Saving Code:",
                name: "savings.saving_code"
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
             { data: "savings.saving_date",
             "render": function (data) {
                var date = new Date(data);
                var month = date.getMonth() + 1;
                return (month.length > 1 ? month : "0" + month) + "/" + date.getDate() + "/" + date.getFullYear();
            }
           },  
            { data: null, render: function ( data, type, row ) {
                // Combine the first and last names into a single table field
                name=data.members.first_name+' '+data.members.last_name;
                return name
                 }
            },  
            { data: "savings.amount" },
             { data: "savings.saving_code" }
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
 

  