 @extends('layouts.master')

      @section('content')

       @section('css')

           <style type="text/css">
     tr.no-border td {
      background-color:#0000;
  border: 0;
}
   </style>
       @endsection

<div class="row">

       <div class="col-md-8 col-md-offset-2">

          <div class="box">
            <div class="box-header" style="text-align: center;">
              <h3 class="box-title"><strong>Balance Sheet</strong></h3>
                         <br>
                         <br>
                         <h3 class="box-title"><strong>TASAF SACOSS</strong></h3>
                          <br>
                         <br>
                 <h3 class="box-title">For <strong></strong> Ending <strong></strong></h3>
               <!--   For the 12 month period Ending December 31, 2003  -->
                      
                              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table">
                <thead>
                <tr  style="border:0">
                 <th style="font-size">ACCOUNT</th>
                  <th class="pull-right">AMOUNT</th>
                </tr>
                </thead>
                <tbody>
                  <tr >
                  <td><strong>Asset</strong></td> 
                    <td></td>
                  </tr>

                  <tr>
                    <td></td>
                    <td></td>
                  </tr>
                   <tr>
                    <td><strong>Fixed asset</strong></td>
                    <td></td>
                  </tr>
                <tr class="no-border">
                  <td>P.P.E</td>
                  <td class="pull-right"></td>  
                </tr>     
               <tr>
                  <td>Buildings</td>
                  <td class="pull-right"></td>  
                </tr>
                 <tr>
                  <td>Investments</td>
                  <td class="pull-right"></td>  
                </tr>
                 

                  <tr>
                    <td></td>
                    <td></td>
                  </tr>

                   <tr>
                  <td ><strong>Total Fixed Asset</strong></td>
                  <td class="pull-right"><strong></strong></td>  
                </tr>
                   <tr>
                    <td><strong>Current asset</strong></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                  </tr>
                           @foreach($currentassets as  $currentasset)
                  <tr class="no-border">
                  <td>{{$currentasset->mainnames}}</td>
                  <td class="pull-right">{{$currentasset->accountsum}}</td>  
                </tr> 
                          @endforeach
                            
                         
                       @foreach($cashaccounts as $cashaccount)  
                          
                    <tr class="no-border">
                  <td>{{$cashaccount->mainnames}}</td>
                  <td class="pull-right">{{$cashaccount->accountsum}}</td>  
                </tr>

                       @endforeach
                   <tr>
                     <td></td>
                     <td></td>
                   </tr>
                  <tr>
                  <td ><strong>Total Current Asset</strong></td>
                  <td class="pull-right"><strong></strong></td>  
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td ><strong>Total Asset</strong></td>
                  <td class="pull-right"><strong></strong></td> 
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                </tr>

                <tr>
                  <td style=""><strong>EQUITY AND LIABILITY</strong></td>
                   <td></td>
                </tr>

                <tr>
                  <td>Member Savings</td>
                  <td class="pull-right"></td>
                </tr>


                <tr>
                  <td>Member Shares</td>
                  <td class="pull-right"></td>
                </tr>

                 <tr>
                  <td><strong>Total Equity And Liability</strong></td>
                  <td class="pull-right"><strong></strong></td>  
                </tr>
                  <tr>
                    <td></td>
                    <td></td>
                  </tr>

                 <tr>
                  <td ><strong></strong></td>
                  <td class="pull-right"><strong></strong></td>  
                </tr>
                  <tr>
                    <td></td>
                    <td></td>
                  </tr>
                 <tr>
                  <td ><strong>Tax</strong></td>
                  <td class="pull-right"></td>  
                </tr>
                 <tr>
                  <td><strong></strong></td>
                  <td class="pull-right"><strong></strong></td>  
                </tr>
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



     @section('js')
          


     @endsection

     