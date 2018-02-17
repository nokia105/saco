
@extends('layouts.master')

@section('content')

      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary" >
            <div class="box-header with-border">
              <h3 class="box-title">Shares</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="/shares">

            	 {{ csrf_field() }}
              <div class="box-body">
              	<div class="form-group">

                  <label for="shareValue">Share Value</label>
                  <input type="text" class="form-control" id="sharevalue" placeholder="Share Value" name="sharevalue" required>

                </div>
                <div class="form-group">

                  <label for="minimumShares">Minimum Shares</label>
                  <input type="text" class="form-control" id="minshares" placeholder="Minimum Shares" name="minshares" required>

                </div>
                <div class="form-group">

                  <label for="maximumShares">Maximum Shares</label>
                  <input type="text" class="form-control" id="maxshares" placeholder="Maximum Shares" name="maxshares" required>

                </div>
                <div class="form-group">

                  <label for="exampleInputEmail1">Status</label>
                  <input type="text" class="form-control" id="stauts" placeholder="Status" name="status" required>

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