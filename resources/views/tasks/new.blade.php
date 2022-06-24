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

        @if(isset($newtask))
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" >
                    <div class="x_title">
                        <h2>New Employee Task <small> Please fill the below form fields with the approprite information.</small></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="container">
                            <form action="{{url('save/task')}}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" class="form-control col-4" id="startdate" name="startdate" placeholder="Deal Period Start Date e.g Y/M/D" value="">
                                <input type="hidden" class="form-control col-4" id="enddate" name="enddate" placeholder="Deal Period End Date " value="">

                                <div class="row">


                                    <div class="col-sm-4">
                                        Employee Name:
                                        <div class="form-group">
                                            <div class="input-group date" id="myDatepicker">
                                                <span class="input-group-addon">
                                                <span class="fa fa-user"></span>
                                                </span>
                                                <select id="userid" name="userid" class="form-control" required="" >
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name. ' '.$user->lastname}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        Task Name:
                                        <div class="form-group">
                                            <div class="input-group date" id="datetimepicker7">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-question"></span>
                                                </span>
                                                <input type="text" class="form-control" name="name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        Task Description:
                                        <div class="form-group">
                                            <div class="input-group date" id="datetimepicker7">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-tasks"></span>
                                                </span>
                                                <input type="text" class="form-control" name="description" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        Task Dates: <small>Please select date range of start date to end date</small>
                                        <div class="form-group">
                                            <div id="reportrange_right" class="pull-left" style="width:350px;background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                                <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4">
                                        &nbsp;
                                        <div class="form-group">
                                            <div class="input-group date" id="datetimepicker7" >
                                                <button type="submit" style="width:200px; align:right" class="btn btn-success flat" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="By clicking the save task button, the customer task will be saved in the system.">Save Customer Task</button>
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
                            <h2>Employees Task Listing <small>Employees are listed in the below table</small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Task #</th>
                                    <th>Employee Name</th>
                                    <th>Task Name</th>
                                    <th>Task Description</th>
                                    <th>Task Start Date</th>
                                    <th>Task End Date</th>
                                    <th>Status</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($tasks as $task)
                                    @if($task['status'] == 'Pending' || $task['status'] == 'Cancelled')
                                        <tr style="background-color: #f9656f;color: #fff;">
                                            <td><a href="{{url('/specific/task/')}}/{{$task['id']}}/{{$task['emp_name']}}">TSK10{{$task['id']}}</a></td>
                                            <td>{{$task['emp_name']}}</td>
                                            <td>{{$task['taskname']}}</td>
                                            <td>{{$task['taskdescription']}}</td>
                                            <td>{{$task['startdate']}}</td>
                                            <td>{{$task['enddate']}}</td>
                                            <td>{{$task['status']}}</td>
                                        </tr>
                                    @endif
                                    @if($task['status'] == 'Complete')
                                        <tr style="background-color: #26B99A;color: #fff;">
                                            <td><a href="{{url('/specific/task/')}}/{{$task['id']}}/{{$task['emp_name']}}">TSK10{{$task['id']}}</a></td>
                                            <td>{{$task['emp_name']}}</td>
                                            <td>{{$task['taskname']}}</td>
                                            <td>{{$task['taskdescription']}}</td>
                                            <td>{{$task['startdate']}}</td>
                                            <td>{{$task['enddate']}}</td>
                                            <td>{{$task['status']}}</td>
                                        </tr>

                                    @endif

                                    @if($task['status'] == 'In Progress')
                                        <tr style="background-color: #f9a265;color: #fff;">
                                            <td><a href="{{url('/specific/task/')}}/{{$task['id']}}/{{$task['emp_name']}}">TSK10{{$task['id']}}</a></td>
                                            <td>{{$task['emp_name']}}</td>
                                            <td>{{$task['taskname']}}</td>
                                            <td>{{$task['taskdescription']}}</td>
                                            <td>{{$task['startdate']}}</td>
                                            <td>{{$task['enddate']}}</td>
                                            <td>{{$task['status']}}</td>
                                        </tr>
                                        #f9a265
                                    @endif
                                @endforeach
                        </tbody>
                        </table>
                    </div>

                </div>
            </div>
    </div>

    </div>


@endsection