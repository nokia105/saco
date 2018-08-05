@extends('layouts.master')
      @section('content')
      
            

       <div class="row">
       <div class="col-xs-12">


         <div class="error" style="text-align:center">


            @if (session('error'))

          
                    <div class="alert alert-danger">
                        <strong>Warning! </strong>{{ session('error') }}
                    </div>

                @endif
            
            @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
        </div>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Approved Vouchers</h3>
            </div>
            <!-- /.box-header -->
              <div class="mainprinting">
             <div class="printcheck" >
                <button id="printcheck">print check</button>
             </div>
             <div class="printdispatch"  >
                <button id="printdispatch">print dispatch</button>
             </div>
           </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><input type="checkbox"  id="checkall" class="checkbox"  value="checkall"></th>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Voucher #</th>
                  <th>Amount(Tsh)</th>
                  <th>Payment Mode</th>
                  <th>Status</th>
                  <th>generated Date</th>
                  <th>updated Date</th>
                  <th>Check No</th>
                  
                   <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($vouchers as $voucher)
                 <tr>
                  <td><input type="checkbox"  id="checklist" class="checkbox" name="check[]" value="{{$voucher->id}}"></td>
                 <td>{{ucfirst($voucher->loan->member->first_name)}}  {{ucfirst($voucher->loan->member->last_name)}}</td> 
                 <td><a href="{{route('loan_info',$voucher->loan->id)}}">#{{$code+$voucher->loan->id+$voucher->loan->member_id}}</a></td>     
                <td>#{{$voucher->voucher_no}}</td>
                <td>{{number_format($voucher->amount,2)}}</td>
                <td>{{strtoupper($voucher->mode_payment)}}</td>
                <td>{{strtoupper($voucher->status)}}</td>
                <td>{{\Carbon\carbon::parse($voucher->date)->format('d/m/y')}}</td>
                <td>{{\Carbon\carbon::parse($voucher->updated_date)->format('d/m/y')}}</td>
                <td>{{$voucher->check_no}}</td>
             @role('Cashier','member')
                        <td class="center">
                                
    <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
            Action <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
        <li><a  onclick="showAjaxModal('{{route('paid',$voucher->loan->id)}}')" >
        <i class="fa fa-check-circle-o" style="color:green; font-size:15px;"></i>paid</a> </li>
                               
         </ul>
         </div>
  </td>
@endrole
                </tr>
                @endforeach
               
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

            <div  id="printtable" class="container-fluid"  style="display:none">


   <div class="loaninfo">
     <div class="company">
  <label>MIFUMOTZ</label>
  </div>

      <div class="col-md-6 ">
         
           <label><strong>Check List</strong></label>
               <br>
               <br>
                       
      </div>


       <div class="col-md-6">

         
                <label>Date Created: <strong>{{\Carbon\Carbon::now()}}</strong></label>
             
                          <br>
                          <br>
      
    </div>
   </div>
    
   <div id="table">

  <table class="table table-striped table-bordered">
  <thead>
    <tr>
       <th scope="col">payee</th>
      <th scope="col">Date</th> 
      <th scope="col">Check No</th>
      <th scope="col">Amount</th>
      <th scope="col">Total amount</th>
    </tr>
  </thead>
  <tbody id="printcontent">
    
  </tbody>
</table>
</div>
</div>


        </div>
        <!-- /.col -->
      </div>


                <div  id="printtabledispatch" class="container-fluid"  style="display:none">


   <div class="loaninfo">
     <div class="company">
  <label>MIFUMOTZ</label>
  </div>

      <div class="col-md-6 ">
         
           <label><strong>Dispatch</strong></label>
               <br>
               <br>
                       
      </div>


       <div class="col-md-6">

         
                <label>Date Created: <strong>{{\Carbon\Carbon::now()}}</strong></label>
             
                          <br>
                          <br>
      
    </div>
   </div>
    
   <div id="table">

  <table class="table table-striped table-bordered">
  <thead>
    <tr>
       <th scope="col">payee</th>
      <th scope="col">Date</th> 
      <th scope="col">Check No</th>
      <th scope="col">Amount</th>
      <th scope="col">Total amount</th>
    </tr>
  </thead>
  <tbody id="printcontentdispatch">
    
  </tbody>
</table>
</div>
</div>



 <div class="modal fade" id="modal_ajax">
        <div class="modal-dialog" style="width:500px; text-align: ;">
            <div class="modal-content" ">
                
                <div class="modal-header modal-header-primary" style="text-align:center;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                
                <div class="modal-body" style="margin:0px;"  >
                
                       
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
                      
                @include('modal.popup_lib')
        
       @endsection

        @section('js')
        <script type="text/javascript">


               $(document).ready(function(){
                  $('#checkall').click(function (e) {
                    
              $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);


                });

                $('#printcheck').click(function(e){
                    var allVals = [];

                    $('input[type="checkbox"]:checked').each(function () {
                     allVals.push($(this).val());
                      });


                           if (allVals.length ===0) {
                         alert('not checked');
                       } else {
                              // alert(allVals);

                                var url_link="{{url('/')}}/printcheck";
                                
                        // var $body = $("body");

                           $.ajax({
                           type: "GET",
                           url: url_link,
                           data:'array='+allVals,                                                           
                            success:  function(data){


                                $('#printcontent').html(data);
                                       
                             var restorepage=document.body.innerHTML;
                             var printContent=document.getElementById("printtable").innerHTML;
                             document.body.innerHTML=printContent;
                             window.print();

                             document.body.innerHTML=restorepage;


                               location.reload();
                             }
                            });
                          return;
                     
                      }

                });
                 
            });


                 $(document).ready(function(){
                  $('#checkall').click(function (e) {
                    
              $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);


                });

                $('#printdispatch').click(function(e){
                    var allVals = [];



                    $('input[type="checkbox"]:checked').each(function () {
                     allVals.push($(this).val());
                      });


                           if (allVals.length ===0) {
                         alert('not checked');
                       } else {
                              // alert(allVals);

                                var url_link="{{url('/')}}/printdispatch";
                                
                        // var $body = $("body");

                           $.ajax({
                           type: "GET",
                           url: url_link,
                           data:'array='+allVals,                                                           
                            success:  function(data){


                                $('#printcontentdispatch').html(data);
                                       
                             var restorepage=document.body.innerHTML;
                             var printContent=document.getElementById("printtabledispatch").innerHTML;
                             document.body.innerHTML=printContent;
                             window.print();

                             document.body.innerHTML=restorepage;


                               location.reload();
                             }
                            });
                          return;
                     
                      }

                });
                 
            });
        </script>
        @endsection


        @section('css')

          <style type="text/css">
            
      .mainprinting { 
    
    margin: 0 auto;
}
.printcheck    {
     margin-left: 30%;
    background: red;
    float: left;
}

.printdispatch  {
   
    background: #ffffff;
    margin-left: 50%;
}

          </style>

        @endsection
 

