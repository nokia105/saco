 @extends('layouts.master')
      @section('content')

           
           <div class="row">
        <div class="col-lg-7 col-lg-offset-3">

          <div class="box" >
            <div class="box-header" style="text-align: center">
    <h2><i class="fa fa-key"></i>Available Permissions
     
    </h2>
    <a href="{{ route('Admin_member.index') }}" class="btn btn-default pull-right" style="margin-left:20px;">Members</a>
    <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a></h1>
</div>

    
    <hr>
    <div class="box-body">
    <div class="table-responsive">
        <table  id="example1" class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Permissions</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td> 
                    <td>

                               <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
            Action <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
         <li><a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}">
        <i class="fa fa-edit" style="color:blue; font-size:15px;"></i>Edit </a></li>

         <li> {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
                    {!! Form::submit('Delete',array('class' => 'fa fa-trash')) !!}
                    {!! Form::close() !!}
        </li>
                               
         </ul>
         </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ URL::to('permissions/create') }}" class="btn btn-success">Add Permission</a>

</div>
</div>
</div>
</div>
</div>


      @endsection