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
    
    @if(isset($newpack))
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" >
            <div class="x_title">
                <h2>New System Pack <small> Please fill the below form fields with the approprite information.</small></h2>
            
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="container">
                <form action="{{url('pack/save')}}" method="post">
                {{ csrf_field() }}
                    <div class="row">


                        <div class="col-sm-4">
                            Pack Size
                            <div class="form-group">
                                <div class="input-group date" id="myDatepicker">
                                    <span class="input-group-addon">
                                    <span class="fa fa-barcode"></span>
                                    </span>
                                    <input type="text" class="form-control" name="packsize" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4"></div>
                        
                        <div class="col-sm-4"></div>

                        <div class="col-sm-4">
                            Pack Weight Unit: <small>For example Kg</small>
                            <div class="form-group">
                                <div class="input-group date" id="datetimepicker7">
                                    <span class="input-group-addon">
                                            <span class="fa fa-question"></span>
                                    </span>
                                    <input type="text" class="form-control" name="weightunit" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                        &nbsp;
                        <div class="form-group">
                                <div class="input-group date" id="datetimepicker7" >
                                    <button type="submit" style="width:200px; align:right" class="btn btn-success flat" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="By clicking the save button, the system product pack will be saved in the system.">Save Pack</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


            </div>

        </div>
    </div>
    @endif
    <div class="">
        <div class="x_panel" >
            <div class="x_title">
                    <h2>System Product Pack Listing <small>System product pack's are listed in the below table</small></h2>
                    <div class="clearfix"></div>
            </div>
            <div class="x_content">
                   
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Pack ID</th>
                          <th>Pack Size</th>
                          <th>Pack Weight</th>
                          <th>Created Date</th>
                          <th>Modification Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                          @foreach($packs as $pack)
                        <tr>
                          <td>{{$pack->id}}</td>
                          <td>{{$pack->packsize}}</td>
                          <td>{{$pack->weightunit}}</td>
                          <td>{{$pack->updated_at}}</td>
                          <td>{{$pack->created_at}}</td>
                          <td>
                                <div class="modal fade bs-example-modal-lg" tabindex="-1" id="deleterolemodel{{$pack->id}}" role="dialog" aria-hidden="true" style="display: none;">

                                    <div class="modal-dialog modal-lg">
                                            <div class="modal-content">

                                                <form action="{{url('/pack/remove')}}" method="post">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="id" value="{{$pack->id}}"/>
                                                    <div class="modal-body">
                                                            <div class="x_panel" style="">
                                                                    <div class="x_title">
                                                                        <h2>Removing System Pack <small> Please be sure of your action towards this product pack.</small></h2>

                                                                        <div class="clearfix"></div>
                                                                        </div>
                                                                        <div class="x_content">

                                                                            <div class="container">
                                                                                <div class="<col-md-12></col-md-12> col-xs-12">

                                                                                Are you sure you want to delete : {{$pack->packsize.''.$pack->weightunit}}?

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                    <div class="modal-footer" style="background-color:#2A3F54">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                        <button type="submit" class="btn btn-danger">Yes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade bs-example-modal-lg" tabindex="-1" id="devecemodel{{$pack->id}}" role="dialog" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{url('pack/update')}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{$pack->id}}"/>
                                                <div class="modal-body">
                                                        <div class="x_panel" style="">
                                                                <div class="x_title">
                                                                    <h2>Modifying System Product Pack <small> Please fill in the information of a new role.</small></h2>

                                                                    <div class="clearfix"></div>
                                                                    </div>
                                                                    <div class="x_content">

                                                                        <div class="container">
                                                                            
                                                                            <div class="col-sm-5">
                                                                                System Pack Size
                                                                                <div class="form-group">
                                                                                    <div class="input-group date" id="myDatepicker">
                                                                                        <span class="input-group-addon">
                                                                                        <span class="fa fa-barcode"></span>
                                                                                        </span>
                                                                                        <input type="text" class="form-control" name="packsize" style="width:250px" value="{{$pack->packsize}}" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-2"></div>
                                                                                
                                                                            <div class="col-sm-2"></div>

                                                                            <div class="col-sm-5">
                                                                                    Pack Weight Unit: <small>For example Kg</small>
                                                                                    <div class="form-group">
                                                                                        <div class="input-group date" id="datetimepicker7">
                                                                                            <span class="input-group-addon">
                                                                                                    <span class="fa fa-question"></span>
                                                                                            </span>
                                                                                            <input type="text" style="width:250px" class="form-control" name="weightunit" value="{{$pack->weightunit}}" required>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                <div class="modal-footer" style="background-color:#2A3F54">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <a href  data-toggle="modal" data-target="#devecemodel{{$pack->id}}" >Modify</a> | 
                                <a href  data-toggle="modal" data-target="#deleterolemodel{{$pack->id}}" >Delete Pack</a> 
                          </td>
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