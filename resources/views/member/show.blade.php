      @extends('layouts.master')

      @section('content')
      <div class="row">
       <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Saccos Members</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Firstname</th>
                  <th>Middlename</th>
                  <th>Lastname</th>
                  
                </tr>
                </thead>
                <tbody>
                
                @foreach($members as $member)

                    <tr>
                  <td>{{$member->firstname}}</td>
                  <td>{{$member->middlename}}</td>
                  <td>{{$member->lastname}}</td>
                 
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