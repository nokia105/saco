
     @extends('loans.template')
      @section('memberworkspace')
      <div class="row">
       <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Loan list</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Month</th>
                   <th>Total Amount(Tsh)</th>
                  <th>Month Principle(Tsh)</th>
                  <th>Month Interest(Tsh)</th>
                  <th>Amount Payed(Tsh)</th>
                 
                  <th>Due Date</th>
                
                </tr>
                </thead>
                <tbody>
                @foreach($loan->loanschedule as $loan_schedule )
                <tr>
                  <td>@php $month=date('m',strtotime($loan_schedule->duedate));
               echo DateTime::createFromFormat('!m',$month)->format('F');
         @endphp</td>
                  <td>{{ ($loan_schedule->monthprinciple)+($loan_schedule->monthinterest)}} </td>
                   <td>{{ $loan_schedule->monthprinciple}} </td>
                  <td>{{$loan_schedule->monthinterest }} </td>
                  <td>{{$loan_schedule->monthrepayment->sum('amountpayed')}}</td>
              
                  <td>{{$loan_schedule->duedate}}</td>
                  
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
      <!-- /.row -->
      @endsection