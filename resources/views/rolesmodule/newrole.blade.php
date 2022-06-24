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
    
   <!-- header -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" >
            <div class="x_title">
                <h2>New System User Role <small> Please fill the below form fields with the approprite information.</small></h2>
            
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="container">
                <form action="{{url('/role/save')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="selected" id="selected" />
                    <div class="row">


                        <div class="col-sm-4">
                            User-Role Name
                            <div class="form-group">
                                <div class="input-group date" id="myDatepicker">
                                    <span class="input-group-addon">
                                    <span class="fa fa-cogs"></span>
                                    </span>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                        &nbsp;
                        <div class="form-group">
                                <div class="input-group date" id="datetimepicker7" align="right">
                                    <button type="submit"  style="width:200px" class="btn btn-success flat" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="By clicking the save button, the user role will be saved in the system.">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


            </div>

        </div>
    </div>
    <!-- end header -->
    <div class="">
        <div class="x_panel" >
            <div class="x_title">
                    <h2>System Module Listing <small>System modules are listed in the below table</small></h2>
                    <div class="clearfix"></div>
            </div>
            <div class="x_content">

            <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">Module</th>
                            <th class="column-title">ID </th>

                            <th class="column-title">Module Name </th>
                            <th class="column-title">System Module Modifiyer's </th>
                            <th class="column-title">Modification Date </th>
                            <th class="column-title">Creation Date </th>

                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach($roles as $role)
                            <tr class="even pointer">
                                <td class="a-center ">
                                <input type="checkbox" class="flat" name="table_records">
                                </td>
                                <td class=" ">APPSM10{{$role->id}}</td>
                                <td class=" ">{{$role->id}}</td>
                                <td class=" ">{{$role->mod_name}}</td>
                                <td class=" ">System Developer's</td>
                                <td class=" ">{{$role->created_at}}</td>
                                <td class=" ">{{$role->updated_at}}</td>
                            </tr>
                          @endforeach

                        </tbody>
                      </table>
                    </div>
							
            <!-- table here -->
            </div>
            
        </div>
    </div>
</div>

</div>

<script>
    

</script>
         
        
@endsection