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
 

    $('#example').DataTable( {
        
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
            $(nTd).html("<a href='/savings/"+ name+"'>"+name+"</a>");
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




     $(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        ajax : {
        url     : "/loancat",
        contentType: "application/json; charset=utf-8", 
        type: "GET" 
    },
 
        table: "#Lcategory",
        fields: [ {
                label: "Category name:",
                name: "category_name"
            },
             {
                label: "Category Code:",
                name: "category_code"
            },


             {
                label: "Interest Rate:",
                name: "interest_rate"
            }, {
                label: "Duration:",
                name: "default_duration"
            }, 

             
            {
                label: "Status:",
                name: "status"
            }, 
           
            {  label:"Repayment Penalty",
               name:"repayment_penalty"
            },

             {
                label:"Grace Period:",
                name:"grace_period"
            }, 
            {
                label:"Minimum Amount",
                name:"min_amount"
            },
            { label:"Maximum Amount",
                 name:"max_amount"
            },
        ]
    } );
 

    $('#Lcategory').DataTable( {
        dom: "Bfrtip",

        ajax : {
        url:   "/loancat", 
        dataType: "json",
        contentType: "application/json; charset=utf-8", 
        type: "GET"
        }, 

        
        columns: [

            { data: "category_name" },   
            { data: "category_code" },
             { data: "interest_rate" },
            { data: "default_duration" },
             {data:"status"},
             {data:"repayment_penalty"},
            { data: "grace_period"},
            { data: "min_amount"},
            { data: "max_amount"}
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


      $(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        ajax : {
        url     : "/collat",
        contentType: "application/json; charset=utf-8", 
        type: "GET" 
    },
 
        table: "#collateral",
        fields: [ {
                label: "Collateral name:",
                name: "colateral_name"
            },
             {
                label: "Collateral Type:",
                name: "colateral_type"
            },


             {
                label: "Collateral Value:",
                name: "colateral_value"
            }, {
                label: "Evalution Date:",
                name: "colateralevalution_date",
                type:"datetime"
            },
        ]
    } );
 

    $('#collateral').DataTable( {
        dom: "Bfrtip",

        ajax : {
        url:   "/collat", 
        dataType: "json",
        contentType: "application/json; charset=utf-8", 
        type: "GET"
        }, 

        
        columns: [
        
            { data: "colateral_name" },   
            { data: "colateral_type" },
             { data: "colateral_value" },
            { data: "colateralevalution_date",

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

 

  