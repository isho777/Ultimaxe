<html lang="en"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>iTRACKER | </title>

    <!-- Bootstrap -->
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('build/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">

      
        <div class="animate form login_form">
          <section class="login_content">
            <form action="{{ route('login') }}" method="post">
              {{ csrf_field() }}
              <h1>iTRACKER</h1>
              <div>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required="">
              </div>
              <div>
                <input  type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
              </div>
              <div>
                <button type="submit" class="btn btn-default submit" href="index.html">Log in</button>
                <a class="reset_pass" href="#signup">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
               

                <div class="clearfix"></div>
                <br>

                <div>
                  <h1><i class="fa fa-paw"></i> Ultimaxe iTRACKER</h1>
                  <p>©{{date('Y')}} All Rights Reserved. Ultimex! Good quality food brands. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Password Recovery</h1>
            
              <div>
                <input type="email" class="form-control" placeholder="Email" required="">
              </div>
           
              <div>
              <button type="submit" class="btn btn-default submit" href="">Submit</button>
                <p class="reset_pass">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
               

                <div class="clearfix"></div>
                <div>
                <h1><i class="fa fa-paw"></i> Ultimaxe iTRACKER</h1>
                  <p>©{{date('Y')}} All Rights Reserved. Ultimex! Good quality food brands. Privacy and Terms</p>

                                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  

</body></html>