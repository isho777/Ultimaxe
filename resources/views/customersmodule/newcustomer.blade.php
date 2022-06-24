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
    
    @if(isset($newcustomer))
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" >
            <div class="x_title">
                <h2>New Ultimex Customer <small> Please fill the below form fields with the approprite information.</small></h2>
            
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="container">
                <form action="{{url('customers/save')}}" method="post">
                {{csrf_field() }}
                    <div class="row">


                        <div class="col-sm-4">
                            Customer Name
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
                            Physical Address
                            <div class="form-group">
                                <div class="input-group date" id="myDatepicker2">
                                    <span class="input-group-addon">
                                    <span class="fa fa-university"></span>
                                    </span>
                                    <input type="text" class="form-control" name="p_adres" required>
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
                                    <input type="text" class="form-control" name="posta_adres" required>
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
                                    <input type="text" class="form-control" name="location" required>
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
                                    <input type="email" class="form-control" name="emai_adress" required>
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
                                    <input type="text" class="form-control" name="tel" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                        <div class="form-group">
                                <div class="input-group date" id="datetimepicker7" align="right">
                                    <button type="submit" style="width:200px" class="btn btn-success flat" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="By clicking the save button, the customer will be saved in the system.">Save Customer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


            </div>

        </div>
    </div>
    @endif
   
   <!-- infor -->
   <div class="">
        <div class="x_panel" >
            <div class="x_title">
                    <h2>Ultimex Customers Listing <small>System customers are listed in the below table</small></h2>
                    <div class="clearfix"></div>
            </div>
            <div class="x_content">
                   
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Customer #</th>
                          <th>Customer Name</th>
                          <th>Physical Address</th>
                          <th>Postal Address</th>
                          <th>Location</th>
                          <th>Email Address</th>
                          <th>Telephone Number</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($customers as $customer)
                        <tr>
                          <td>SC10{{$customer->id}}</td>
                          <td>{{$customer->name}}</td>
                          <td>{{$customer->p_adres}}</td>
                          <td>{{$customer->posta_adres}}</td>
                          <td>{{$customer->location}}</td>
                          <td>{{$customer->emai_adress}}</td>
                          <td>{{$customer->tel}}</td>
                          <td>
                            <a href="{{url('editcustomer/'.$customer->id)}}">Modify</a>
                          </td>

                        </tr>
                        @endforeach
                    
                      </tbody>
                    </table>
            </div>
            
        </div>
    </div>
   <!-- end info -->
</div>

</div>
         
        
@endsection