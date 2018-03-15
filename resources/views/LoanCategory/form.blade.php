
@extends('layouts.master')

@section('content')

      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="" >
            <div class="box-header">
              <h3 class="box-title">Loan Category Form:</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="/loanCategory">

            	 {{ csrf_field() }}
              <div class="box-body">

              	<div class="form-group">

                  <label for="Lcategory">Category Name:</label>
                  <input type="text" class="form-control" id="categoryname" placeholder="Enter Category" name="categoryname">

                </div>

                   <div class="form-group">

                  <label for="categorycode">Category Code:</label>
                  <input type="text" class="form-control" id="categorycode" placeholder="Enter Code" name="categorycode">

                </div>
                <div class="form-group">

                  <label for="Irate">Interest Rate:</label>
                  <input type="text" class="form-control" id="Irate" placeholder="Interest Rate" name="Irate">

                </div>
                <div class="form-group">

                  <label for="duration">Duration:</label>
                  <input type="text" class="form-control" id="duration" placeholder="Loan Duration" name="duration" >

                </div>


                <div class="form-group">

                  <label for="repaypenaty">Repayment penalty</label>
                  <input type="text" class="form-control" id="repaypenaty" placeholder="Repayment Penalty" name="repaypenaty">

                </div>



                <div class="form-group">

                  <label for="graceperiod">Grace Period:</label>
                  <input type="text" class="form-control" id="graceperiod" placeholder="Repayment Penalty" name="graceperiod">

                </div>




                <div class="form-group">

                  <label for="maxAmount">Maximum Amout</label>
                  <input type="text" class="form-control" id="maxAmount" placeholder="maximum Amount " name="maxAmount">

                </div>


                
                <div class="form-group">

                  <label for="minAmount">Minimum Amout</label>
                  <input type="text" class="form-control" id="minAmount" placeholder="minimum Amount" name="minAmount">

                </div>
                      
              </div>
              <!-- /.box-body -->

              <div>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

          <!-- Form Element sizes -->
          




        </div>
        <!--/.col (left) -->

      </div>
      <!-- /.row -->
@endsection