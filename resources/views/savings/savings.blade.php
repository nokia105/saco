
@extends('layouts.master')

@section('content')

      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary" >
            <div class="box-header with-border">
              <h3 class="box-title">Savings</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="/savings">

               {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">

                  <label for="savingDate">Saving Date</label>
                  <input type="date" class="form-control" id="savingdate" placeholder="Saving Date" name="savingdate" required>

                </div>
                <div class="form-group">

                  <label for="memberID">Member ID</label>
                  <input type="text" class="form-control" id="memberid" placeholder="Member ID" name="memberid" required>

                </div>
                <div class="form-group">

                  <label for="amount">Amount</label>
                  <input type="text" class="form-control" id="amount" placeholder="Amount" name="amount" required>

                </div>
                <div class="form-group">

                  <label for="savingCode">Saving Code</label>
                  <input type="text" class="form-control" id="savingcode" placeholder="Saving Code" name="savingcode" required>

                </div>
                                
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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