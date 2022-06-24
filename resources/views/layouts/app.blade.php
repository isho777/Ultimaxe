<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Ultimaxe iTracker</title>

    <!-- Bootstrap -->
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
    
	
    <!-- bootstrap-progressbar -->
    <link href="{{ asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
        <!-- Datatables -->
    <link href="{{ asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('build/css/custom.min.css')}}" rel="stylesheet">

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQn_5Z3EDDQyDSOXyZzz40EHo814c31Fg"></script>
    <script src="{{ asset('googlemap/gmaps.js')}}"></script>
    <style type="text/css">
      #map {
        width: 100%;
        height: 500px;
      }
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{url('home')}}" class="site_title"><i class="fa fa-paw"></i> <span>iTRACKER</span></a>
            </div>

            <div class="clearfix"></div>
            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                @if(Auth::user()->status == 1)
                  <ul class="nav side-menu">

                  @foreach(Auth::user()->usermodules(Auth::user()->role) as $module)
                    @if($module->module_id == 6)
                      <li><a><i class="fa fa-users"></i> System Users <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{url('view/newuser')}}">New System User</a></li>
                          <li><a href="{{url('view/list')}}">System Users Listing</a></li>

                        </ul>
                      </li>

                        <li><a><i class="fa fa-calendar"></i> Employee Tasks <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li><a href="{{url('/new/task')}}">New Employee Task</a></li>
                            <li><a href="{{url('/list/task')}}">Employee Task Listing</a></li>

                          </ul>
                        </li>
                    @endif

                    @if($module->module_id == 7)
                      <li><a><i class="fa fa-cogs"></i> Roles Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/view/newrole')}}">New System Role</a></li>
                      <li><a href="{{url('/view/rolelisting')}}">System Roles Listing</a></li>
                    </ul>
                  </li>
                    @endif
                      @if($module->module_id == 8)
                      <li><a><i class="fa fa-keyboard-o"></i> Device Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/devices/new')}}">New Device</a></li>
                      <li><a href="{{url('devices/list')}}">Devices Listing</a></li>
                    </ul>
                  </li>
                      @endif

                      @if($module->module_id == 9)
                        <li><a><i class="fa fa-barcode"></i>Ultimex Products <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li>
                          <a>Pack Management<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu" style="display: block;">
                            <li class="sub_menu"><a href="{{url('pack/new')}}">New Pack</a>
                            </li>
                            <li><a href="{{url('pack/list')}}">Pack List</a>
                            </li>
                          
                          </ul>
                        </li>
                      <li>
                        <a>Category Management<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: block;">
                            <li class="sub_menu"><a href="{{url('newcategory')}}">New Category</a>
                            </li>
                            <li><a href="{{url('allcategory')}}">Category Listing</a>
                            </li>
                          
                          </ul>
                      
                      </li>
                      <li><a >Products Management<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: block;">
                            <li class="sub_menu"><a href="{{url('newproduct')}}">New Product</a>
                            </li>
                            <li><a href="{{url('allproduct')}}">Product Listing</a>
                            </li>
                          
                          </ul>
                      </li>
                    </ul>
                  </li>
                      @endif
                      @if($module->module_id == 10)
                        <li><a><i class="fa fa-smile-o"></i>Ultimex Customers <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('customers/new')}}">New Customer</a></li>
                      <li><a href="{{url('customers/all')}}">Customer's Listing</a></li>
                    </ul>
                  </li>
                      @endif
                      @if($module->module_id == 11)
                        <li><a><i class="fa fa-tablet"></i>Active Deal Sheet <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('newdealperiod')}}">New Deal Sheet</a></li>
                      <li><a href="{{url('alldealperiod')}}">Show Deal Sheet</a></li>
                    </ul>
                  </li>
                      @endif
                      @if($module->module_id == 12)
                        <li><a><i class="fa fa-plug"></i>Live Deal Sheet <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('livedealsheet')}}">Show Live Deal Sheet</a></li>
                    </ul>
                  </li>
                      @endif
                      @if($module->module_id == 13)
                        <li><a><i class="fa fa-cc-visa"></i> Live Deal Sheet Quote <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('getorders')}}">Quote Listing</a></li>
                      <!-- <li><a href="fixed_footer.html">Find Quote By Deal Sheet</a></li>
                      <li><a href="fixed_footer.html">Find Quote By Quote Number</a></li> -->

                    </ul>
                  </li>
                      @endif
                      @if($module->module_id == 11)
                        <li><a><i class="fa fa-tablet"></i>Marketing <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li><a href="{{url('stockmovements')}}">Stock Onhand</a></li>
                            <li><a href="{{url('alldealperiod')}}">Show Deal Sheet</a></li>
                          </ul>
                        </li>
                      @endif
                    @endforeach
                </ul>
                @endif

              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle" style="width: 320px;">
                <a ><i class="fa fa-clock-o"></i></a>
                  <div align="center" id="time" style="font-size: 12px; margin-top:-23px; margin-left:-170px "></div>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('images/user.png')}}" alt="">{{ Auth::user()->name .' '. Auth::user()->lastname }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li>
                      {{--<a href="login.html"> Log Out</a></li>--}}
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                      <i class="fa fa-sign-out pull-right"></i>Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                  </ul>
                </li>

                {{--<li role="presentation" class="dropdown">--}}
                  {{--<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">--}}
                    {{--<i class="fa fa-envelope-o"></i>--}}
                    {{--<span class="badge bg-green">6</span>--}}
                  {{--</a>--}}
                  {{--<ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">--}}
                    {{--<li>--}}
                      {{--<a>--}}
                        {{--<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>--}}
                        {{--<span>--}}
                          {{--<span>John Smith</span>--}}
                          {{--<span class="time">3 mins ago</span>--}}
                        {{--</span>--}}
                        {{--<span class="message">--}}
                          {{--Film festivals used to be do-or-die moments for movie makers. They were where...--}}
                        {{--</span>--}}
                      {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                      {{--<a>--}}
                        {{--<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>--}}
                        {{--<span>--}}
                          {{--<span>John Smith</span>--}}
                          {{--<span class="time">3 mins ago</span>--}}
                        {{--</span>--}}
                        {{--<span class="message">--}}
                          {{--Film festivals used to be do-or-die moments for movie makers. They were where...--}}
                        {{--</span>--}}
                      {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                      {{--<a>--}}
                        {{--<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>--}}
                        {{--<span>--}}
                          {{--<span>John Smith</span>--}}
                          {{--<span class="time">3 mins ago</span>--}}
                        {{--</span>--}}
                        {{--<span class="message">--}}
                          {{--Film festivals used to be do-or-die moments for movie makers. They were where...--}}
                        {{--</span>--}}
                      {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                      {{--<a>--}}
                        {{--<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>--}}
                        {{--<span>--}}
                          {{--<span>John Smith</span>--}}
                          {{--<span class="time">3 mins ago</span>--}}
                        {{--</span>--}}
                        {{--<span class="message">--}}
                          {{--Film festivals used to be do-or-die moments for movie makers. They were where...--}}
                        {{--</span>--}}
                      {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                      {{--<div class="text-center">--}}
                        {{--<a>--}}
                          {{--<strong>See All Alerts</strong>--}}
                          {{--<i class="fa fa-angle-right"></i>--}}
                        {{--</a>--}}
                      {{--</div>--}}
                    {{--</li>--}}
                  {{--</ul>--}}
                {{--</li>--}}
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            @yield('content')
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
          Ultimex ITracker by Enterprise Cloud Application Systems
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{ asset('vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{ asset('vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js')}} -->
    <script src="{{ asset('vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{ asset('vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{ asset('vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{ asset('vendors/skycons/skycons.js')}}"></script>
    <!-- Flot -->
    <script src="{{ asset('vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{ asset('vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{ asset('vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{ asset('vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{ asset('vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{ asset('vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{ asset('vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{ asset('vendors/DateJS/build/date.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{ asset('vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{ asset('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    
    
        <!-- Datatables -->
        <script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{ asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{ asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{ asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{ asset('vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{ asset('vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{ asset('vendors/pdfmake/build/vfs_fonts.js')}}"></script>

<!-- Custom Theme Scripts -->
    <script src="{{ asset('build/js/custom.js')}}"></script>

    <script type="text/javascript">
        function showTime() {
            var date = new Date(),
                utc = new Date(Date.UTC(
                    date.getFullYear(),
                    date.getMonth(),
                    date.getDate(),
                    date.getHours(),
                    date.getMinutes(),
                    date.getSeconds()
                ));

            document.getElementById('time').innerHTML = utc.toLocaleTimeString();
        }
        setInterval(showTime, 1000);
    </script>
	
  </body>
</html>
