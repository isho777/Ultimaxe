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
                    <h2>Ultimex Deal Sheet Listing: <small>All deal sheet's are listed in the below table</small></h2>
                    <div class="clearfix"></div>
            </div>
        <div class="x_content">

               <table id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                  <tr>
                  <th>Deal Period Number</th>
                  <th>Beginning Date</th>
                  <th>Ending Date</th>
                  <th>Created Date</th>
                  <th>Status</th>
                  <th>Action</th></tr>
                </thead>
                <tbody>
                @foreach ($dealperiods as $all_deal)
                <tr>
                    <td>CURDST10{{$all_deal->id}}</td>
                    <td>{{$all_deal->begining}}</td>
                    <td>{{$all_deal->end}}</td>
                    <td>{{date_format($all_deal->created_at,"Y-m-d")}}</td>
                    <td>
                      @if($all_deal->active == 1)
                          <span class="label label-success">Active&nbsp; </span>
                      @endif

                      @if($all_deal->active == 0)
                        <a href="{{url('updatestatus/'.$all_deal->id)}}">
                            <span class="label label-danger">Not Active</span>
                        </a>
                      @endif
                    </td>
                    <td>
                        <a href="{{url('/getdealperiod/'.$all_deal->id)}}">View Deal Sheet</a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
              
              </table>
            </div>
            </div>
</div>

              @endsection