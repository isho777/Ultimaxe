@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="">
            <div class="x_panel" >
                <div class="x_title">
                    <h2>{{$username}} Device <small>{{$username}}'s device GPS fingerprint is shown in the below MAP</small></h2>
                    <div class="clearfix"></div>

                </div>

                <div class="x_content">
                    <div id="map"></div>
                    <script>

                        path = {!! json_encode($coordinates) !!};

                        var map = new GMaps({
                            el: '#map',
                            lat: path[0][0],
                            lng: path[0][1]
                        });

                        map.drawPolyline({
                            path: path,
                            strokeColor: '#131540',
                            strokeOpacity: 0.6,
                            strokeWeight: 6
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>


@endsection