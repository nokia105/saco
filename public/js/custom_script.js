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
                type:"datetime"
               
            }
        ]
    } );
 

    $('#example').dataTable( {
        
            

        dom: "Bfrtip",

        ajax : {
        url:   "/memberRegister", 
        dataType: "json",
        contentType: "application/json; charset=utf-8", 
        type: "GET"
        }, 

        
        columns: [
            { data: null, render: function ( data, type, row ) {
                // Combine the first and last names into a single table field


                name=data.first_name+' '+data.last_name;
                               return name
             
            },
                


        
               "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {

                name =oData.first_name+' '+oData.last_name;

            $(nTd).html("<a href='/profile/"+oData.member_id+"'>"+name+"</a>");
             }
          
             },
            { data: "email" },   
            { data: "phone" },
             { data: "bank_name" },
            { data: "account_number" },
             {data:"nextkin_name"},
             {data:"nextkin_relationship"},
            { data: "joining_date",

             "render": function (data) {
                var date = new Date(data);
                var month = date.getMonth() + 1;
                return (month.length > 1 ? month : "0" + month) + "/" + date.getDate() + "/" + date.getFullYear();
                 }
           }
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




  
 

  