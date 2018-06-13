    <!-- Main content -->

     @extends('loans.template')
      @section('memberworkspace')

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

        
      
      <form method="post" action="/payment">
            {{csrf_field()}}
            <input type="hidden" value="{{$id=request()->route('id')}}" name="member">
         <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title">Add Payment</h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
               <label for="">Select Payment</label>
               <div class="form-group{{ $errors->has('payment_type') ? ' has-error' : '' }}">

                    <div class="col-sm-6">
                      <select class="form-control select2 "  name="payment_type">
                        <option value="">-----select Payment------</option>
                        <option value="loan">loan</option>
                         <option value="saving">savings</option>
                         <option value="share">share</option>
                           
                      </select>
                      
                       
                    </div>
                     <small class="text-danger">{{ $errors->first('payment_type') }}</small>
              </div><br/><br/>
            
            <div class="col-md-6">
             <!--  <div class="box box-body box-primary"> -->
            
              <div class="form-group{{ $errors->has('payment') ? ' has-error' : '' }}">
                  <label for="exampleInputEmail1">Amount</label>
                  <input type="float" class="form-control"  name="payment" value="{{old('period')}}">
                   <small class="text-danger">{{ $errors->first('payment') }}</small>
              </div>
            <!-- </div> -->
            </div>
          <!-- /.row -->
        </div>

        <div class="row">
           <div class="col-md-2">
              
              <div class="form-group">
                  <label for=""></label>
                  <input type="submit"  value="Save" class="form-control btn btn-info pull-left" placeholder="100000">
              </div>
            </div>
        </div>
            <!-- /.box-body -->
      </div>
    </div>
   
     <!--/end submit -->

          <!-- /.box -->
       
      
       </form>

       
        
           
    @endsection

      