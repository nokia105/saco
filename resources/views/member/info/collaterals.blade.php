@extends('member.member_template')
@section('memberinfo')

 

  <div class="row">
       <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Collaterals</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
             
                  <th>Name</th>
                  <th>Collateral Type</th>
                  <th>Value</th>
                  <th>Evaluation Date</th>
                  
                </tr>
                </thead>
                <tbody>
                @foreach($member->collateral as $collateral)
                <tr>
              
                  <td>{{$collateral->colateral_name}}</td>
                  <td>{{$collateral->colateral_type}}</td>
                  <td>{{$collateral->colateral_value}}</td>
                  <td>{{$collateral->colateralevalution_date}}</td>
            
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



@endsection