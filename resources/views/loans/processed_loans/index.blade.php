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
              <h3 class="box-title">Processed Loans</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Code</th>
                   <th>Requesting Date</th>
                   <th>Loan Principle(Tsh)</th>
                   <th>Loan Interest(Tsh)</th>
                   <th>Charges</th>
                   <th>Insurances</th>
                   <th>Duration</th>
                   <th>Status</th>

                    @role('Loan Officer','member')
                   <th>Action</th>
                   @endrole


                    @role('Chair','member')
                   <th>Action</th>
                   @endrole

                </tr>
                </thead>
                <tbody>
                    @foreach($processed_loans as $loan)
                 <tr> 
                 <td><a href="{{route('loan_info',$loan->id)}}">#{{$code+$loan->id+$loan->member_id}}</a></td>    
                    <td>{{\Carbon\Carbon::parse($loan->loanInssue_date)->format('d/m/y')}}</td>
                <td>{{number_format($loan->principle,2)}}</td>
                <td>{{number_format(($loan->mounthlyrepayment_interest)*$loan->duration,2)}}</td>
                <td>{{number_format($loan->loan_fees->sum('fee_value'),2)}}</td>
                <td>{{number_format((($loan->insurances->percentage_insurance)/100)*$loan->principle,2)}}</td>



                <td>{{$loan->duration}}</td>
                  <td>{{strtoupper($loan->loan_status)}}</td>
               

                  @role('Loan Officer','member')
                  @if($loan->loan_status=='reviewed')
                
                <td class="center">                     
    <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
            Action <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
        <li><a  onclick="showAjaxModal('{{route('agree',$loan->id)}}')" >
        <i class="fa fa-send" style="color:green; font-size:15px;"></i>Assess</a> </li>
        <li><a  onclick="showAjaxModal('{{route('reject',$loan->id)}}')" >
        <i class="fa fa-ban" style="color:red; font-size:15px;"></i>Reject</a> </li>                             
         </ul>
         </div>
</td>
       @endif 
       @endrole


               @role('Chair','member')

               @if($loan->loan_status=='assessed')
                
                <td class="center">                     
    <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
            Action <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
        <li><a  onclick="showAjaxModal('{{route('agree',$loan->id)}}')" >
        <i class="fa fa-send" style="color:green; font-size:15px;"></i>Approve</a> </li>
        <li><a  onclick="showAjaxModal('{{route('reject',$loan->id)}}')" >
        <i class="fa fa-ban" style="color:red; font-size:15px;"></i>Reject</a> </li>                             
         </ul>
         </div>
</td>
     @endif
       
       @endrole
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
