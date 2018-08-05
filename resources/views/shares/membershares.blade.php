 @extends('loans.template')
      @section('memberworkspace')
      <input type="hidden" value="{{$id=request()->route('id')}}" name=""> 
     <div class="col-md-12">
          <div class="box col-md-12">
            <div class="box-header">
              <h3 class="box-title">Shares</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="memberShare" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Amount</th>
                   <th>No of Shares</th>
                    <th>Share Date</th>
              
                </tr>
                </thead>
                <tbody>
                 <td><a href="{{route('member_allshare',$member->member_id)}}">{{number_format($member->no_shares->sum('amount'),2)}}</a></td>
                 <td>{{$member->no_shares->sum('No_shares')}}</td>
                 <td>{{$member->no_shares->last()->share_date}}</td>
               
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

       

  
 


          </script>
       
    @endsection


