 @extends('loans.template')
      @section('memberworkspace')
      <input type="hidden" value="{{$id=request()->route('id')}}" name=""> 
     <div class="col-md-12">
          <div class="box col-md-12">
            <div class="box-header">
              <h3 class="box-title">Shares</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="memberShare" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Amount</th>
                   <th>No of Shares</th>
                    <th>Share Date</th>
              
                </tr>
                </thead>
                <tbody>
                
               
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
        url     : "/memberShares/{{$id}}",
        contentType: "application/json; charset=utf-8", 
        type: "GET" 
    },
 
        table: "#memberShare",
        fields: [ {
                label: "Amount:",
                name: "member_share.amount"
            }, {
                label: "Share Date:",
                name: "member_share.share_date",
                type:"datetime"
            },

            
        ]
    } );

    $('#memberShare').dataTable( {
            
            

        dom: "Bfrtip",

        ajax : {
        url:   "/memberShares/{{$id}}", 
        dataType: "json",
        contentType: "application/json; charset=utf-8", 
        type: "GET"
        }, 
   
        columns: [
            { data: "member_share.amount" }, 
             { data: "member_share.No_shares" },  
            { data: "member_share.share_date",
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
           
            { extend: "edit",   editor: editor },
            { extend: "remove", editor: editor }
        ]
    } );

} );




  
 


          </script>
        @endsection
    @endsection