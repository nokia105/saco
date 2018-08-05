 @extends('loans.template')
      @section('memberworkspace')
      <input type="hidden" value="{{$id=request()->route('id')}}" name=""> 
     <div class="col-md-12">
          <div class="box col-md-12">
            <div class="box-header">
              <h3 class="box-title">Savings</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="memberSaving" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Savings Amount</th>

                  <th>Last Date</th>
                </tr>
                </thead>
                <tbody>
                
                <tr>
                  <td><a href="{{route('member_allsavings',$member->member_id)}}">{{number_format($member->savingamount->sum('amount'),2)}}</a></td>
                  <td>{{\Carbon\carbon::parse($member->savingamount->last()->saving_date)->format('d/m/y')}}</td>
                </tr>
                </tbody>

                
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

    <script type="text/javascript">

/*      $(document).ready(function() {
  @role('Loan Officer','member')
  $('.buttons-create,.buttons-edit,.buttons-remove').show();

  @else
     $('.buttons-create,.buttons-edit,.buttons-remove').hide();
    @endrole

});*/

  
 


          </script>
       
    @endsection