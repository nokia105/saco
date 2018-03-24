var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        ajax : {
        url     : "/shareCreate",
        contentType: "application/json; charset=utf-8", 
        type: "GET" 
    },
 
        table: "#shares",
        fields: [ {
                label: "Share Value:",
                name: "share_value"
            }, {
                label: "Minimum Shares:",
                name: "min_shares"
            }, {
                label: "Maximum Shares:",
                name: "max_shares"
            }             
           /* {
                label: "Status:",
              name: "status"
            } */ 
        ]
    } );
 

    $('#shares').DataTable( {
        dom: "Bfrtip",

        ajax : {
        url:   "/shareCreate", 
        dataType: "json",
        contentType: "application/json; charset=utf-8", 
        type: "GET"
        }, 

        
        columns: [
            { data: "share_value"},
            { data: "min_shares" },   
            { data: "max_shares" },
             { data: "status" }
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
 

  