
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
                  <th>Total to be payed</th>
                  <th>Pay per month</th>
                  <th>Interest </th>
                  <th>Loan Period</th>
                  <th>Payment Startdate</th>
                  <th>End Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($loanlists as $loanlist )
                <tr>
                  <td>{{  $loanlist->loancategory->category_name }}</td>
                  <td>{{  $loanlist->principle }} Tsh</td>
                  <td>{{($loanlist->principle+(($loanlist->interest/100)*$loanlist->principle))+$loanlist->loan_fees->sum('fee_value')}} Tsh</td>
                  <td>{{$loanlist->mounthlyrepayment_amount}} Tsh</td>
                  <td>{{  $loanlist->interest }} %</td>
                  <td>{{  $loanlist->duration }} months</td>
                  <td>{{  $loanlist->repayment_date }}</td>
                  <td>@php 
                    echo $effectiveDate = date('Y-m-d', strtotime($loanlist->duration.' month', strtotime($loanlist->repayment_date)));
                @endphp
                  </td>
                  <td><a href="{{ URL::to('profile/'.$id.'/editloan/' . $loanlist->id) }}"<i class="fa fa-edit"></a></i></td>
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