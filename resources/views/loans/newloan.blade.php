    <!-- Main content -->

       @extends('loans.master')
      @section('userworkspace')
     <div class="col-md-12">
          <div class="box col-md-12 box-info">
            <div class="box-header">
              <h3 class="box-title">Create Loan</h3>
            </div>amail
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Product Category</label>
                <select class="form-control select2" style="width: 100%;">
                  <option value="">--Select Category--</option>
                  <option value="">Emergence Loan</option>
                  <option value="">School Loan</option>
                  <option value="">Afya Loan</option>
                 <!--  <option></option> -->
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                  <label for="exampleInputEmail1">Amount</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Period</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Colerateral</label>
                <select class="form-control select2" style="width: 100%;">
                  <option selected="selected">Alabama</option>
                  <option>Alaska</option>
                  <option disabled="disabled">California (disabled)</option>
                  <option>Delaware</option>
                </select>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    @endsection
