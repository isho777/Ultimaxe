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
           
            <div class="x_content">
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">

                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h1>
                                          <i class="fa fa-globe"></i> Customer Order.
                                          <small class="pull-right">Date: {{$created_at}}</small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          From
                          <address>
                                          <strong>{{$custname}}</strong>
                                          <br>Phone: {{$phone}}
                                          <br>Email: {{$email}}
                                          <br><img src="data:image/Png;base64,{{$custsignature}}" height="30%" width="30%" />

                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          To
                          <address>
                                          <strong>{{$sales_person}}</strong>
                                          <br>Phone: +267 72369024
                                          <br>Email: sales@ultmex.co.bw
                                          <br><img src="data:image/Png;base64,{{$sales_signatur}}" height="30%" width="30%" />

                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <b>Dealsheet Number LVDST10{{$livesheetnumber}}</b>
                          <br>
                          <br>
                          <b>Order ID:</b> #{{$ordernumber}}
                          <br>
                          <b>Date of Creation :</b> {{$created_at}}
                          <br>
                          <b>Customer Order No:</b> {{$cust_order_number}}
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Qty</th>
                                <th>Package</th>
                                <th>Serial #</th>
                                <th style="width: 39%">Product</th>
                                <th>Pack Price</th>
                                <th>Total Inc</th>
                                <th>Total Excl</th>                                
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($orderinfo as $info)
                              <tr>
                                <td>{{$info->quantity}}</td>
                                <td>{{$info->packsize}}</td>
                                <td>{{$info->serialnumber}}</td>
                                <td>{{$info->description}}</td>
                                <td>P{{$info->price}}</td>

                                <td>P{{$info->total_inc}}</td>
                                <td>P{{$info->total_excl}}</td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                          <p class="lead">Quote Note:</p>
                         
                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                          Please wire transfere the total baance to the following account : FNBB Bracnch Code :9009 The Mall
                          </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <p class="lead">Amount Due 2/22/2014</p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Subtotal:</th>
                                  <td>P0.00</td>
                                </tr>
                                <tr>
                                  <th>Tax (10.0%)</th>
                                  <td>P0.00</td>
                                </tr>
                                <tr>
                                  <th>Shipping:</th>
                                  <td>P0.00</td>
                                </tr>
                                <tr>
                                  <th>Total:</th>
                                  <td>P{{$totalprice}}</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                          <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                         </div>
                      </div>

                    </section>
                  </div>

                </div>

                  <div class="x_panel">
                    <img src="{{ asset('public')}}/{{$pic}}" height="98%" width="98%"/>
                  </div>
              </div>
            </div>
            </div>
            
        </div>
    </div>
</div>

</div>
         
        
@endsection