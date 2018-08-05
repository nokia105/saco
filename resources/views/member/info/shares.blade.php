@extends('member.member_template')
@section('memberinfo')

 

  <div class="row">
       <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Shares</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
             
                  <th>Amount (Tsh)</th>
                  <th>No: Share</th>
                  <th>Date</th>
                  
                </tr>
                </thead>
                <tbody>
                @foreach($member->no_shares as $share)
                <tr>
              
                  <td>{{$share->amount}}</td>
                  <td>{{$share->No_shares}}</td>
                   <td>{{$share->share_date}}</td>
            
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