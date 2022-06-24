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

<div class="">
        <div class="x_panel" >
            <div class="x_title">
                    <h2>System Product Category Listing <small>System product categories are listed in the below table</small></h2>
                    <div class="clearfix"></div>
            </div>
            <div class="x_content">

              <table id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                  <tr>
                  <th>System #</th>
                    <th>Product Category</th>
                    <th>Product Serial</th>
                    <th>Product Name</th>
                    <th>Product Pack</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                
                @foreach ($products as $product)
    
                    <tr >
                      <td>SP10{{$product['id']}}</td>
                      <td>{{$product['category']}}</td>
                      <td>{{$product['serialnumber']}}</td>
                      <td>{{$product['p_name']}}</td>
                      <td>{{$product['p_size']}}</td>
                      <td>
                          <a href="{{url('/editproduct/'.$product['id'])}}">Modify</a> | 
                          <a href  data-toggle="modal" data-target="#myModal{{$product['id']}}">Delete</a>
                          <!-- Trigger the modal with a button -->

                          <!-- Modal -->
                            <!-- Trigger the modal with a button -->
                            <div class="modal fade bs-example-modal-lg" tabindex="-1" id="myModal{{$product['id']}}" role="dialog" aria-hidden="true" style="display: none;">

                                    <div class="modal-dialog modal-lg">
                                            <div class="modal-content">


                                                    <div class="modal-body">
                                                            <div class="x_panel" style="">
                                                                    <div class="x_title">
                                                                        <h2>Removing System Product <small> Please be sure of your action towards this product.</small></h2>

                                                                        <div class="clearfix"></div>
                                                                        </div>
                                                                        <div class="x_content">

                                                                            <div class="container">
                                                                                <div class="<col-md-12></col-md-12> col-xs-12">

                                                                                Are you sure you want to delete product of serial #: {{$product['serialnumber']}}?

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                    <div class="modal-footer" style="background-color:#2A3F54">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                        <a href="{{url('/deleteproduct/'.$product['id'])}}" class="btn btn-danger btn-flat">Yes</a>

                                                    </div>
                                            </div>
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

@endsection