     @extends('layouts.master')
      @section('cover')
        <input type="hidden" value="{{$id=Request::segment(2)}}" name=""> 
     <div class="row">
        <div class="col-md-2">
            
                       <!-- Profile Image -->
          <div class="box box-info">
            <div class="box-body box-profile">
          
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('adminlte/dist/img/user4-128x128.jpg') }}" alt="User profile picture">

              <h3 class="profile-username text-center">{{$member->first_name}} {{$member->last_name}}</h3>

             <!--  <p class="text-muted text-center">Software Engineer</p> -->

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Number Loans</b> <a class="pull-right">{{$no_loans}}</a>
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
                          <a href="{{URL::to('profile/'.$id.'/membersavings')}}" class="btn btn-info btn-block"><b>Savings</b></a>
                        </span>
                        <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 55 </span>

                          <br /> -->
                          <a href="{{URL::to('profile/'.$id.'/membershares')}}" class="btn btn-info btn-block"><b>Shares</b></a>
                        </span>
                        <span class="btn  btn-sm btn-light no-hover">
                          <!-- <span class="line-height-1 bigger-170 blue"> 1,411 </span>

                          <br /> -->
                           
                          <a href="{{URL::to('profile/'.$id.'/newloan')}}" class="btn btn-info btn-block"><b>New Loan</b></a>
                        </span>
                        <span class="btn  btn-sm btn-light no-hover">
                          <!-- <span class="line-height-1 bigger-170 blue"> 1,411 </span>

                          <br /> -->
                           
                          <a href="{{URL::to('profile/'.$id.'/loanlist')}}" class="btn btn-info btn-block"><b>Loans</b></a>
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
                          <a href="{{URL::to('profile/'.$id.'/collateral')}}" class="btn btn-info btn-block"><b>Coleratels</b></a>
                        </span>

                        <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 7 </span>

                          <br /> -->
                          <a href="#" class="btn btn-info btn-block"><b>General Ledger</b></a>
                        </span>

                        
                  </div>
                 @yield('memberworkspace')

          </div>
          <!-- /.nav-tabs-custom -->



          <!--/.
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    

     @endsection

