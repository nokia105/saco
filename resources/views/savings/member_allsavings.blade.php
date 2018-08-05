 @extends('loans.template')
      @section('memberworkspace')


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
              <h3 class="box-title">All Savings</h3>

            </div>

             

             <table class="table">
              <thead>

              	<tr>
              <th></th>
                 <th></th>
                 </tr>

              </thead>

              <tbody>

              	 <tr style="background-color:#e8eefc; font-size:20px; font-weight:bold; color:#000;">
                      
                  	 <td>Total </td>
                  	
                  	  <td class="pull-right"> {{number_format($allmembersavings->sum('amount'),2)}}</td>
                  	  
                  </tr>
              	
              </tbody>
             	
             </table>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Amount</th>
                  <th>Code</th>
                  <th>Date</th>
                  
          
                    
                </tr>
                </thead>
                <tbody>

                	 
                    @foreach( $allmembersavings as $saving)

                   
                 <tr> 
                <td>{{number_format($saving->amount,2)}}</td>
                <td>{{$saving->saving_code}}</td>
                <td>{{ \Carbon\Carbon::parse($saving->saving_date)->format('d/m/y')}}</td>
                </tr>
                @endforeach


                 
               
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>


      @endsection