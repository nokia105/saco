 @extends('loans.template')
      @section('memberworkspace')
      <input type="hidden" value="{{$id=request()->route('id')}}" name=""> 
     <div class="col-md-12">
          <div class="box col-md-12">
            <div class="box-header">
              <h3 class="box-title">Member Savings</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="memberSaving" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Savings Amount</th>
                
                  <th>Saving Code</th>

                  <th>Savings Date</th>
                </tr>
                </thead>
                <tbody>
                
                <tr>

                </tr>
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        @section('js')
          <script>
            
             var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {

    editor = new $.fn.dataTable.Editor( {
        ajax : {
        url     : "/membersavings/{{$id}}",
        contentType: "application/json; charset=utf-8", 
        type: "GET" 
    },
 
        table: "#memberSaving",
        fields: [ {
                label: "Savings Amount:",
                name: "amount"
            }, {
                label: "Savings Code:",
                name: "saving_code"
            }, {
                label: "Savings Date:",
                name: "saving_date",
                type:"datetime"
            }

        ]
    } );

    $('#memberSaving').dataTable( {
        
            

        dom: "Bfrtip",

        ajax : {
        url:   "/membersavings/{{$id}}", 
        dataType: "json",
        contentType: "application/json; charset=utf-8", 
        type: "GET"
        }, 

        
        columns: [
          
            { data: "amount" },   
            { data: "saving_code" },
            { data: "saving_date",
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




  
 


          </script>
        @endsection
    @endsection