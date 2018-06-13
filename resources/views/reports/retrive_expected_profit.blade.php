 @extends('layouts.master')

      @section('content')


      <div class="row">
<div class="row">
       <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Loan Report</h3>
                         <br>
                         <br>
                 <h3 class="box-title">Start Date <strong>{{$startDate}}</strong></h3> 
                       <br>
                  <h3 class="box-title">End Date <strong>{{$endDate}}</strong></h3> 
                   
                        
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="expected" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Month</th>
                  <th>No Loans</th>
                  <th>Principle</th>
                  <th>Interest</th>
                 
                </tr>
                </thead>
                <tbody>
                   @foreach($loans as $loan)
                <tr>
                  <td>{{\DateTime::createFromFormat('!m',$loan->monthnumber)->format('F')}}</td>
                  <td>{{$loan->no_loans}}</td>
                   <td>{{$loan->principlesum}}</td>
                   <td>{{$loan->interestsum}}</td>
                  
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



     @section('js')
          

        
      <script type="text/javascript">
        

            $(document).ready(function(){

   $(function () {
   
    $('#expected').DataTable({

      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false,

        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
  });
            



            });

      </script>


     @endsection