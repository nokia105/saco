 @extends('layouts.master')
      @section('content')
      

<div class="row">

<div class="col-xs-12">
  <div class="col-xs-12" style="background-color: #FFF;">
    <h3>LOAN:<span style="color:orange;">#{{$code+$loan->id+$loan->member->member_id}}</span>/<span style="color:green;">{{strtoupper($loan->loan_status) }}</span></h3>
    <br/>

  </div>
   @if ($loan->loan_status==='draft')
    @role('Cashier|Secretary','member')
<div class="col-xs-7">
         <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
            Action <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
        <li><a  onclick="showAjaxModal('{{route('submit',$loan->id)}}')" >
        <i class="fa fa-send-o" style="color:green; font-size:15px;"></i>Submit</a> </li> <li><a href="{{route('drafted.edit',$loan->id)}}" class="fa fa-edit" style="color:blue; font-size:15px;"> Edit</a></li>
        <li><a href="{{route('drafted.delete',$loan->id)}}" class="fa fa-trash-o" style="color:red; font-size:15px;"  onclick="return confirm('Are you sure to delete?')"> Delete</a></li>                             
         </ul>
         </div>
</div>
 @endrole
 @elseif($loan->loan_status==='submitted')
    @role('Accountant|Cashier','member')  
  <div class="col-xs-7">
  <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
            Action <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
        <li><a  onclick="showAjaxModal('{{route('agree',$loan->id)}}')" >
        <i class="fa fa-check-circle-o" style="color:green; font-size:15px;"></i>review</a> </li>

         <li><a  onclick="showAjaxModal('{{route('reject',$loan->id)}}')" >
        <i class="fa fa-ban" style="color:red; font-size:15px;"></i>Denied</a> </li>

         <li><a  onclick="showAjaxModal('{{route('pending',$loan->id)}}')" >
        <i class="fa fa-clock-o" style="color:red; font-size:15px;"></i>Pending </a> </li>
                               
         </ul>
         </div>
        </div>
         @endrole
  @elseif($loan->loan_status==='reviewed')
   @role('Loan Officer','member')
    <div class="col-xs-7">     
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
       </div>
  @endrole
  @elseif($loan->loan_status==='assessed')
   @role('Chair','member')
    <div class="col-xs-7">
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
       </div>
  @endrole
@elseif($loan->loan_status==='approved')
   @role('Accountant','member')
   <div class="col-xs-7">
         <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
            Action <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
        <li><a  onclick="showAjaxModal('{{route('voucher',$loan->id)}}')" >
        <i class="fa fa-check-circle-o" style="color:green; font-size:15px;"></i>generate voucher</a> </li>
                               
         </ul>
         </div>
    </div>
    @endrole

    @else
@endif


  


<div class="panel with-nav-tabs panel-primary">

 <div class="panel-heading">
    <ul class="nav nav-tabs">
         <li class="active"><a data-toggle="tab" href="#general">General</a></li>
        <li class=""><a data-toggle="tab" href="#collateral">Collaterals</a></li>
        <li class=""><a data-toggle="tab" href="#guarantor">Gurantor</a></li>
        <li class=""><a data-toggle="tab" href="#insurance">Insurance</a></li>
         <li class=""><a data-toggle="tab" href="#charges">Charges</a></li>
            
   </ul>
 </div>




<div class="tab-content">
  <div id="general" class="tab-pane fade in active">
             <div class="box">
            <div class="box-header">
              <h3 class="box-title">Basic info</h3>
               
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
                
                  <th>Member Name</th>
                 
                   <th>Loan Principle(Tsh)</th>
                   <th>Loan Interest(Tsh)</th>
                   
                   <th>Duration</th>
                   <th>Requesting Date</th>
                  
                 
                
                </tr>
                </thead>
                <tbody>
                 <tr>   
                  <td>{{$loan->member->first_name}} {{$loan->member->middle_name}} {{$loan->member->last_name}}</td>
                  <td>{{$loan->principle}}</td>
                  <td>{{($loan->mounthlyrepayment_interest)*$loan->duration}}</td>
                  <td>{{$loan->duration}}</td>
                  <td>{{$loan->loanInssue_date}}</td>                  
                </tr>
              
               
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
  </div>
  <div id="collateral" class="tab-pane fade">
     <div class="box">
            <div class="box-header">
              <h3 class="box-title">Collerateral(s)</h3>
                <br>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                
                 
                 
                   <th>Collateral Name</th>
                   <th>Collateral type</th>
                   <th>Collateral Value</th>
              
                </tr>
                </thead>
                <tbody>
                       @if(!is_null($loan->collaterals)) 
                 @foreach( $loancollaterals as $collateral)
                 <tr>
                   
                  <td>{{$collateral->colateral_name}}</td>
                  <td> {{$collateral->colateral_type}}</td>
                  <td> {{$collateral->colateral_value}}</td>
                 

                </tr>
                 @endforeach 
                   @endif
              
               
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
  </div>
  <div id="guarantor" class="tab-pane fade">
   <div class="box">
            <div class="box-header">
              <h3 class="box-title">Guarantor(s)</h3>
                <br>
               
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="insuarance" class="table table-bordered table-striped">
                <thead>
                <tr>
                
             
                   <th>First Name</th>
                   <th>Midlle Name</th>
                   <th>Last Name</th>                    
              
                </tr>
                </thead>
                <tbody>
                   @foreach($loanguarantors as $loanguarantor)
                 <tr> 
                 
                  <td>{{$loanguarantor->first_name}}</td>
                   <td>{{$loanguarantor->middle_name}}</td>
                    <td>{{$loanguarantor->last_name}}</td>
                             
                </tr>
                 @endforeach  
              
               
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
  </div>

     <div id="insurance" class="tab-pane fade">
     <div class="box">
            <div class="box-header">
              <h3 class="box-title">Insurance(s)</h3>
                <br>
          
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                
                 
                   <th>Loan principle</th>
                   <th>Insurance Name</th>
                   <th>Insurance Percentage %</th>
                   <th>Insurance Amount Tsh</th>
                   
              
                </tr>
                </thead>
                <tbody>
                 <tr> 
                
                  <td>{{$loan->principle}}</td>
                  <td> {{$insurance->name}}</td>
                  <td> {{$insurance->percentage_insurance}}</td>
                              
                  <td>{{$loan->principle*($insurance->percentage_insurance/100)}}</td>
                                   
                </tr>
              
               
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
  </div>

   <div id="charges" class="tab-pane fade">
     <div class="box">
            <div class="box-header">
              <h3 class="box-title">Charge(s)</h3>
                <br>
               
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped col-md-6" style="width=40%;">
                <thead>
                <tr>
                
                 
                   <th>Fee </th>
                   <th>Value</th>
                   
                   
                </tr>
                </thead>
                <tbody>
                   @foreach($loanfees as $loanfee)
                 <tr> 
                   
                  <td>{{$loanfee->fee_name}}</td>
                  <td> {{$loanfee->fee_value}}</td>
                                
                </tr>
                  @endforeach 
              
               
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
  </div>
</div>

          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

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

       





          

