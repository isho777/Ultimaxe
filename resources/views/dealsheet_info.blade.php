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
      @if($approved == "approved")
          <div class="x_panel" >
              <div class="x_title">
              <form action="{{url('approvedealsheet')}}" method="post">
                  {{ csrf_field() }}
                  <h2>Current Deal Approver Information:<small> The below information is for a user who can approve a deal.</small></h2>
                  @if($approved == "notapproved")
                    <button type="submit" style="width:200px;margin-left:278px" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="By clicking the approve button, the deal period will be approved.">Approve Deal Period</button>
                  @endif
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">

                  <div class="container">
  
                      <div class="row">


                          <div class="col-sm-4">
                              Firstname: <small>Deal approver firstname's.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="myDatepicker">
                                      <span class="input-group-addon">
                                      <span class="glyphicon glyphicon-user"></span>
                                      </span>
                                      <input disabled="disabled" type="text" class="form-control" value="{{$approvername}}" required>
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-4">
                              Surname: <small>Deal approver surname.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="myDatepicker2">
                                      <span class="input-group-addon">
                                      <span class="glyphicon glyphicon-user"></span>
                                      </span>
                                      <input disabled="disabled" type="text" class="form-control" value="{{$approversurname}}" required>
                                  </div>
                              </div>
                          </div>
                          
                          <div class="col-sm-4">
                              Email: <small>Deal approver email.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="myDatepicker3">
                                      <span class="input-group-addon">
                                      <span class="fa fa-envelope"></span>
                                      </span>
                                      <input disabled="disabled" type="email" class="form-control" value="{{$approveremail}}" required>
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-4">
                              Deal Approver Signature: <small>Deal approver signature.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="datetimepicker7">
                                      <img src="data:image/Png;base64,{{$approversignature}}" height="70%" width="70%" />
                                  </div>
                              </div>
                          </div>
                          <div class="col-sm-4"></div>
                          <div class="col-sm-4">
                          </div>
                          <div class="col-sm-4">
                              Deal Sheet Number: <small>Deal Sheet number.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="datetimepicker7">
                                  <span class="input-group-addon">
                                      <span class="fa fa-barcode"></span>
                                      </span>
                                      <input disabled="disabled" type="email" class="form-control" value="CURDST10{{$dealid}}" required>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <input type="hidden" value="{{$dealid}}" name="dealid" id="dealid"/>
                      <input type="hidden" value="{{$approversignature}}" name="signature" id="signature"/>
                      <input type="hidden" id="name" name="name" value="{{$approvername}}"/>
                      <input type="hidden" id="lastname" name="lastname" value="{{$approversurname}}"/>
                      <input type="hidden" name="email" id="email" value="{{$approveremail}}" />
                  </form>


              </div>

          </div>
      @endif
        @if($approved == "notapproved")
        <div class="x_panel" >
              <div class="x_title">
              <form action="{{url('approvedealsheet')}}" method="post">
                  {{ csrf_field() }}
                  <h2>Current Deal Approver Information:<small> The below information is for a user who can approve a deal.</small></h2>
                  @if($approved == "notapproved")
                    <button type="submit" style="width:200px;margin-left:278px" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="By clicking the approve button, the deal period will be approved.">Approve Deal Period</button>
                  @endif
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">

                  <div class="container">
  
                      <div class="row">


                          <div class="col-sm-4">
                              Firstname: <small>Deal approver firstname's.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="myDatepicker">
                                      <span class="input-group-addon">
                                      <span class="glyphicon glyphicon-user"></span>
                                      </span>
                                      <input disabled="disabled" type="text" class="form-control" value="{{Auth::user()->name}}" required>
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-4">
                              Surname: <small>Deal approver surname.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="myDatepicker2">
                                      <span class="input-group-addon">
                                      <span class="glyphicon glyphicon-user"></span>
                                      </span>
                                      <input disabled="disabled" type="text" class="form-control" value="{{Auth::user()->lastname}}" required>
                                  </div>
                              </div>
                          </div>
                          
                          <div class="col-sm-4">
                              Email: <small>Deal approver email.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="myDatepicker3">
                                      <span class="input-group-addon">
                                      <span class="fa fa-envelope"></span>
                                      </span>
                                      <input disabled="disabled" type="email" class="form-control" value="{{Auth::user()->email}}" required>
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-4">
                              Deal Approver Signature: <small>Deal approver signature.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="datetimepicker7">
                                      <img src="data:image/Png;base64,{{Auth::user()->signature}}" height="70%" width="70%" />
                                  </div>
                              </div>
                          </div>
                          <div class="col-sm-4"></div>
                          <div class="col-sm-4">
                          </div>
                          <div class="col-sm-4">
                              Deal Sheet Number: <small>Deal Sheet number.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="datetimepicker7">
                                  <span class="input-group-addon">
                                      <span class="fa fa-barcode"></span>
                                      </span>
                                      <input disabled="disabled" type="email" class="form-control" value="CURDST10{{$dealid}}" required>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <input type="hidden" value="{{$dealid}}" name="dealid" id="dealid"/>
                      <input type="hidden" value="{{Auth::user()->signature}}" name="signature" id="signature"/>
                      <input type="hidden" id="name" name="name" value="{{Auth::user()->name}}"/>
                      <input type="hidden" id="lastname" name="lastname" value="{{Auth::user()->lastname}}"/>
                      <input type="hidden" name="email" id="email" value="{{Auth::user()->email}}" />
                  </form>


              </div>

          </div>
        @endif
    </div>


<div class="">
        <div class="x_panel" >
            <div class="x_title">
                    <h2>Deal Products Listing:<small>Below is all the deal period for period of {{$deal_begining}} to {{$deal_ending}}</small></h2>
                    <form action="{{url('/dealproducts')}}" method="post" style="align:right" id="forms" name="forms">
                       {{csrf_field()}}
                
                @if($approved == "notapproved")
                  <button type="submit" id="submit" style="width:200px;margin-left:320px" class="btn btn-success flat" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="By clicking the update deal products button, the deal products will be updated in the system.">Update Deal Products</button>
                @endif

                <input type="hidden" id="pname" name="pname"/>
                <input type="hidden" id="pprice" name="pprice"/>
                <input type="hidden" value="{{$dealid}}" name="dealid" id="dealid"/>
            </form>
                    
                    <div class="clearfix"></div>
            </div>
            <div class="x_content">

              <table id="deals" class="table table-striped jambo_table bulk_action">
                <thead>
                  <tr class="headings">
                    <th><input type="checkbox" id="check-all" class="flat"
                    @if($approved == "approved")
                                  disabled="disabled"
                              @endif
                    ></th>
                    <th class="column-title">System #</th>
                    <th class="column-title">Product Category</th>
                    <th class="column-title">Product Serial</th>
                    <th class="column-title">Product Name</th>
                    <th class="column-title">Product Pack</th>
                    <th class="column-title">Price</th>
                    <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                    </th>
                  </tr>
                </thead>
                <tbody>
                
                @foreach ($products as $product)
    
                      <tr class="even pointer 
                              @foreach($dealdata as $dealproduct)
                                @if($dealproduct['product_id'] == $product['id'])
                                  selected
                                @endif
                              @endforeach">
                      <td class="a-center ">
                        <input type="checkbox" class="flat" name="table_records"
                              @foreach($dealdata as $dealproduct)
                                      @if($dealproduct['product_id'] == $product['id'])
                                        checked
                                      @endif
                              @endforeach
                              @if($approved == "approved")
                                  disabled="disabled"
                              @endif
                        />
                      </td> 
                      <td class=" ">{{$product['id']}}</td>
                      <td class=" ">{{$product['category']}}</td>
                      <td class=" ">{{$product['serialnumber']}}</td>
                      <td class=" ">{{$product['p_name']}}</td>
                      <td class=" ">{{$product['p_size']}}</td>
                      <td class=" ">
                          <input type="text" class="form-control" style="width:90px; height:21px" id="deaprice" name="price"
                                @foreach($dealdata as $dealproduct)
                                          @if($dealproduct['product_id'] == $product['id'])
                                            value="{{$dealproduct['price']}}"
                                          @endif
                                @endforeach

                                @if($approved == "approved")
                                  disabled="disabled"
                                @endif
                          />
                      </td>
                    </tr>
                @endforeach

             </tbody>
              
              </table>
              </div>
        </div>
</div>
</div>
 @endsection