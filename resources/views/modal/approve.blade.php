

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
    	          {{csrf_field()}}
    	 <input type="hidden" name="loan_id" value="{{$loan->id}}">         
    	<div class="form-group{{ $errors->has('approve_reason') ? ' has-error' : '' }}">
  <label for="reason">Approve Reason:</label>
  <textarea class="form-control" rows="4"  name="approve_reason" id="reason" value="{{old('approve_reason')}}"  required="true"></textarea>
   <small class="text-danger">{{ $errors->first('approve_reason') }}</small>
</div>

 <div class="form-group"> <!-- Date input -->
        <label class="control-label" for="date">Date</label>
        <input  class="form-control dp1" id="date" name="approve_workingdate" placeholder="yyyy-mm-dd" type="text" required="true" autocomplete="off">
      </div>

     <button>approve <i class="fa fa-check-circle-o" style="color:green; font-size:15px;"></i></button>
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