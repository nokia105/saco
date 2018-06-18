
 
     @extends('layouts.master')

      @section('content')
      
<div class="row">
    <div class="col-xs-12">
     <div class="box">
          <div class="box-header">
            <h3 class="box-title">Members</h3>
        </div>
        <div class="box-body">
            <table id="example" class="table display  table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="width:20%;">Name</th>
                        <th>Reg No:#</th>
                        <th>Gender</th>
                        <th>D.O.B</th>
                        <th>Martial status</th>
                        <th>Couple</th>
                         <th>Mobile</th>
                        <th>Email</th>
                        
                         <th>Street</th>
                         <th>House No:</th>
                        <th>Bank</th>
                        <th>A/C No</th>
                        <th>Next of Kin</th>
                        <th>Kin  Relashioship</th>
                        <th>Joining Date</th>

                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
 </div>
</div>
    <style type="text/css">
        
    #example{
        width:100%;
        background-color: #fff;
    }
    th {
        font-size: 12px;
    }


     div.DTE_Field_Type_radio.DTE_Field_Name_{myFieldName} div.DTE_Field_InputControl > div > div {
  float: left;
  width: 100%; 
  /* change as needed */
}
    </style>

      @endsection

      @section('js')

   
        <script type="text/javascript">
   
$(document).ready(function() {
  @role('Loan Officer','member')
  $('.buttons-create,.buttons-edit,.buttons-remove').show();

  @else
     $('.buttons-create,.buttons-edit,.buttons-remove').hide();
    @endrole

});
       </script>

      @endsection



