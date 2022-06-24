@extends('layouts.app')

@section('content')

@if(isset($sucess))
<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> System Executed Command Alert!</h5>
                  {{$sucess}}
                </div>

                @endif

@if(isset($error))
<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-ban"></i> System Executed Command Alert!</h5>
                  {{$error}}
                </div>
@endif
<div class="row">
    
   <!-- header -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" >
            <div class="x_title">
                <h2>All System User Role<small> The below information it contains all the information about the roles..</small></h2>
            
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="container">
                <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Role Number</th>
                          <th>Role ID</th>
                          <th>Role Name</th>
                          <th>Created Date</th>
                          <th>Modification Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                          @foreach($activerole as $role)
                        <tr>
                          <td>SUR10{{$role->id}}</td>
                          <td>{{$role->id}}</td>
                          <td>{{$role->rol_name}}</td>
                          <td>{{$role->updated_at}}</td>
                          <td>{{$role->created_at}}</td>
                          <td>
                              <div class="modal fade bs-example-modal-lg" tabindex="-1" id="rolemodel{{$role->id}}" role="dialog" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <form action="{{url('role/name/update')}}" method="post">
                                                {{ csrf_field() }}

                                                <input type="hidden" name="id" value="{{$role->id}}"/>
                                                <div class="modal-body">
                                                        <div class="x_panel" style="">
                                                                <div class="x_title">
                                                                    <h2>Modifying  Role <small> Please fill in the information of a new role. Current role is {{$role->rol_name}}.</small></h2>

                                                                    <div class="clearfix"></div>
                                                                    </div>
                                                                    <div class="x_content">

                                                                        <div class="container">
                                                                            <div class="col-md-6 col-xs-12">

                                                                                <div class="col-sm-6">
                                                                                    System Role Name
                                                                                    <div class="form-group">
                                                                                      <div class="input-group date" id="myDatepicker">
                                                                                        <span class="input-group-addon">
                                                                                            <span class="fa fa-cogs"></span>
                                                                                        </span>
                                                                                        <input type="text" id="rolename" name="rolename" class="form-control" required="" style="width:500px" value="{{$role->rol_name}}">
                                                                                      </div>
                                                                                    </div>
                                                                                  </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                <div class="modal-footer" style="background-color:#2A3F54">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade bs-example-modal-lg" tabindex="-1" id="deleterolemodel{{$role->id}}" role="dialog" aria-hidden="true" style="display: none;">

                                    <div class="modal-dialog modal-lg">
                                            <div class="modal-content">

                                                <form action="{{url('/role/name/remove')}}" method="post">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="id" value="{{$role->id}}"/>
                                                    <div class="modal-body">
                                                            <div class="x_panel" style="">
                                                                    <div class="x_title">
                                                                        <h2>Removing Role <small> Please be sure of your actio towards this role.</small></h2>

                                                                        <div class="clearfix"></div>
                                                                        </div>
                                                                        <div class="x_content">

                                                                            <div class="container">
                                                                                <div class="col-md-6 col-xs-12">

                                                                                Are you sure you want to delete {{$role->rol_name}} role ?

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                    <div class="modal-footer" style="background-color:#2A3F54">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                        <button type="submit" class="btn btn-danger">Yes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              <a href data-toggle="modal" data-target="#rolemodel{{$role->id}}">Modifiy</a> | <a href="{{url('views/moduleroles/'.$role->id.'/'.$role->rol_name)}}">View Modules</a> | <a href data-toggle="modal" data-target="#deleterolemodel{{$role->id}}">Remove</a>
                            </td>
                        </tr>
                        @endforeach
                    
                      </tbody>
                    </table>


                </div>

        </div>
    </div>
    <!-- end header -->

</div>

</div>
         
        
@endsection