    <!-- Main content -->

       @extends('loans.master')
      @section('userworkspace')
     <div class="col-md-12">
          <div class="box col-md-12 box-info">
            <div class="box-header">
              <h3 class="box-title">Create Loan</h3>
            </div>
            <!-- /.box-header -->
         <div class="box box-body box-info">
          <div class="row">
            <div class="col-md-6">
              <div class="box-header">
              <h3 class="box-title">Basic Details</h3>
            </div>
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
              
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
             <!--  <div class="box box-body box-primary"> -->
            <div class="form-group">
                  <label for="exampleInputEmail1">Loan Officer</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" readonly="true">
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Loan Requestor</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" Placeholder="John Jese" readonly="true">
              </div>
            <!-- </div> -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
            <!-- /.box-body -->
          </div>


     <!--terms row-->
     <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title">Terms</h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              
              <div class="form-group">
                  <label for="exampleInputEmail1">Principle</label>
                  <input type="email" class="form-control" id="principle" placeholder="100000">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Interest</label>
                  <input type="email" class="form-control" id="example\Interest" placeholder="10">
                </div>
                <div class="form-group">
                <label>Interest Method</label>
                <select class="form-control select2" style="width: 100%;">
                  <option value="">Flat</option>
                  <option value="">Declining Balance</option>
                </select>
              </div>
         
            </div>
            <!-- /.col -->
            <div class="col-md-6">
            <div class="form-group">
                  <label for="exampleInputEmail1" class="col-md-12">Loan Period</label>
                
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="20">
                    </div>
                    <div class="col-sm-4">
                        <select class="col-md-4 form-control" style="width: 100%;">
                          <option value="">Month</option>
                          <option value="">Week</option>
                        </select>
                    </div>
              </div>

              <div class="form-group">
                <div class="col-sm-12">
                   <br/>
                  <label for="exampleInputEmail1">First Payment on</label>
                  <input type="date" data-date-format="yyyy-mm-dd" class="form-control" id="example\Interest" placeholder="10">
                </div>
              </div>
              <div class="form-group">
                <br/>
                 <div class="col-sm-12">
                <label>Charges</label>
                <select class="form-control select2" style="width: 100%;">
                  <option value="">Loan Processing Fee</option>
                  <option value="">Office fee</option>
                  
                </select>
              </div>
              </div>

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
            <!-- /.box-body -->
          </div>

     <!--/end terms-->
          <!--Colleratels row-->
     <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title">Colleratels</h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              
              <div class="form-group">
                  <label for="exampleInputEmail1">Principle</label>
                  <input type="email" class="form-control" id="principle" placeholder="100000">
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <br/>
                 <div class="col-sm-12">
                <label>Charges</label>
                <select class="form-control select2" style="width: 100%;">
                  <option value="">Loan Processing Fee</option>
                  <option value="">Office fee</option>
                  
                </select>
              </div>
              </div>

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
            <!-- /.box-body -->
      </div>

     <!--/end Colleratels-->
     <!--garantee row-->
     <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title">Garanters</h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
               <div class="form-group">
                    <div class="col-sm-4">
                      <select id="colera" class="form-control select2" style="width: 100%;">
                        <option value="">--Select Granters--</option>
                        <option value="Car">Car</option>
                        <option value="House">House</option>
                        
                      </select>
                       
                    </div>
                    <div class="col-sm-1">
                        <button class="btn newcolerateral">+</button>
                    </div>
              </div><br/><br/>
            
            <div class="col-md-12">

                            <table class="table44  table" width="100%">
                                <tr>
                                  <th width="24%">Asset</th>
                                  <th width="24%">Value</th>
                                  <th align="right" width="24%">Valuation Date</th>
                                  <th align="right" width="4%"></th>
                                </tr> 
                            </table>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <br/>
                 <div class="col-sm-12">
                <label>Charges</label>
                <select class="form-control select2" style="width: 100%;">
                  <option value="">Loan Processing Fee</option>
                  <option value="">Office fee</option>
                  
                </select>
              </div>
              </div>

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
            <!-- /.box-body -->
      </div>

      <!--submit row-->
           <div class="box col-md-12 box-primary">
            
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              
              <div class="form-group">
                  <label for="exampleInputEmail1"></label>
                  <input type="submit"  value="Save" class="form-control" id="principle" placeholder="100000">
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                  <label for="exampleInputEmail1"></label>
                  <input type="submit"  value="Cancel" class="form-control" id="principle" placeholder="100000">
              </div>

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
            <!-- /.box-body -->
      </div>

     <!--/end submit -->

          <!-- /.box -->
        </div>
    @endsection
