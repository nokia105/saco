
@extends('layouts.master')

@section('content')

      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary" >
            <div class="box-header with-border">
              <h3 class="box-title">Membership form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="/members">

            	 {{ csrf_field() }}
              <div class="box-body">
              	<div class="form-group">

                  <label for="exampleInputEmail1">Firstname</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Firstname" name="firstname">

                </div>
                <div class="form-group">

                  <label for="exampleInputEmail1">Middlename</label>
                  <input type="text" class="form-control" id="Middlename" placeholder="Enter Middlename" name="middlename">

                </div>
                <div class="form-group">

                  <label for="exampleInputEmail1">Lastname</label>
                  <input type="text" class="form-control" id="Lastname" placeholder="Enter Lastname" name="lastname" >

                </div>
                <div class="form-group">

                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email">

                </div>
                <div class="form-group">
                  <label for="phone">Phone:</label>
                  <input type="text" class="form-control" id="phone" placeholder="Phone" name="phone">
                </div>
                 <div class="form-group">
                  <label for="phone">Bank name:</label>
                  <input type="text" class="form-control" id="bankname" placeholder="Enter Bankname" name="bankname">
                </div>
                 <div class="form-group">
                  <label for="phone">Account Number:</label>
                  <input type="text" class="form-control" id="accountnumber" placeholder="Acount number" name="accountnumber">
                </div>

                  <div class="form-group">
                  <label for="phone">Next kin Name:</label>
                  <input type="text" class="form-control" id="nextkinname" placeholder="next kin name" name="nextkinname">
                </div>

                   <div class="form-group">
                  <label for="phone">Next Kin Relashioship:</label>
                  <input type="text" class="form-control" id="nextkinrelashioship" placeholder="next kin relashioship" name="nextkinrelashioship">
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