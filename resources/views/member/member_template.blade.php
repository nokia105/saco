     @extends('layouts.member_master')
      @section('member')
            <style type="text/css">
          .no-hover li  b{
           color:#ffff;

          }

          .panel-heading ul li a{
            color:#ffff;
          }

           .panel-heading ul li{
            margin:1%;
           }
        </style>
        <input type="hidden" value="{{$id=Request::segment(2)}}" name=""> 

     <div class="row">
        <div class="col-md-3">
            
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
          <div class="col-md-9">
          <div class="center col-md-12 btn btn-info" >
                        <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 55 </span>

                          <br /> -->

                           <li class="{{ Request::is('member/'.$id.'/savings') ? 'active' : '' }} btn btn-info btn-block">
                             <a href="{{url ('member/'.$id.'/savings')}}"><b>Savings</b></a>
                           </li>
                          
                        </span>
                        <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 55 </span>

                          <br /> -->
                          <li class="{{Request::is('member/'.$id.'/shares') ? 'active' : '' }} btn btn-info btn-block">
                            
                             <a href="{{url ('member/'.$id.'/shares')}}"><b>Shares </b></a>
                          </li>
                         
                        </span>
                        
                         
  
                        
                        <span class="btn  btn-sm btn-light no-hover">
                          <!-- <span class="line-height-1 bigger-170 blue"> 1,411 </span>

                          <br /> -->
                            <li class="{{Request::is('profile/'.$id.'/loanlist') ? 'active' : '' }} btn btn-info btn-block">
                               <a href="{{url ('member/'.$id.'/loans')}}"><b>Loans</b></a>
                            </li>  
                         
                        </span>


                        <span class="btn  btn-sm  no-hover">
                          <!-- <span class="line-height-1 bigger-170"> 23 </span>
                          <br /> -->
                         <li class="{{Request::is('member/'.$id.'/collaterals') ? 'active' : '' }} btn btn-info btn-block">
                            <a href="{{url ('member/'.$id.'/collaterals')}}" ><b>Collaterals</b></a>
                         </li>
                        </span>

                        
                  </div>
              
                           @yield('memberinfo')
          </div>
                

          </div>
          <!-- /.nav-tabs-custom -->

     

          <!--/.
        </div>
        <!-- /.col -->
      </div>


          
     @endsection

