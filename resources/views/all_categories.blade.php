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
                  <th>Category ID</th>
                  <th>Category Name</th>
                  <th>Created Day</th>
                  <th>Modification Day</th>
                  <th>Action</th></tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                        <td>SYC10{{$category->id}}</td>
                        <td>{{$category->c_name}}</td>
                        <td>{{$category->updated_at}}</td>
                        <td>{{$category->created_at}}</td>
                        <td>
                            <a href="{{url('/editcategory/'.$category->id)}}">Modify</a> | 
                            <a href  data-toggle="modal" data-target="#deleterolemodel{{$category->id}}">Delete</a>
                            <!-- Trigger the modal with a button -->
                            <div class="modal fade bs-example-modal-lg" tabindex="-1" id="deleterolemodel{{$category->id}}" role="dialog" aria-hidden="true" style="display: none;">

                                    <div class="modal-dialog modal-lg">
                                            <div class="modal-content">


                                                    <div class="modal-body">
                                                            <div class="x_panel" style="">
                                                                    <div class="x_title">
                                                                        <h2>Removing System Product Category <small> Please be sure of your action towards this product category.</small></h2>

                                                                        <div class="clearfix"></div>
                                                                        </div>
                                                                        <div class="x_content">

                                                                            <div class="container">
                                                                                <div class="<col-md-12></col-md-12> col-xs-12">

                                                                                Are you sure you want to delete : {{$category->c_name}}?

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                    <div class="modal-footer" style="background-color:#2A3F54">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                        <a href="{{url('/deletecategory/'.$category->id)}}" class="btn btn-danger btn-flat">Yes</a>

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