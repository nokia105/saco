     @extends('layouts.master')
      @section('content')
     <div class="row">
        <div class="col-md-2">

          <!-- Profile Image -->
          <div class="box box-info">
            <div class="box-body box-profile">
          
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('adminlte/dist/img/user4-128x128.jpg') }}" alt="User profile picture">

              <h3 class="profile-username text-center">Mrs SaCoSS</h3>

              <p class="text-muted text-center">Software Engineer</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Good Loans</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Bad Loans</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Othes</b> <a class="pull-right">13,287</a>
                </li>
              </ul>

             <!--  <a href="#" class="btn btn-info btn-block"><b>Follow</b></a> -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->

          <!-- /.box about-->
        </div>
        <!-- /.col -->
        <div class="col-md-10">
          <div class="center col-md-12 btn btn-info" >
                        <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 55 </span>

                          <br /> -->
                          <a href="#" class="btn btn-info btn-block"><b>Savings</b></a>
                        </span>
                        <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 55 </span>

                          <br /> -->
                          <a href="#" class="btn btn-info btn-block"><b>Sharings</b></a>
                        </span>
                        <span class="btn  btn-sm btn-light no-hover">
                          <!-- <span class="line-height-1 bigger-170 blue"> 1,411 </span>

                          <br /> -->
                          <a href="#" class="btn btn-info btn-block"><b>Loan</b></a>
                        </span>

                        <span class="btn  btn-sm  no-hover">
                          
                         <a href="#" class="btn btn-info btn-block"><b>Deposts</b></a>
                        </span>

                        <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 4 </span>

                          <br /> -->
                          <a href="#" class="btn btn-info btn-block"><b>Payments</b></a>
                          
                        </span>

                        <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 23 </span>

                          <br /> -->
                          <a href="#" class="btn btn-info btn-block"><b>Coleratels</b></a>
                        </span>

                        <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 7 </span>

                          <br /> -->
                          <a href="#" class="btn btn-info btn-block"><b>General Ledger</b></a>
                        </span>

                        
                  </div>
          <div class="col-md-12">
          <div class="box col-md-12">
            <div class="box-header">
              <h3 class="box-title">Loan List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </thead>
                <tbody>
                
                <tr>
                  <td>Other browsers</td>
                  <td>All others</td>
                  <td>-</td>
                  <td>-</td>
                  <td>U</td>
                </tr>
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

          </div>
          <!-- /.nav-tabs-custom -->



          <!--/.
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

     @endsection