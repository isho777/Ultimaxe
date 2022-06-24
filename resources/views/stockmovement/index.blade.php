@extends('layouts.app')

@section('content')


<div class="row">
    
    <div class="">
        <div class="x_panel" >
            <div class="x_title">
                    <h2>Stock Movement<small>Customer stock movement is listed in the below table</small></h2>
                    <div class="clearfix"></div>
            </div>
            <div class="x_content">
                   
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Product</th>
                          <th>Pack</th>
                          <th>Batch Code</th>
                          <th>Shelve Quantity</th>
                          <th>Picture</th>

                        </tr>
                      </thead>
                      <tbody>

                      {{--File::get(storage_path('app/marquee.json'));--}}

                        @foreach($Stockmovements as $stockinfo)
                            <tr>
                                <td>{{$stockinfo['id']}}</td>
                                <td>{{$stockinfo['product']}}</td>
                                <td>{{$stockinfo['pack']}}</td>
                                <td>{{$stockinfo['store_quantity']}}</td>
                                <td>{{$stockinfo['shelve_quantity']}}</td>
                                <td> <img src="{{$stockinfo['shelve_pic']}}"/></td>
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
