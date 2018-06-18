<ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        
        </li>

       
        <li class="">
          <a href="{{route('members')}}">
            <i class="fa fa-user-circle-o"></i> <span>Members</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>
    
    

           <li class="">
          <a href="/reports">
            <i class="fa fa-file"></i> <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>
                   

               <li class="treeview">
          <a href="#">
            <i class="fa fa-tasks"></i>
            <span>Loans</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li class="">
          <a href="/newloans_received">
            <i class="fa fa-archive"></i> <span>Submitted </span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>


         <li class="">
          <a href="/rejected_loans">
            <i class="fa fa-briefcase"></i> <span>Rejected </span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

          <li class="">
          <a href="/pending_loans">
            <i class="fa fa-briefcase"></i> <span>Pending </span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

          <li class="">
          <a href="/approved_loans">
            <i class="fa fa-briefcase"></i> <span>Approved </span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

          </ul>
        </li>

              @role('Admin','member')
            <li class="treeview">
          <a href="#">
            <i class="fa fa-gears"></i>
            <span>Admin</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li class="">
          <a href="/Admin_member">
            <i class="fa fa-users"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>


         <li class="">
          <a href="/roles">
            <i class="fa fa-briefcase"></i> <span>Roles</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

        <li class="">
          <a href="/permissions">
            <i class="fa fa-briefcase"></i> <span>Permissions</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>
     </ul>
   </li>


          
         <li class="treeview">
          <a href="#">
            <i class="fa fa-gears"></i>
            <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li class="">
          <a href="/savings">
            <i class="fa fa-archive"></i> <span>Savings</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>


         <li class="">
          <a href="/shares">
            <i class="fa fa-briefcase"></i> <span>Shares</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

                <li class="">
          <a href="/loanCategory">
            <i class="fa fa-briefcase"></i> <span>Loan Category</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>
          <li class="">
          <a href="/loan_fee">
            <i class="fa fa-briefcase"></i> <span>Loan Fee</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

         <li class="">
          <a href="/insurances">
            <i class="fa fa-briefcase"></i> <span>Insurance</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>


         <li class="">
          <a href="/interest_methods">
            <i class="fa fa-briefcase"></i> <span>Interest Method</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>



         <li class="">
          <a href="/penalties">
            <i class="fa fa-ban"></i> <span>Penalties</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

         <li class="">
          <a href="/codes_registration">
            <i class="fa fa-code"></i> <span>Codes</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>
          </ul>
        </li>
   
            @endrole

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>