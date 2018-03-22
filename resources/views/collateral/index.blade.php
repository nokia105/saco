
 
     @extends('layouts.master')
      @section('content')
<div class="row">
    <div class="col-xs-12">
     <div class="box">
          <div class="box-header">
            <h3 class="box-title">Members <span>List</span></h3>
        </div>
        <div class="box-body">
            <table id="collateral" class="table display  table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="width:20%;">Collateral Name</th>
                        <th>Collateral Type</th>
                        <th>Collateral Value</th>
                        <th>Collateral Evalution Date</th>
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
    </style>

      @endsection



    
