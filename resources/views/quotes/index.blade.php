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
                    <h2>Order's Listing<small>System order's are listed in the below table</small></h2>
                    <div class="clearfix"></div>
            </div>
            <div class="x_content">
                   
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Order Number</th>
                          <th>Customer Order Number</th>
                          <th>Ordering Customer Name</th>
                          <th>Live Sheet Number</th>
                          <th>Signing Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                      @foreach($quotes as $quoteinfo)
                        <tr>
                            <td>LVDSTQN10{{$quoteinfo->id}}</td>
                            <td>{{$quoteinfo->cust_order_number}}</td>
                            <td>{{$quoteinfo->customer_name}}</td>
                            <td><a href="{{url('signedperiod/'.$quoteinfo->livesheetnumber)}}">LVDST10{{$quoteinfo->livesheetnumber}}</a></td>
                            <td>{{$quoteinfo->created_at}}</td>
                            <td><a href="{{url('getorders/'.$quoteinfo->id)}}">View Order</a></td>
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