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
              <h3 class="box-title">Submitted Loans</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Loan No:</th>
                  <th>Member</th>
                  <th>Submission Date</th>
                 
                   <th>Loan Principle(Tsh)</th>
                   <th>Loan Interest(Tsh)</th>
                   
                   <th>Duration(month)</th>
                   
                   <th>Action</th>
                 
                
                </tr>
                </thead>
                <tbody>
                    @foreach($receivedloans as $loan)
                 <tr>
                 <td><a href="/newloan_receive/{{$loan->id}}">#{{$code+$loan->id+$loan->member_id}}</a></td>  
                 <td>{{ucfirst($loan->member->first_name)}} {{ucfirst($loan->member->last_name)}}</td> 
                <td>{{ \Carbon\Carbon::parse($loan->loanInssue_date)->format('d/m/y') }}</td>

                <td>{{$loan->principle}}</td>
                <td>{{($loan->mounthlyrepayment_interest)*$loan->duration}}</td>
              
                <td>{{$loan->duration}}</td>
                
                <td class="center">
                                
    <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
            Action <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
        <li><a  onclick="showAjaxModal('/approve/{{$loan->id}}')" >
        <i class="fa fa-check-circle-o" style="color:green; font-size:15px;"></i>Approve </a> </li>

         <li><a  onclick="showAjaxModal('/reject/{{$loan->id}}')" >
        <i class="fa fa-ban" style="color:red; font-size:15px;"></i>Reject</a> </li>

         <li><a  onclick="showAjaxModal('/pending/{{$loan->id}}')" >
        <i class="fa fa-clock-o" style="color:red; font-size:15px;"></i>Pending </a> </li>
                               
         </ul>
         </div>
</td>
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





       <!--  <script>
       $(document).ready(function(){
       $('#modal_ajax').modal({show: true});
       }
        </script> -->

    <div class="modal fade" id="modal_ajax" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" style="width:500px; text-align: ;">
            <div class="modal-content" ">
                
                <div class="modal-header modal-header-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFF; z-index:1000;">X</button>
                    <h1></h1>
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

     





          

