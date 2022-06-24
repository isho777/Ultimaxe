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
    
    @if(isset($newuser))
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" >
            <div class="x_title">
                <h2>New System User <small> Please fill the below form fields with the approprite information.</small></h2>
            
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="container">
                <form action="{{url('save/newuser')}}" method="post">
                {{ csrf_field() }}
                    <div class="row">


                        <div class="col-sm-4">
                            Firstname's
                            <div class="form-group">
                                <div class="input-group date" id="myDatepicker">
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                    </span>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            Lastname
                            <div class="form-group">
                                <div class="input-group date" id="myDatepicker2">
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                    </span>
                                    <input type="text" class="form-control" name="lastname" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-4">
                            Email: <small>Please provide a work related email.</small>
                            <div class="form-group">
                                <div class="input-group date" id="myDatepicker3">
                                    <span class="input-group-addon">
                                    <span class="fa fa-envelope"></span>
                                    </span>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            Password: <small>Please keep this password save.</small>
                            <div class="form-group">
                                <div class="input-group date" id="datetimepicker7">
                                    <span class="input-group-addon">
                                            <span class="fa fa-unlock-alt"></span>
                                    </span>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                        &nbsp;
                        <div class="form-group">
                                <div class="input-group date" id="datetimepicker7" align="right">
                                    <button type="submit" style="width:200px" class="btn btn-success flat" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="By clicking the save button, the user will be saved in the system.">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


            </div>

        </div>
    </div>
    @endif
    <div class="">
        <div class="x_panel" >
            <div class="x_title">
                    <h2>System Users Listing <small>System users are listed in the below table</small></h2>
                    <div class="clearfix"></div>
            </div>
            <div class="x_content">
                   
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Status</th>
                          <th>Firstname</th>
                          <th>Lastname</th>
                          <th>Email</th>
                          <th>Department</th>
                          <th>Role</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                          @foreach($users as $user)
                        <tr>
                          <td>
                              @if($user['status'] == 0)
                                <a href="{{url('activate/'.$user['id'].'/'.$user['status'])}}">
                                  <span class="label label-danger">Inactive</span>
                                </a>
                                @endif
                                @if($user['status'] == 1)
                                    <a href="{{url('activate/'.$user['id'].'/'.$user['status'])}}">
                                        <span class="label label-success">Active&nbsp; </span>
                                    </a>
                                @endif
                          </td>
                          <td>{{$user['name']}}</td>
                          <td>{{$user['lastname']}}</td>
                          <td>{{$user['email']}}</td>
                          <td>
                                                            <!-- from hear -->
                            <div class="modal fade bs-example-modal-lg" tabindex="-1" id="departmentmodel{{$user['id']}}" role="dialog" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <form action="{{url('update/userdepartment')}}" method="post">
                                            {{ csrf_field() }}

                                            <input type="hidden" name="id" value="{{$user['id']}}"/>
                                            <div class="modal-body">
                                                    <div class="x_panel" style="">
                                                            <div class="x_title">
                                                                <h2>Modifying  Department <small> Please select new department. Current user department is {{$user['department']}}.</small></h2>

                                                                <div class="clearfix"></div>
                                                                </div>
                                                                <div class="x_content">

                                                                    <div class="container">
                                                                        <div class="col-md-6 col-xs-12">

                                                                            <div class="col-sm-6">
                                                                                System Department
                                                                                <div class="form-group">
                                                                                    <select id="department" name="department" class="form-control" required="" style="width:500px">
                                                                                        @foreach($departments as $department)
                                                                                            @if($department['department'] == $department->name)
                                                                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                                                                            @endif
                                                                                        @endforeach

                                                                                        @foreach($departments as $department)
                                                                                            @if($department['department'] != $department->name)
                                                                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </select>
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
                              <!-- to hear -->
                                @if($user['department'] == '')
                                        <a href data-toggle="modal" data-target="#departmentmodel{{$user['id']}}"><span class="label label-warning">Link this user to a deparment</span></a>
                                    @else
                                    
                                    <a href data-toggle="modal" data-target="#departmentmodel{{$user['id']}}">{{$user['department']}}</a>

                                    @endif    
                          </td>
                          <td>
                            <div class="modal fade bs-example-modal-lg" tabindex="-1" id="rolemodel{{$user['id']}}" role="dialog" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <form action="{{url('update/userrole')}}" method="post">
                                            {{ csrf_field() }}

                                            <input type="hidden" name="id" value="{{$user['id']}}"/>
                                            <div class="modal-body">
                                                    <div class="x_panel" style="">
                                                            <div class="x_title">
                                                                <h2>Modifying  Role <small> Please select the new role. Current user role is {{$user['role']}}.</small></h2>

                                                                <div class="clearfix"></div>
                                                                </div>
                                                                <div class="x_content">

                                                                    <div class="container">
                                                                        <div class="col-md-6 col-xs-12">

                                                                            <div class="col-sm-6">
                                                                                System Role
                                                                                <div class="form-group">
                                                                                    <select id="role" name="role" class="form-control" required="" style="width:500px">
                                                                                        @foreach($role as $rol)
                                                                                            @if($user['role'] == $rol->rol_name)
                                                                                            <option value="{{$rol->id}}">{{$rol->rol_name}}</option>
                                                                                            @endif
                                                                                        @endforeach

                                                                                        @foreach($role as $rol)
                                                                                            @if($user['role'] != $rol->rol_name)
                                                                                            <option value="{{$rol->id}}">{{$rol->rol_name}}</option>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </select>
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
                              @if($user['role'] == '')
                                <a href data-toggle="modal" data-target="#rolemodel{{$user['id']}}"><span class="label label-danger">Assign this user to a role</span></a>
                              @else
                              <a href data-toggle="modal" data-target="#rolemodel{{$user['id']}}">{{$user['role']}}</a>
                              @endif
                            </td>
                          <td>
                            <a href  data-toggle="modal" data-target="#model{{$user['id']}}">Modify</a>
                            <div class="modal fade bs-example-modal-lg" tabindex="-1" id="model{{$user['id']}}" role="dialog" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <form action="{{url('update/user')}}" method="post">
                                            {{ csrf_field() }}

                                            <input type="hidden" name="id" value="{{$user['id']}}"/>
                                            <div class="modal-body">
                                                    <div class="x_panel" style="">
                                                            <div class="x_title">
                                                                <h2>Modifying  Info <small> Please modify details below.</small></h2>

                                                                <div class="clearfix"></div>
                                                                </div>
                                                                <div class="x_content">

                                                                    <div class="container">
                                                                        <div class="row">

                                                                            <div class="col-sm-4">
                                                                                Firstname
                                                                                <div class="form-group">
                                                                                    <div class="input-group date" id="myDatepicker">
                                                                                        <input type="text" class="form-control" name="name" value="{{$user['name']}}" required>
                                                                                        <span class="input-group-addon">
                                                                                        <span class="glyphicon glyphicon-user"></span>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-4">
                                                                                Lastname
                                                                                <div class="form-group">
                                                                                    <div class="input-group date" id="myDatepicker2">
                                                                                        <input type="text" class="form-control" name="lastname" value="{{$user['lastname'] }}" required>
                                                                                        <span class="input-group-addon">
                                                                                        <span class="glyphicon glyphicon-user"></span>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-sm-4">
                                                                                Email: <small>Please provide a work related email.</small>
                                                                                <div class="form-group">
                                                                                    <div class="input-group date" id="myDatepicker3">
                                                                                        <span class="input-group-addon">
                                                                                        <span class="fa fa-envelope"></span>
                                                                                        </span>
                                                                                        <input type="email" class="form-control" name="email" Readonly="readonly" value="{{$user['email'] }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-sm-4">
                                                                                Department: <small>Change it at the table.</small>
                                                                                <div class="form-group">
                                                                                    <div class="input-group date" id="myDatepicker4">
                                                                                        <input type="text" class="form-control" Readonly="readonly" value="{{$user['department'] }}">
                                                                                        <span class="input-group-addon">
                                                                                        <span class="fa fa-building"></span>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-sm-4">
                                                                                Role:<small> Change it at the table</small>
                                                                                <div class="form-group">
                                                                                    <div class="input-group date" id="datetimepicker6">
                                                                                        <input type="text" class="form-control" Readonly="readonly" value="{{$user['role'] }}">
                                                                                        <span class="input-group-addon">
                                                                                                <span class="fa fa-cogs"></span>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-4">
                                                                                Password:<small> You can not view the user password.</small>
                                                                                <div class="form-group">
                                                                                    <div class="input-group date" id="datetimepicker6">
                                                                                        <input type="password" class="form-control" Readonly="readonly" value="345678987">
                                                                                        <span class="input-group-addon">
                                                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                                                        </span>
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
                          </td>
                        </tr>
                        @endforeach
                    
                      </tbody>
                    </table>
            </div>
            
        </div>
    </div>
</div>

</div>
         
        
@endsection