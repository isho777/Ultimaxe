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


<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" >
            <div class="x_title">
                <h2>New Deal Period:<small> Please fill the below form fields with the approprite information.</small></h2>
            
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="container">
                <form action="{{url('/savedealperiod')}}" method="post">
                <input type="hidden" class="form-control col-4" id="startdate" name="startdate" placeholder="Deal Period Start Date e.g Y/M/D" value="">
                <input type="hidden" class="form-control col-4" id="enddate" name="enddate" placeholder="Deal Period End Date " value="">

                {{ csrf_field() }}
                    <div class="row">


                        <div class="col-sm-4">
                            Select Deal Period Dates
                            <div class="form-group">
                            <div id="reportrange_right" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                              <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                              <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                            </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                        </div>

                        <div class="col-sm-4">
                        </div>

                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                        &nbsp;
                        <div class="form-group">
                                <div class="input-group date" id="datetimepicker7" align="right">
                                    <button type="submit" style="width:200px" class="btn btn-success flat" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="By clicking the save button, the deal period's date will be saved in the system.">Save Deal Period</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


            </div>

        </div>
    </div>
</div>



 @endsection