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
              <form action="{{url('approvedealsheet')}}" method="post">
                  {{ csrf_field() }}
                  <h2>Live Deal Sheet Information:<small>Below information is for live deal period from {{$deal_begining}} to {{$deal_ending}}</small></h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">

                  <div class="container">
  
                      <div class="row">


                          <div class="col-sm-4">
                              Customer Name: <small>Live deal sheet customer name.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="myDatepicker">
                                      <span class="input-group-addon">
                                      <span class="glyphicon glyphicon-user"></span>
                                      </span>
                                      <input disabled="disabled" type="text" class="form-control" value="{{$customerinformation->name}}" required>
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-4">
                              Physical Address: <small>Live deal sheet customer physical address.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="myDatepicker2">
                                      <span class="input-group-addon">
                                      <span class="glyphicon glyphicon-user"></span>
                                      </span>
                                      <input disabled="disabled" type="text" class="form-control" value="{{$customerinformation->p_adres}}" required>
                                  </div>
                              </div>
                          </div>
                          
                          <div class="col-sm-4">
                              Postal Address: <small>Live deal sheet postal address.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="myDatepicker3">
                                      <span class="input-group-addon">
                                      <span class="fa fa-envelope"></span>
                                      </span>
                                      <input disabled="disabled" type="email" class="form-control" value="{{$customerinformation->posta_adres}}" required>
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-4">
                              Location: <small>Live deal sheet loation.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="myDatepicker3">
                                      <span class="input-group-addon">
                                      <span class="fa fa-envelope"></span>
                                      </span>
                                      <input disabled="disabled" type="email" class="form-control" value="{{$customerinformation->location}}" required>
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-4">
                              Email Address: <small>Live deal sheet email address.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="myDatepicker3">
                                      <span class="input-group-addon">
                                      <span class="fa fa-envelope"></span>
                                      </span>
                                      <input disabled="disabled" type="email" class="form-control" value="{{$customerinformation->emai_adress}}" required>
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-4">
                              Telephone: <small>Live deal sheet telephone number.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="myDatepicker3">
                                      <span class="input-group-addon">
                                      <span class="fa fa-envelope"></span>
                                      </span>
                                      <input disabled="disabled" type="email" class="form-control" value="{{$customerinformation->tel}}" required>
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-4">
                            Deal Neg Name: <small>Customer Deal negotiator name.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="myDatepicker3">
                                      <span class="input-group-addon">
                                      <span class="fa fa-envelope"></span>
                                      </span>
                                      <input disabled="disabled" type="email" class="form-control" value="{{$deal->dealnegwith}}" required>
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-4">
                              Deal Neg Signature: <small>Customer Deal negotiator signature.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="datetimepicker7">
                                      <img src="data:image/Png;base64,{{$deal->customersignature}}" height="60%" width="60%" />
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-4">
                            Deal Neg Email: <small>Customer Deal negotiator email.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="myDatepicker3">
                                      <span class="input-group-addon">
                                      <span class="fa fa-envelope"></span>
                                      </span>
                                      <input disabled="disabled" type="email" class="form-control" value="{{$deal->email}}" required>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row">

                          <div class="col-sm-4">
                              Deal Neg Name: <small>Ultimex Deal negotiator name.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="myDatepicker3">
                                      <span class="input-group-addon">
                                      <span class="fa fa-envelope"></span>
                                      </span>
                                      <input disabled="disabled" type="email" class="form-control" value="{{$deal->dealnegby}}" required>
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-4">
                              Deal Neg Signature: <small>Ultimex Deal negotiator signature.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="datetimepicker7">
                                      <img src="data:image/Png;base64,{{$deal->dealnegsignatur}}" height="60%" width="60%" />
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-4">
                            Deal Neg Email: <small>Ultimex Deal negotiator email.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="myDatepicker3">
                                      <span class="input-group-addon">
                                      <span class="fa fa-envelope"></span>
                                      </span>
                                      <input disabled="disabled" type="email" class="form-control" value="{{$deal->negotiator_mail}}" required>
                                  </div>
                              </div>
                          </div>

                      </div>

                      <div class="row">

                      <div class="col-sm-4">
                            Deal Approved Email: <small>Ultimex this deal approver.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="myDatepicker3">
                                      <span class="input-group-addon">
                                      <span class="fa fa-envelope"></span>
                                      </span>
                                      <input disabled="disabled" type="email" class="form-control" value="{{$deal->dealaprovedby}}" required>
                                  </div>
                              </div>
                      </div>

                      <div class="col-sm-4">
                              Deal Approver Signature: <small>Ultimex deal approver signature.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="datetimepicker7">
                                      <img src="data:image/Png;base64,{{$deal->dealaproversign}}" height="60%" width="60%" />
                                  </div>
                              </div>
                          </div>

                      
                      
                      
                      <div class="col-sm-4">
                              Live Deal Sheet Number: <small>Live Deal Sheet number.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="datetimepicker7">
                                  <span class="input-group-addon">
                                      <span class="fa fa-barcode"></span>
                                      </span>
                                      <input disabled="disabled" type="email" class="form-control" value="LVDST10{{$deal->id}}" required>
                                  </div>
                              </div>
                          </div>
                      
                      </div>
                      <div class="row">
                      <div class="col-sm-4">
                              Deal Sheet Number: <small>Deal Sheet number.</small>
                              <div class="form-group">
                                  <div class="input-group date" id="datetimepicker7">
                                  <span class="input-group-addon">
                                      <span class="fa fa-barcode"></span>
                                      </span>
                                      <input disabled="disabled" type="email" class="form-control" value="CURDST10{{$deal->dealid}}" required>
                                  </div>
                              </div>
                          </div>
                      </div>

                        <div class="row">
        <div class="x_panel" >
            <div class="x_title">
                    <h2>Live Deal Products Price Listing:<small>Below information is for live deal period from {{$deal_begining}} to {{$deal_ending}}</small></h2>
                    <form action="{{url('/dealproducts')}}" method="post" style="align:right" id="forms" name="forms">
                       {{csrf_field()}}
                
             
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

                    


                  </form>


              </div>

          </div>
    </div>


</div>

</div>
 @endsection