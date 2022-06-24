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