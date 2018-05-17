 @extends('layouts.master')

      @section('content')
<div class="row">
<div class="row">
       <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Loan Report</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Report name</th>
                  <th>Type</th>
                  <th>Category</th>
                  <th>view report</th>
                 
                 
                </tr>
                </thead>
                <tbody>
                
                <tr>

                   <td >Loan</a></td>
                   <td>Table</td>
                   <td>Loan</td>
                   <td><i><a href="reports/loans"><i class="fa fa-eye"></a></i></td>
                  
                </tr>


                <tr>
                   <td>Member</td>
                   <td>Table</td>
                   <td>Member</td>
                   <td><i><a href="reports/members"><i class="fa fa-eye"></a></i></td>
                  
                </tr>


                
                
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