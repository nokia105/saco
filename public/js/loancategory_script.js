var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        ajax : {
        url     : "/loancat",
        contentType: "application/json; charset=utf-8", 
        type: "GET" 
    },
 
        table: "#loancategory",
        fields: [ {
                label: "Category Name:",
                name: "category_name"
            }, {
                label: "Interest Rate:",
                name: "interest_rate"
            }, {
                label: "Default Duration:",
                name: "default_duration"
            }, 
            {
                label: "Category Code:",
                name: "category_code"
            },
            {
                label: "Repayment Penalty:",
                name: "repayment_penalty"
            },
            {
                label: "Grace Period:",
                name: "grace_period"
            },
            {
                label: "Minimum Amount:",
                name: "min_amount"
            },
             {
                label: "Maxmum Amount:",
                name: "max_amount"
            }

           /* {
                label: "Status:",
              name: "status"
            } */ 
        ]
    } );
 

    $('#loancategory').DataTable( {
        dom: "Bfrtip",

        ajax : {
        url:   "/loancat", 
        dataType: "json",
        contentType: "application/json; charset=utf-8", 
        type: "GET"
        }, 

        
        columns: [
            { data: "category_code"},
            { data: "category_name" },   
            { data: "interest_rate" },
            { data: "default_duration" },
            { data: "repayment_penalty" },
            { data: "grace_period" },
             { data: "min_amount" },
             { data: "max_amount" }
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
        url     : "/fee_category",
        contentType: "application/json; charset=utf-8", 
        type: "GET" 
    },
 
        table: "#loan_fee",
        fields: [ {
                label: "Fee Name:",
                name: "fee_name"
            }, {
                label: "Fee Code:",
                name: "fee_code"
            }, {
                label: "Fee value:",
                name: "fee_value"
            }
           
        ]
    } );
 

    $('#loan_fee').DataTable( {
        dom: "Bfrtip",

        ajax : {
        url:   "/fee_category", 
        dataType: "json",
        contentType: "application/json; charset=utf-8", 
        type: "GET"
        }, 

        
        columns: [
            { data: "fee_name"},
            { data: "fee_code" },   
            { data: "fee_code" },
            { data: "fee_value" }
        
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
 

  