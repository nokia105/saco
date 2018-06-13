

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

    <form action ="/pending_submitted" method="post">
    	          {{csrf_field()}}
    	 <input type="hidden" name="loan_id" value="{{$loan->id}}">         
    	<div class="form-group{{ $errors->has('pending_reason') ? ' has-error' : '' }}">
  <label for="reason">Pending Reason:</label>
  <textarea class="form-control" rows="4"  name="pending_reason" id="reason" value="{{old('pending_reason')}}"  required="true"></textarea>
   <small class="text-danger">{{ $errors->first('pending_reason') }}</small>
</div>


 <div class="form-group"> <!-- Date input -->
        <label class="control-label" for="date">Date</label>
        <input  class="form-control dp1" id="date" name="pending_workingdate" placeholder="yyyy-mm-dd" type="text"  required="true">
      </div>

     <button>pending <i class="fa fa-clock-o" style="color:red; font-size:15px;"></i></button>
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