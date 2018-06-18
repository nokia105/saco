@extends('layouts.master')
      @section('content')
      

<div class="row">

<div class="col-xs-12">
  <div class="col-xs-12" style="background-color: #FFF;">
    <h3>LOAN:<span style="color:orange;">#{{$code+$loan->id+$loan->member->member_id}}</span>/<span style="color:green;">{{strtoupper($loan->loan_status) }}</span></h3>
    <br/>

  </div>


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
         
     

      @endsection

       





          

