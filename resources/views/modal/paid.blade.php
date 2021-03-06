

    <div class="error" style="padding-top:50px; text-align:center;">


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

    <form action ="{{url('/paid_submitted')}}" method="post">
       {{csrf_field()}}
        <input type="hidden" name="loan_id" value="{{$loan->id}}">
        <input type="hidden" name="voucher_id" value="{{$loan->voucher->id}}">
        <input type="hidden"  class="form-control" name="memberaccount" value="{{$loan_account= $loan->member->memberaccount->where('name','=','Loan Account')->first()->id}}" >
        <input type="hidden"  class="form-control" name="mainaccount" value="{{$saccossloan_account=\App\Mainaccount::where('name','=','Loan Account')->first()->id}}" >
        <input type="hidden"  class="form-control"  name="allamount" value="{{$loan->principle}}"  >

               <div class="ceneter" style="text-align: center; padding-bottom:5px;">
                                <h4>Voucher</h4>
                           </div>
             <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label for="exampleInputEmail1">Voucher No:</label>
                        <input type="text" name="" class="form-control" id="" value="#{{$loan->voucher->voucher_no}}"  READONLY>
                         
                    </div>
                 
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Loanee</label>
                        <input type="text"  class="form-control"  value="{{ucfirst($loan->member->first_name)}}  {{ucfirst($loan->member->last_name)}}" READONLY>
                       
                    </div>
              </div>
              <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label for="exampleInputEmail1">Dr Account:</label>
                        <input type="text"  class="form-control" value="{{$loan_account= $loan->member->memberaccount->where('name','=','Loan Account')->first()->account_no}}"  READONLY>
                         
                    </div>
                 
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Dr Amount</label>
                        <input type="text"  class="form-control"  value="{{$loan->voucher->amount}}" READONLY>
                       
                    </div>
              </div>


                 <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label for="exampleInputEmail1">Cr Account:</label>
                        <input type="text" class="form-control" id="" value="{{$saccossloan_account=\App\Mainaccount::where('name','=','Loan Account')->first()->account_no}}"  READONLY>
                         
                    </div>
                 
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Cr Amount</label>
                        <input type="text"  class="form-control"  value="{{$loan->voucher->amount}}" READONLY>
                       
                    </div>
              </div>
              
                 <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label for="exampleInputEmail1">Total Amount</label>
                        <input type="text"  class="form-control"  name="amount_paid" value="{{$loan->voucher->amount}}"  READONLY>
                         
                    </div>
                 
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Payment Method</label>
                        <input type="text"  class="form-control"  name="mode_payment" value="{{strtoupper($loan->voucher->mode_payment)}}" READONLY>
                       
                    </div>
              </div>
             
              <br/>
              <div class="form-row col-md-12">
                <div class="form-group col-md-12">
                <button class="btn btn-primary col-md-offset-3 col-md-3" style="margin-top: 20px;">paid<i class="fa fa-check-circle-o fa-white" style="color:green; font-size:15px;"></i></button>
              </div>
            </div>
          </div>

     
    </form>

     <script type="text/javascript">
       

          $(function(){
  $('.dp1').fdatepicker({
   // initialDate: '2018-02-06',
    format: 'yyyy-mm-dd',
    disableDblClickSelection: true,
    leftArrow:'<<',
    rightArrow:'>>',
    closeIcon:'X',
    closeButton: true
  });
});  

     </script>