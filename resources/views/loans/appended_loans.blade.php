@extends('layouts.master')
      @section('content')
      


       <div class="row">
       <div class="col-xs-12">

          <div class="error" style="text-align:center">


            @if (session('error'))

          
                    <div class="alert alert-danger">
                        <strong>Warning! </strong>{{ session('error') }}
                    </div>

    
                @endif
            
            @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
        </div>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Pending Loans</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Month</th>
                   <th>Loan Principle(Tsh)</th>
                   <th>Loan Interest(Tsh)</th>
                   <th>Duration</th>
                   <th>Requesting Date</th>
                   <th>Action</th>
                 
                
                </tr>
                </thead>
                <tbody>
                    @foreach($appended_loans as $loan)
                 <tr>   
                <td>{{ \Carbon\Carbon::parse($loan->loanInssue_date)->format('F') }}</td>
                <td>{{$loan->principle}}</td>
                <td>{{($loan->mounthlyrepayment_interest)*$loan->duration}}</td>
                <td>{{$loan->duration}}</td>
                <td>{{$loan->loanInssue_date}}</td>
                <td class="center">
                                
    <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
            Action <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
        <li><a  onclick="showAjaxModal('/approve/{{$loan->id}}')" >
        <i class="fa fa-check-circle-o" style="color:green; font-size:15px;"></i>approve </a> </li>

         <li><a  onclick="showAjaxModal('/reject/{{$loan->id}}')" >
        <i class="fa fa-ban" style="color:red; font-size:15px;"></i>reject</a> </li>

       
                               
         </ul>
         </div>
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



            <div class="modal fade" id="modal_ajax">
        <div class="modal-dialog" style="width:500px; text-align: ;">
            <div class="modal-content" ">
                
                <div class="modal-header" style="text-align:center;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                
                <div class="modal-body" style="margin:0px;"  >
                
                       
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


         
     

      @endsection

       
       @section('js')

                      
    
      <!-- Select2 -->

 
    <script type="text/javascript">
    
    function showAjaxModal(url)
    {
        // SHOWING AJAX PRELOADER IMAGE
        jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"></div>');
        
        // LOADING THE AJAX MODAL
        jQuery('#modal_ajax').modal('show', {backdrop: 'false'});
    
        
        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
            url: url,
            success: function(response)
            {
            
            
                jQuery('#modal_ajax .modal-body').html(response);
                closeOnEscape: false;
            
            dialogClass: "noclose";
            }
        });
    }
</script>

    
    <!-- (Ajax Modal)-->
         
    
    <script type="text/javascript">
    function confirm_modal(delete_url)
    {
        jQuery('#modal-4').modal('show', {backdrop: 'static'});
        document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
    </script>
    
    <!-- (Normal Modal)-->
    <div class="modal fade" id="modal-4">
        <div class="modal-dialog" >
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-danger" id="delete_link"><?php echo 'delete';?></a>
                    <!--<button type="button" class="btn btn-info" data-dismiss="modal"><?php echo 'cancel';?></button>-->
                </div>
            </div>
        </div>
    </div>



       @endsection





          

