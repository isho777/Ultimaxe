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
    
    @if(isset($newdevice))
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" >
            <div class="x_title">
                <h2>New System Device <small> Please fill the below form fields with the approprite information.</small></h2>
            
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="container">
                <form action="{{url('devices/save')}}" method="post">
                {{ csrf_field() }}
                    <div class="row">


                        <div class="col-sm-4">
                            Device Serial Number
                            <div class="form-group">
                                <div class="input-group date" id="myDatepicker">
                                    <span class="input-group-addon">
                                    <span class="fa fa-barcode"></span>
                                    </span>
                                    <input type="text" class="form-control" name="serialnumber" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4"></div>
                        
                        <div class="col-sm-4"></div>

                        <div class="col-sm-4">
                            Device Brand: <small>For example Samsung</small>
                            <div class="form-group">
                                <div class="input-group date" id="datetimepicker7">
                                    <span class="input-group-addon">
                                            <span class="fa fa-question"></span>
                                    </span>
                                    <input type="text" class="form-control" name="brand" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                        &nbsp;
                        <div class="form-group">
                                <div class="input-group date" id="datetimepicker7" >
                                    <button type="submit" style="width:200px; align:right" class="btn btn-success flat" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="By clicking the save button, the system device will be saved in the system.">Save Device</button>
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
                    <h2>System Device Listing <small>System devices are listed in the below table</small></h2>
                    <div class="clearfix"></div>
            </div>
            <div class="x_content">
                   
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Device User</th>
                          <th>Device Serial Number</th>
                          <th>Device Brand</th>
                          <th>Created Date</th>
                          <th>Modification Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                          @foreach($devices as $device)
                        <tr>
                          <td>
                            @foreach($linkeduser as $user)
                                @if($user['deviceid'] == $device->id)
                                    {{$user['username']}}
                                @endif
                            @endforeach
                          </td>
                            <td><a href="{{url('getdevice/'.$device->d_serial_number)}}">{{$device->d_serial_number}}</a></td>
                          <td>{{$device->d_brand}}</td>
                          <td>{{$device->updated_at}}</td>
                          <td>{{$device->created_at}}</td>
                          <td>
                                <div class="modal fade bs-example-modal-lg" tabindex="-1" id="deleterolemodel{{$device->id}}" role="dialog" aria-hidden="true" style="display: none;">

                                    <div class="modal-dialog modal-lg">
                                            <div class="modal-content">

                                                <form action="{{url('/devices/remove')}}" method="post">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="id" value="{{$device->id}}"/>
                                                    <div class="modal-body">
                                                            <div class="x_panel" style="">
                                                                    <div class="x_title">
                                                                        <h2>Removing System Device <small> Please be sure of your actio towards this device.</small></h2>

                                                                        <div class="clearfix"></div>
                                                                        </div>
                                                                        <div class="x_content">

                                                                            <div class="container">
                                                                                <div class="<col-md-12></col-md-12> col-xs-12">

                                                                                Are you sure you want to delete device of serial number: {{$device->d_serial_number}}?

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
                            <div class="modal fade bs-example-modal-lg" tabindex="-1" id="asignmodel{{$device->id}}" role="dialog" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{url('devices/link')}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{$device->id}}"/>
                                                <div class="modal-body">
                                                        <div class="x_panel" style="">
                                                                <div class="x_title">
                                                                    <h2>Assigning System Device:<small> Please select the user to assign the device.</small></h2>

                                                                    <div class="clearfix"></div>
                                                                    </div>
                                                                    <div class="x_content">

                                                                        <div class="container">
                                                                            
                                                                            <div class="col-sm-5">
                                                                                Device Serial Number
                                                                                <div class="form-group">
                                                                                    <div class="input-group date" id="myDatepicker">
                                                                                        <span class="input-group-addon">
                                                                                        <span class="fa fa-barcode"></span>
                                                                                        </span>
                                                                                        <input type="text" class="form-control" name="serialnumber" readonly="readonly" style="width:250px" value="{{$device->d_serial_number}}" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-2"></div>
                                                                                
                                                                            <div class="col-sm-2"></div>

                                                                            <div class="col-sm-5">
                                                                                    System Users: <small>Select User from the drop down list below.</small>
                                                                                    <div class="form-group">
                                                                                        <div class="input-group date" id="datetimepicker7">
                                                                                            <span class="input-group-addon">
                                                                                                    <span class="fa fa-user"></span>
                                                                                            </span>
                                                                                            <select id="user" name="user" class="form-control" required="" style="width:400px">
                                                                                                @foreach($users as $user)
                                                                                                    <option value="{{$user->id}}">{{$user->name.' '.$user->lastname}}</option>
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
                            <div class="modal fade bs-example-modal-lg" tabindex="-1" id="devecemodel{{$device->id}}" role="dialog" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{url('devices/update')}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{$device->id}}"/>
                                                <div class="modal-body">
                                                        <div class="x_panel" style="">
                                                                <div class="x_title">
                                                                    <h2>Modifying System Device <small> Please fill in the information of a new role.</small></h2>

                                                                    <div class="clearfix"></div>
                                                                    </div>
                                                                    <div class="x_content">

                                                                        <div class="container">
                                                                            
                                                                            <div class="col-sm-5">
                                                                                Device Serial Number
                                                                                <div class="form-group">
                                                                                    <div class="input-group date" id="myDatepicker">
                                                                                        <span class="input-group-addon">
                                                                                        <span class="fa fa-barcode"></span>
                                                                                        </span>
                                                                                        <input type="text" class="form-control" name="serialnumber" style="width:250px" value="{{$device->d_serial_number}}" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-2"></div>
                                                                                
                                                                            <div class="col-sm-2"></div>

                                                                            <div class="col-sm-5">
                                                                                    Device Brand: <small>For example Samsung</small>
                                                                                    <div class="form-group">
                                                                                        <div class="input-group date" id="datetimepicker7">
                                                                                            <span class="input-group-addon">
                                                                                                    <span class="fa fa-question"></span>
                                                                                            </span>
                                                                                            <input type="text" style="width:250px" class="form-control" name="brand" value="{{$device->d_brand}}" required>
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
                            
                            
                            
                            
                            <a href  data-toggle="modal" data-target="#devecemodel{{$device->id}}" >Modify</a> | 
                            <a href  data-toggle="modal" data-target="#asignmodel{{$device->id}}" >Assign Device</a> | 
                            <a href  data-toggle="modal" data-target="#deleterolemodel{{$device->id}}" >Delete Device</a> 
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