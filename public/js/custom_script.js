var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        ajax : {
        url     : "/memberRegister",
        contentType: "application/json; charset=utf-8", 
        type: "GET" 
    },
 
        table: "#example",
        fields: [ {
                label: "First name:",
                name: "first_name"
            }, {
                label: "Middle name:",
                name: "middle_name"
            }, {
                label: "Last Name:",
                name: "last_name"
            }, 

             
            {
                label: "Phone:",
                name: "phone"
            }, 

            {
             	label:"password",
             	name:"password"
             },
            {
                label: "Email:",
                name: "email"
            },
            {  label:"Bank Name",
               name:"bank_name"
            },

             {
            	label:"Account Number:",
            	name:"account_number"
            }, 
            {
                label:"Next kin Name",
                name:"nextkin_name"
            },{ label:"Next kin Relationship",
                 name:"nextkin_relationship"
            },
            {
                label: "joining date:",
                name: "joining_date",
                type: "datetime"
            }
        ]
    } );
 

    $('#example').DataTable( {
        dom: "Bfrtip",

        ajax : {
        url:   "/memberRegister", 
        dataType: "json",
        contentType: "application/json; charset=utf-8", 
        type: "GET"
        }, 

        
        columns: [
            { data: "first_name" },
             { data: "middle_name" },
            { data: "last_name" },   
            { data: "phone" },
          
            { data: "email" },
             { data: "bank_name" },
            { data: "account_number" },
             {data:"nextkin_name"},
             {data:"nextkin_relationship"},
            { data: "joining_date", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) }
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
 

  