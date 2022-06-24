@extends('layouts.app')

@section('content')
@if(isset($sucess))
<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> Alert!</h5>
                  {{$sucess}}
                </div>
@endif

@if(isset($error))
<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-ban"></i> Alert!</h5>
                  {{$error}}
                </div>
@endif

<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" >
            <div class="x_title">
                <h2>New System Product <small> Please fill the below form fields with the approprite information.</small></h2>
            
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="container">
                <form action="{{url('/saveproduct')}}" method="post">
                {{ csrf_field() }}
                    <div class="row">


                        <div class="col-sm-4">
                            Product Serial Number
                            <div class="form-group">
                                <div class="input-group date" id="myDatepicker" >
                                    <span class="input-group-addon">
                                    <span class="fa fa-barcode"></span>
                                    </span>
                                    <input type="text" class="form-control" name="pserial" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            Product Name
                            <div class="form-group">
                                <div class="input-group date" id="myDatepicker2">
                                    <span class="input-group-addon">
                                    <span class="fa fa-quote-left"></span>
                                    </span>
                                    <input type="text" class="form-control" name="pname" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-4">
                            Product Pack: <small>Please select from the drop down list.</small>
                            <div class="form-group">
                                <div class="input-group date" id="myDatepicker3">
                                    <span class="input-group-addon">
                                    <span class="fa fa-gift"></span>
                                    </span>
                                    <select class="form-control" name="pack">
                                      @foreach($packs as $pack)
                                          <option value="{{$pack->id}}">{{$pack->packsize.''.$pack->weightunit}}</option>
                                          @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            Product Category: <small>Please select from the drop down list.</small>
                            <div class="form-group">
                                <div class="input-group date" id="datetimepicker7">
                                    <span class="input-group-addon">
                                            <span class="fa fa-question-circle"></span>
                                    </span>
                                    <select class="form-control" name="cat_id">
                                      @foreach($categories as $category)
                                          <option value="{{$category->id}}">{{$category->c_name}}</option>
                                          @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                        &nbsp;
                        <div class="form-group">
                                <div class="input-group date" id="datetimepicker7" align="right">
                                    <button type="submit" style="width:200px" class="btn btn-success flat" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="By clicking the save button, the product will be saved in the system.">Save product</button>
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