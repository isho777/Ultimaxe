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
                <h2>Updating ({{$modulename}}) Role Module:<small> </small></h2>
            <form action="{{url('role/update')}}" method="post" style="align:right">
                {{csrf_field()}}
                
                <button type="submit" id="submit" style="width:200px;" class="btn btn-success flat" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="By clicking the update module button, the user role module will be updated in the system.">Update Role Modules</button>
                <input type="hidden" id="selected" name="selected"/>
                <input type="hidden" id="roleid" name="roleid" value="{{$roleid}}"/>
                <input type="hidden" id="modulename" name="modulename" value="{{$modulename}}"/>
                
            </form>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="container">
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
                        @foreach($modules as $module)
                           

                                <tr class="even pointer  @foreach($rolemodules as $rolemodule)
                                            @if($module->id == $rolemodule->module_id)
                                                selected
                                            @endif
                                        @endforeach">
                                        <td class="a-center ">
                                        <input type="checkbox" class="flat" name="table_records" 
                                        @foreach($rolemodules as $rolemodule)
                                            @if($module->id == $rolemodule->module_id)
                                                checked
                                            @endif

                                        @endforeach
                                        >

                                        </td>
                                        <td class=" ">APPSM10{{$module->id}}</td>
                                        <td class=" ">{{$module->id}}</td>
                                        <td class=" ">{{$module->mod_name}}</td>
                                        <td class=" ">System Developer's</td>
                                        <td class=" ">{{$module->created_at}}</td>
                                        <td class=" ">{{$module->updated_at}}</td>
                                </tr>
                          @endforeach

                        </tbody>
                      </table>
</div>


                </div>

        </div>
    </div>
    <!-- end header -->

</div>

</div>
         
        
@endsection