 @extends('layouts.master')

      @section('content')


      <div class="row">
<div class="row">
       <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Loan in Time Range</h3>
                         <br>
                         <br>
                 <h3 class="box-title">From  <strong>{{$startDate}}</strong> To  <strong>{{$endDate}}</strong></h3> 
                       <br>
                  
                   
                        
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Members</th>
                  <th>Loan Code</th>
                  <th>Principle</th>
                  <th>Interest</th>
                  <th>Fee</th>
                   <th>Start Date</th>
                 
                   <th>Status</th>
                </tr>
                </thead>
                <tbody>
                   @foreach($loans as $loan)
                <tr>
                  <td>{{$loan->member->first_name}} {{$loan->member->middle_name}} {{$loan->member->last_name}}</td>
                  <td>#{{$code+$loan->id+$loan->member->member_id}}</td>
                  <td>{{$loan->mounthlyrepayment_principle*$loan->duration}}</td>
                   <td>{{$loan->mounthlyrepayment_interest*$loan->duration}}</td>
                  <td>{{$loan->loan_fees->sum('fee_value')}}</td>
                   <td>{{$loan->action_date}}</td>
                
                  <td>{{$loan->loan_status}}</td>
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