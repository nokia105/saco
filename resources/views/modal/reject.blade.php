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

    <form action ="/reject_submitted" method="post">
    	          {{csrf_field()}}
    	 <input type="hidden" name="loan_id" value="{{$loan->id}}">         
    	<div class="form-group{{ $errors->has('reject_reason') ? ' has-error' : '' }}">
  <label for="reason">Reject Reason:</label>
  <textarea class="form-control" rows="4"  name="reject_reason" id="reason" value="{{old('reject_reason')}}"  required="true"></textarea>
   <small class="text-danger">{{ $errors->first('reject_reason') }}</small>
</div>


     <button>reject <i class="fa fa-ban" style="color:red; font-size:15px;"></i></button>