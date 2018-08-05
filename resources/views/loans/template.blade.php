     @extends('layouts.master')
      @section('cover')

       
           <style type="text/css">
          .no-hover li  b{
           color:#ffff;

          }
        </style>
        <input type="hidden" value="{{$id=Request::segment(2)}}" name=""> 

        @php
           $user=\App\Member::find($id);

        @endphp
     <div class="row">
        <div class="col-md-2">
            
                       <!-- Profile Image -->
          <div class="box box-info">
            <div class="box-body box-profile">
          
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('adminlte/dist/img/user4-128x128.jpg') }}" alt="User profile picture">

              <h3 class="profile-username text-center">{{strtoupper($member->first_name)}} {{strtoupper($member->last_name)}}</h3>

             <!--  <p class="text-muted text-center">Software Engineer</p> -->

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Number Loans</b> <a class="pull-right">{{$no_loans}}</a>
                </li>
                 <li class="list-group-item">
                  <b>Submitted Loans</b> <a class="pull-right">{{$submitted_loans}}</a>
                </li>
                <li class="list-group-item">
                  <b>rejected Loans</b> <a class="pull-right">{{$rejected_loans}}</a>
                </li>
                <li class="list-group-item">
                  <b>Pending</b> <a class="pull-right">{{$pending_loans}}</a>
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

                           <li class="{{ Request::is('profile/'.$id.'/membersavings') ? 'active' : '' }} btn btn-info btn-block">
                             <a href="{{route('membersavings',$id)}}"><b>Savings</b></a>
                           </li>
                          
                        </span>
                        <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 55 </span>

                          <br /> -->
                          <li class="{{Request::is('profile/'.$id.'/membershares') ? 'active' : '' }} btn btn-info btn-block">
                            
                             <a href="{{route('memberShares',$id)}}"><b>Shares </b></a>
                          </li>
                         
                        </span>
                        
                                     
                          @role('Cashier|Secretary','member')

                        <span class="btn  btn-sm btn-light no-hover">
                          <!-- <span class="line-height-1 bigger-170 blue"> 1,411 </span>

                          <br /> -->
 
                         <li class="{{Request::is('profile/'.$id.'/newloan') ? 'active' : '' }} btn btn-info btn-block">
                            <a href="{{url ('profile/'.$id.'/newloan')}}"><b>New Loan</b></a>
                            
                         </li>
                        </span>
                          @endrole
                      
  
                        
                        <span class="btn  btn-sm btn-light no-hover">
                          <!-- <span class="line-height-1 bigger-170 blue"> 1,411 </span>

                          <br /> -->
                            <li class="{{Request::is('profile/'.$id.'/loanlist') ? 'active' : '' }} btn btn-info btn-block">
                               <a href="{{url ('profile/'.$id.'/loanlist')}}"><b>Loans</b></a>
                            </li>  
                         
                        </span>

                       <!--  <span class="btn  btn-sm  no-hover">
                         
                        <a href="#" class="btn btn-info btn-block"><b>Deposts</b></a>
                       </span> -->
                          @role('Cashier','member')
                        <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 4 </span>

                          <br /> -->
                          <li class="{{Request::is('profile/'.$id.'/payment') ? 'active' : '' }} btn btn-info btn-block">
                            <a href="{{url('profile/'.$id.'/payment')}}"><b>Payments</b></a>
                          </li>
                          
                        </span>

                          @endrole

                        <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 23 </span>
                          <br /> -->
                         <li class="{{Request::is('profile/'.$id.'/collateral') ? 'active' : '' }} btn btn-info btn-block">
                            <a href="{{url ('profile/'.$id.'/collateral')}}" ><b>Collaterals</b></a>
                         </li>
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



         