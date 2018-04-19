    <!-- Main content -->

     @extends('loans.template')
      @section('memberworkspace')
      
      <form method="post" action="/updateloan">

       
          
          {{csrf_field()}}
          <input type="hidden" value="{{Request::segment(4)}}" name="loanid"> 
          <input type="hidden" value="{{$id=request()->route('id')}}" name="memberloan"> 
     <div class="col-md-12">
          <div class="box col-md-12 box-info">
            <div class="box-header">
              <h3 class="box-title">Edit Loan</h3>
            </div>
            <!-- /.box-header -->
         <div class="box box-body box-info">
          <div class="row">
            <div class="col-md-6">
              <div class="box-header">
              <h3 class="box-title">Basic Details</h3>
            </div>
    @foreach($loans as $loankey )
              <div class="form-group">
                <label>Product Category</label>
                <select class="form-control select2" style="width: 100%;" id="pcategory" name="pcategory">
                    <option value="">--Select Category--</option>
                  @foreach($loancategories as $loancategory)
                
                    <option value="{{ $loancategory->id }}" @php  if ($loankey->loancategory_id==$loancategory->id) echo 'selected'   @endphp>{{$loancategory->category_name}}</option>
                   @endforeach
                </select>
              </div>
              <!-- /.form-group -->
              
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
             <!--  <div class="box box-body box-primary"> -->
            <div class="form-group">
                  <label for="">Loan Officer</label>
                  <input type="text" class="form-control" value="{{$username}}"  name="loanOfficer"  placeholder="Enter name" readonly="true">
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Loan Requestor</label>
                  <input type="text" class="form-control"  value="{{$member->first_name}} {{$member->middle_name}} {{$member->last_name}}" readonly="true">
              </div>
            <!-- </div> -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
            <!-- /.box-body -->
          </div>


     <!--terms row-->
     <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title">Terms</h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              
              <div class="form-group">
                  <label for="">Principle</label>
                  <input type="text" class="form-control" id="principle" value="{{$loankey->principle}}" name="principle" placeholder="100000">
                </div>
                <div class="form-group">
                  <label for="">Interest</label>
                  <input type="text"  class="form-control" value="{{$loankey->interest}}" name="interest" id="interest">
                </div>
                <div class="form-group">
                <label>Interest Method</label>
                <select class="form-control select2"   name="Imethod" style="width: 100%;">
                  <option value="flat" @php if ($loankey->interest_method=='flat') echo 'selected' @endphp>Flat</option>
                  <option value="decline" @php if ($loankey->interest_method=='decline') echo 'selected' @endphp>Declining Balance</option>
                </select>
              </div>
         
            </div>
            <!-- /.col -->
            <div class="col-md-6">
            <div class="form-group">
                  <label for="" class="col-md-12">Loan Period</label>
                
                    <div class="col-sm-8">
                        <input type="text" class="form-control"  name="loanperiod" value="{{$loankey->duration}}" id="period">
                    </div>
                    <div class="col-sm-4">
                        <select class="col-md-4 form-control"  name="loanwm" style="width: 100%;">
                          <option value="month">Month</option>
                         <!--  <option value="week">Week</option> -->
                        </select>
                    </div>
              </div>

              <div class="form-group">
                <div class="col-sm-12">
                   <br/>
                  <label for="exampleInputEmail1">First Payment on</label>
                  <input type="date" data-date-format="yyyy-mm-dd" class="form-control" value="{{$loankey->repayment_date}}" name="startpayment" placeholder="10">
                </div>
              </div>
              <div class="form-group">
                <br/>
               
              </div>

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
            <!-- /.box-body -->
          </div>

     <!--/end terms-->
          <!--Colleratels row-->
     <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title">Colletarals</h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
               <div class="form-group">
                    <div class="col-sm-4">
                      <select id="collateral" class="form-control select2"  name="collateral[]" style="width: 100%;">
                        <option value="">--Select colleterals--</option>
                          @foreach($collaterals as  $collateral)
                          <option value="{{$collateral->id}}">{{$collateral->colateral_name}}</option>
                          @endforeach
                      </select>
                       
                    </div>
                    <div class="col-sm-1">
                        <div class="btn newcolerateral">+</div>
                    </div>
              </div><br/><br/>
            
            <div class="col-md-12">

                            <table class="table44  table" width="100%">
                              <thead class="thead-dark" style="background-color: #eee;">
                                <tr>

                                  <th width="24%">Asset</th>
                                  <th width="24%">Value</th>
                                  <th align="right" width="24%">Valuation Date</th>
                                  <th align="right" width="4%"></th>
                                </tr>
                              </thead>
                                @foreach($loankey->collaterals as $col)
                                <tr>

                                  <td >{{$col->colateral_name}} <input type="hidden" name="collate[]" value="{{$col->id}}" /> </td>
                                  <td> {{$col->colateral_value}} </td>
                                  <td > {{$col->colateralevalution_date}} </td>
                                  <td width="20%" ><input type="button" class="remove" style="color:red;" value="X" /></td>
                                </tr>
                                @endforeach 

                            </table>
            </div>

             
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
            <!-- /.box-body -->
      </div>

     <!--/end Colleratels-->
     <!--garantee and Charges row-->

          <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title">Guarantors</h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
               <div class="form-group">
                    <div class="col-sm-4">
                      <select id="guarantor" class="form-control select2 "  name="g[]" style="width: 100%;">
                        <option value="">--Select guarantors--</option>
                          @foreach($guarantors as  $guarantor)
                          <option value="{{$guarantor->member_id}}">{{$guarantor->first_name}} {{$guarantor->middle_name}} {{$guarantor->last_name}}</option>
                          @endforeach
                      </select>
                       
                    </div>
                    <div class="col-sm-1">
                        <div class="btn newguarantor">+</div>
                    </div>
              </div><br/><br/>
            
            <div class="col-md-12">

                            <table class="table table45" width="100%">
                                <thead class="thead-dark" style="background-color: #eee;">
                                <tr>

                                  <th width="24%">Firstname</th>
                                  <th width="24%">Middlename</th>
                                  <th align="right" width="24%">Lastname</th>
                                  <th align="right" width="4%"></th>
                                </tr> 
                              </thead>
                              <tbody>
                                @foreach($loankey->guarantor as $grantors)
                                <tr>

                                  <td >{{$grantors->first_name}} <input type="hidden" name="guarantor[]" value="{{$grantors->member_id}}" /> </td>
                                  <td> {{$grantors->middle_name}} </td>
                                  <td > {{$grantors->last_name}} </td>
                                  <td width="20%" ><input type="button" class="remove" style="color:red;" value="X" /></td>
                                </tr>
                                @endforeach 
                              </tbody>
                                

                            </table>
            </div>

             <div class="form-group">
              <label for="charges" class="col-md-12">Charges</label>
                    <div class="col-sm-4">
                      <select id="charges" class="form-control select2" name="charges" style="width: 100%;">
                        <option value="">--Select Fee--</option>
                        @foreach($fees as  $fee)
                          <option value="{{$fee->id}}">{{$fee->fee_name}} </option>
                          @endforeach
                      </select>
                       
                    </div>
                    <div class="col-sm-1">
                        <button class="btn newcharge">+</button>
                    </div>
              </div><br/><br/>

            <div class="col-md-12">
              <table class="fee  table" width="100%">
                               <thead class="thead-dark" style="background-color: #eee;">
                                <tr>
                                  <th width="24%">Fee </th>
                                  <th width="24%">Percentage</th>
                                  <th align="right" width="4%"></th>
                                </tr>
                                </thead>
                               @foreach($loankey->loan_fees as $fee)
                                <tr>

                                  <td >{{$fee->fee_name}} <input type="hidden" name="charges[]" value="{{$fee->id}}" /> </td>
                                  <td> {{$fee->fee_value}} </td>
                                  
                                  <td width="20%" ><input type="button" class="remove" style="color:red;" value="X" /></td>
                                </tr>
                                @endforeach  
                            </table>

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
            <!-- /.box-body -->
      </div>
@endforeach  

      <!--submit row-->
      <div class="box col-md-12 box-primary">
        <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="col-md-2">
              
              <div class="form-group">
                  <label for=""></label>
                  <input type="submit"  value="Save" class="form-control btn btn-info pull-left" placeholder="100000">
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-2">
              <div class="form-group">
                  <label for=""></label>
                  <input type="submit"  value="Cancel" class="form-control btn btn-danger pull-right"  placeholder="100000">
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>

     <!--/end submit -->

          <!-- /.box -->
        </div>
      </form>


    @endsection


      @section('js')
      <script type="text/javascript">
        

                     $(document).ready(function () {


// code to get all records from table via select box
$('#pcategory').change(function()
{ 

var pcategoryid = $(this).find(":selected").val();

    
var dataString = 'pcategory='+ pcategoryid;
   
   
$.ajax
({
         
url:'{{route('interest')}}',
type:"GET",
 dataType: 'json',
data: dataString,
cache: true,
success: function(data)
{
$("#interest").val(data.interest);
$("#period").val(data.duration);
}

});
})

});






        $(document).ready(function() {
      /*charges row script */

    $(".newcolerateral").click(function () {

          

          var collateralid=$("#collateral").val();
                 
                  var dataString='collateral='+ collateralid;



 if(collateralid !=''){

       //alert('mmmmmhh');
$.ajax({         
url:'{{route('membercollateral')}}',

type:"GET",
 dataType: 'json',
 data:dataString,
cache: true,
success: function(data)
{
    //alert(data);
      var row = $(".table44").find('tr:last');
        $('<tr><td>'+data.asset+'</td><td>'+data.value+'</td><td>'+data.duration+'<input type="hidden" value="'+data.id+'" name="collate[]"></td><td width="20%"><input type="button" class="remove" style="color:red;" value="X" /></td></tr>').insertAfter(row);
        $("#collateral").val('');
}

});

}
        return false;
  
});
    /* /end of garanters row */

    /*remove script*/
    $('.fee,.table44').on('click', '.remove', function(){
        $(this).closest('tr').remove();
    });

/*charges row script */
    $(".newcharge").click(function () {
      
        if ( $("#charges").val() !='')
        {   
          var dataString='charge_id='+$("#charges").val();
              $.ajax({         
              url:'{{route('loancharges')}}',

              type:"GET",
               dataType: 'json',
               data:dataString,
              cache: true,
              success: function(data)
              {
                     var row = $(".fee").find('tr:last');
        $('<tr><td>'+data.fee_name+'<input type="hidden" name="charges[]" value="'+data.id+'" ></td><td>'+data.fee_value+'</td><td width="20%"><input type="button" class="remove" style="color:red;" value="X" /></td></tr>').insertAfter(row);
                      $("#charges").val('');
              }

              });

        }
        return false;
    });
/*end of charge row */
});   







     //guarantor


        $(document).ready(function() {
   

    $(".newguarantor").click(function () {

           
                
          var guarantorid=$("#guarantor").val();
                 
                  var dataString='g='+ guarantorid;

                
             //     alert(dataString);
 if(guarantorid !=''){

     
$.ajax({         
url:'{{route('guarantors')}}',
type:"GET",
 dataType: 'json',
 data:dataString,
cache: true,
success: function(data)
{
    //alert(data);
      var row = $(".table45").find('tr:last');
        $('<tr><td>'+data.firstname+'</td><td>'+data.middlename+'</td><td>'+data.lastname+'<input type="hidden" value="'+data.id+'" name="guarantor[]"></td><td width="20%"><input type="button" class="remove" style="color:red;" value="X" /></td></tr>').insertAfter(row);
        $("#guarantor").val('');
}

});

}
        return false;
  
});
    /* /end of garanters row */

    /*remove script*/
    $('.table45').on('click', '.remove', function(){
        $(this).closest('tr').remove();
    });

/*charges row script 
    $(".newcharge").click(function () {
        if ( $("#charges").val() !='')
        {
        var row = $(".fee").find('tr:last');
        $('<tr><td>'+$("#charges").val()+'</td><td>1.2%</td><td width="20%"><input type="button" class="remove" style="color:red;" value="X" /></td></tr>').insertAfter(row);
        $("#charges").val('');
        }
        return false;
    });
end of charge row */
});                         

      </script>

       @endsection