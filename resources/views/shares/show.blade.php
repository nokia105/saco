      @extends('layouts.master')

      @section('content')
      <div class="row">
       <div class="col-xs-12">

         <!-- <div class="box">-->
            <div class="box-header">
              <h3 class="box-title">Shares</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Share Value</th>
                  <th>Minimum Shares</th>
                  <th>Maximum Shares</th>
                  <th>Status</th>                  
                </tr>
                </thead>
                <tbody>
                
                @foreach($shares as $share)

                    <tr>
                  <td>{{$share->share_value}}</td>
                  <td>{{$share->min_shares}}</td>
                  <td>{{$share->max_shares}}</td>
                  <td>{{$share->status}}</td>

                 
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
      <!-- /.row -->
      @endsection