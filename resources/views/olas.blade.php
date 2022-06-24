@extends('layouts.wallet')

@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="row flex-row">
                <!-- Begin Facebook -->
                <div class="col-md-3">
                    <div class="widget widget-12 has-shadow">
                        <div class="widget-body">
                            <div class="media">
                                <div class="align-self-center ml-5 mr-5">
                                    <i class="ion-cash"></i>
                                </div>
                                <div class="media-body align-self-center">
                                    <div class="title text-facebook">Wallet</div>
                                    <div class="number">P</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Facebook -->
                <!-- Begin Twitter -->
                <div class="col-md-3">
                    <div class="widget widget-12 has-shadow">
                        <div class="widget-body">
                            <div class="media">
                                <div class="align-self-center ml-5 mr-5">
                                    <i class="ion-arrow-up-c"></i>
                                </div>
                                <div class="media-body align-self-center">
                                    <div class="title text-twitter">Sent</div>
                                    <div class="number">P</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Twitter -->
                <!-- Begin Linkedin -->
                <div class="col-md-3">
                    <div class="widget widget-12 has-shadow">
                        <div class="widget-body">
                            <div class="media">
                                <div class="align-self-center ml-5 mr-5">
                                    <i class="ion-arrow-down-c"></i>
                                </div>
                                <div class="media-body align-self-center">
                                    <div class="title text-linkedin">Received</div>
                                    <div class="number">P</diev>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- End Linkedin -->

                </div>

                <div class="col-md-3">
                    <div class="widget widget-12 has-shadow">
                        <div class="widget-body">
                            <div class="media">
                                <div class="align-self-center ml-5 mr-5">
                                    <i class="ion-arrow-down-c"></i>
                                </div>
                                <div class="media-body align-self-center">
                                    <div class="title text-linkedin">On Net</div>
                                    <div class="number">P</diev>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- End Linkedin -->

                </div>




            </div>






            <div class="container-fluid">

                <div class="box" style="margin-top:40px">
                    <div class="box-header">
                        <h3 >Wallet Realtime Transactions</h3>
                        <div class="btn-actions">
                            <button class="btn btn-secondary"></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>Trans ID</th>
                                    <th>Trans Mode</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Amount</th>
                                    <!--<th>Transfer Mode</th>-->
                                    <th>Trans Date</th>

                                </tr>

                                @foreach($wallerttransactions as $data)
                                    <tr>
                                        <td>{{$data->id }}</td>
                                        <td>
                                        @if($data->from == $borrower->mobile )
                                            <!--<div class="avatar avatar-xs">-->
                                                <!--	<img src="https://openclipart.org/image/90px/svg_to_png/277088/Female-Avatar-4.png" alt="">-->
                                                <!--</div>-->
                                                Outgoing
                                            @else
                                                Incoming
                                            @endif
                                        </td>
                                        <td>{{$data->sender }}</td>
                                        <td>{{$data->requester }}</td>
                                        <td>P{{$data->amount }}</td>

                                    <!--<td>{{$data->type}}</td>-->
                                        <td>{{$data->created_at}}</td>
                                    </tr>
                                @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>

                <!-- End Container -->


                <div class="box" style="margin-top:40px">
                    <div class="box-header">
                        <h3 >Wallet Voucher Transactions</h3>
                        <div class="btn-actions">
                            <button class="btn btn-secondary"></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>Trans ID</th>
                                    <th>Receiver</th>
                                    <th>Amount</th>
                                    <th>Voucher Number</th>
                                    <th>Voucher Pin</th>
                                    <th>Status</th>
                                    <th>Trans Date</th>

                                </tr>

                                @foreach($voucher_items as $data)
                                    <tr>
                                        <td>{{$data->id }}</td>
                                        <td>{{$data->receiver_id}}</td>
                                        <td>P{{$data->amount }}</td>
                                        <td>{{$data->voucher_number }}</td>
                                        <td>P{{$data->voucher_pin }}</td>

                                        <td>{{$data->status}}</td>
                                        <td>{{$data->created_at}}</td>
                                    </tr>
                                @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>

                <!-- End Container -->
            </div>
        </div>

    </main>
@endsection