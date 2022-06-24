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
    
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" >
            <div class="x_title">
                <h2>Update Ultimex Customer <small> Please fill the below form fields with the approprite information.</small></h2>
            
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="container">
                <form action="{{url('customers/update')}}" method="post">
                    <input type="hidden" class="form-control" name="id" value="{{$customers->id}}"/>

                    {{csrf_field() }}
                    <div class="row">
                        <div class="col-sm-4">
                            Customer Name
                            <div class="form-group">
                                <div class="input-group date" id="myDatepicker">
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                    </span>
                                    <input type="text" class="form-control" name="name" value="{{$customers->name}}" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            Physical Address
                            <div class="form-group">
                                <div class="input-group date" id="myDatepicker2">
                                    <span class="input-group-addon">
                                    <span class="fa fa-university"></span>
                                    </span>
                                    <input type="text" class="form-control" name="p_adres" value="{{$customers->p_adres}}" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-4">
                            Postal Address
                            <div class="form-group">
                                <div class="input-group date" id="myDatepicker3">
                                    <span class="input-group-addon">
                                    <span class="fa fa-envelope"></span>
                                    </span>
                                    <input type="text" class="form-control" name="posta_adres" value="{{$customers->posta_adres}}" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            Location
                            <div class="form-group">
                                <div class="input-group date" id="datetimepicker7">
                                    <span class="input-group-addon">
                                            <span class="fa fa-globe"></span>
                                    </span>
                                    <input type="text" class="form-control" name="location" value="{{$customers->location}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            Email Address
                            <div class="form-group">
                                <div class="input-group date" id="datetimepicker7">
                                    <span class="input-group-addon">
                                            <span class="fa fa-envelope"></span>
                                    </span>
                                    <input type="email" class="form-control" value="{{$customers->emai_adress}}"  name="emai_adress" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            Telephone
                            <div class="form-group">
                                <div class="input-group date" id="datetimepicker7">
                                    <span class="input-group-addon">
                                            <span class="fa fa-phone"></span>
                                    </span>
                                    <input type="text" class="form-control" value="{{$customers->tel}}" name="tel" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                        <div class="form-group">
                                <div class="input-group date" id="datetimepicker7" align="right">
                                    <button type="submit" style="width:200px" class="btn btn-success flat" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="By clicking the update button, the customer will be updated in the system.">Update Customer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


            </div>

        </div>
    </div>

</div>
</div>
@endsection