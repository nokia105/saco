
     @extends('loans.template')
      @section('memberworkspace')
      <div class="row">
       <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Loan list</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Category</th>
                  <th>Principle</th>
                  <th>Interest </th>
                  <th>Loan Period</th>
                  <th>Payment Startdate</th>
                  <th>End Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($loanlists as $loanlist )
                <tr>
                  <td>{{  $loanlist->loancategory->category_name }}</td>
                  <td>{{  $loanlist->loan_amount }}</td>
                  <td>{{  $loanlist->mounthlyrepayment_interest }}</td>
                  <td>{{  $loanlist->duration }}</td>
                  <td>{{  $loanlist->repatment_date }}</td>
                  <td>@php 
                    echo $effectiveDate = date('Y-m-d', strtotime($loanlist->duration.' month', strtotime($loanlist->repatment_date)));
                @endphp
                  </td>
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