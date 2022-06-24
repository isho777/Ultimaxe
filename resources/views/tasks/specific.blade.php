@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>iTracker Employee Task Info</h2>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    <div class="col-md-9 col-sm-9 col-xs-12">

                        <ul class="stats-overview">
                            <li>
                                <span class="name"> Created Date </span>
                                <span class="value text-success"> {{$task->created_at}} </span>
                            </li>
                            <li>
                                <span class="name"> Expected Start Date </span>
                                <span class="value text-success"> {{$task->startdate}} </span>
                            </li>
                            <li class="hidden-phone">
                                <span class="name"> Expected End Date </span>
                                <span class="value text-success"> {{$task->end}} </span>
                            </li>
                        </ul>
                        <br>



                        <div>

                            <h4>{{$task->name}} - Task Activities</h4>

                            <!-- end of user messages -->
                            <ul class="messages">

                                @foreach($taskdescr as $info)
                                    <li>
                                        <img src="{{asset('images/user.png')}}" class="avatar" alt="Avatar">
                                        <div class="message_date">
                                            <h3 class="date text-info">{{Carbon\Carbon::parse($info->created_at)->format('d') }}</h3>
                                            <p class="month">{{Carbon\Carbon::parse($info->created_at)->format('M') }}</p>
                                        </div>
                                        <div class="message_wrapper">
                                            <h4 class="heading">{{$name}}</h4>
                                            <blockquote class="message">{{$info->comment}}</blockquote>
                                            <br>
                                            @if($info->pic != null)
                                            <p class="url">
                                                <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                                <a href="{{ asset('public')}}/{{$info->pic}}"><i class="fa fa-paperclip"></i> {{$info->pic}} </a>
                                            </p>
                                                @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- end of user messages -->


                        </div>


                    </div>

                    <!-- start project-detail sidebar -->
                    <div class="col-md-3 col-sm-3 col-xs-12">

                        <section class="panel">

                            <div class="x_title">
                                <h2>Project Description</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <h2 class="green"><i class="fa fa-tasks"></i> {{$task->name}}</h2>

                                <p>{{$task->description}}</p>
                                <br>

                                <div class="project_detail">

                                    <p class="title">Employee Name</p>
                                    <p>{{$name}}</p>
                                    {{--<p class="title">Project Leader</p>--}}
                                    {{--<p>Tony Chicken</p>--}}
                                </div>

                                <br>
                                <h5>Project files</h5>
                                <ul class="list-unstyled project_files">
                                    @foreach($taskdescr as $info)
                                        @if($info->pic != null)
                                        <li>
                                                    <a href="{{ asset('public')}}/{{$info->pic}}"><i class="fa fa-paperclip"></i> {{$info->pic}} </a>
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>

                        </section>

                    </div>
                    <!-- end project-detail sidebar -->

                </div>
            </div>
        </div>
    </div>
@endsection