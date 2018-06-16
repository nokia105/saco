

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

    <form action ="/approve_submitted" method="post">
             <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label for="exampleInputEmail1">Loan Code</label>
                        <input type="text" name="" class="form-control" id="" value=""  READONLY>
                       <span class="text-danger"></span>
                    </div>
                 
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Loanee</label>
                        <input type="text" name="middle_name" class="form-control" id="exampleInputPassword1" value="" READONLY>
                        <span class="text-danger"></span>
                    </div>
              </div>
              <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label for="exampleInputEmail1">Principle</label>
                        <input type="text" name="" class="form-control" id="" value=""  READONLY>
                       <span class="text-danger"></span>
                    </div>
                 
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Interest
                        <input type="text" name="middle_name" class="form-control" id="exampleInputPassword1" value="" READONLY>
                        <span class="text-danger"></span>
                    </div>
              </div>
              <div class="form-row col-md-12">
                    <div class="form-group  col-md-6">
                        <label for="exampleInputEmail1">Loan Period</label>
                        <input type="text" name="" class="form-control" id="" value=""  READONLY>
                       <span class="text-danger"></span>
                    </div>
                 
                    
              </div>
              <div class="form-row col-md-12">
                    <div class=" col-md-12">
                                        {{csrf_field()}}
                                 <input type="hidden" name="loan_id" value="{{$loan->id}}">         
                                <div class="form-group{{ $errors->has('approve_reason') ? ' has-error' : '' }}">
                            <label for="reason">Approve Reason:</label>
                            <textarea class="form-control" rows="2"  name="approve_reason" id="reason" value="{{old('approve_reason')}}"  required="true"></textarea>
                             <small class="text-danger">{{ $errors->first('approve_reason') }}</small>
                          </div>
                    </div>
                   
                    </div>
              <div class="form-row col-md-12">
                 <div class="col-md-12">
                                       
                    <label class="control-label" for="date">Date</label>
                    <input  class="form-control dp1" id="date" name="approve_workingdate" placeholder="yyyy-mm-dd" type="text" required="true" autocomplete="off">
                                      
                          </div>
              </div>
              <br/>
              <div class="form-row col-md-12">
                <div class="form-group col-md-12">
                <button class="btn btn-primary col-md-offset-3 col-md-3" style="margin-top: 20px;">Approve <i class="fa fa-check-circle-o fa-white" style="color:green; font-size:15px;"></i></button>
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