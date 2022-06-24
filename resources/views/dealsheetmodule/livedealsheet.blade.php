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
    
    <div class="">
        <div class="x_panel" >
            <div class="x_title">
                    <h2>Live Deal Sheet Listing<small>System live deal sheet are listed in the below table</small></h2>
                    <div class="clearfix"></div>
            </div>
            <div class="x_content">
                   
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Live Deal Sheet Number</th>
                          <th>Deal Sheet Number</th>
                          <th>Signing Date</th>
                          <th>Customer</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                      @foreach($livesheets as $sheet)
                        <tr>
                            <td>LVDST10{{$sheet['livesheetid']}}</td>
                            <td><a href="{{url('getdealperiod/'.$sheet['dealid'])}}">CURDST10{{$sheet['dealid']}}</a></td>
                            <td>{{$sheet['created_at']}}</td>
                            <td>{{$sheet['customername']}}</td>
                            <td><a href="{{url('signedperiod/'.$sheet['livesheetid'])}}">View Deal Sheet</a></td>
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