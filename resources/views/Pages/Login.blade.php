<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>CPS - Admin Login</title>
    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/toastr/toastr.min.css') }}" rel="stylesheet"> 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
@if(Session::has('admin_loggedin'))
    <script>
        window.location = "/"
    </script>
@endif
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url(assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box row">
                <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(assets/images/la-licenciatura.png);
                background-color: #FFF;
                background-size: 70%;
                background-repeat: no-repeat;
                border-right: 1px solid #dddcde;">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    <div class="p-3">
                        <div class="text-center">
                            <img src="assets/images/logo-icon.png" alt="wrapkit">
                        </div>
                        <h2 class="mt-3 text-center">Admin Login</h2> 
                        <form class="mt-4" method="POST" action="" id="loginForm">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="ad_username">Username</label>
                                        <input class="form-control" id="ad_username" type="text" placeholder="Username">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="ad_password">Password</label>
                                        <input class="form-control" id="ad_password" type="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-block btn-success">Login</button>
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/axios.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/toastr/toastr.min.js') }}"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
 
<script>
   toastr.options = {
    "progressBar": true,
    }
    $(".preloader ").fadeOut();
    
    $('#loginForm').on('submit',function(e){
        e.preventDefault();

        var ad_username=  $('#ad_username').val();
        var ad_password=  $('#ad_password').val();

        if(ad_username.length==0){
            toastr.error('Username is Required!');
        }
        else if(ad_password.length==0){
            toastr.error('Password is Required!');
        }
        else{
            $('#loginBtn').html('Login   <span class="loader loader-primary"></span>');
            axios.post('/api-on-login',{
                username:ad_username,
                password:ad_password
            })
            .then(function(response){
                if(response.status==200){
                    $('#loginBtn').html('Login');
                    if(response.data==1){
                        toastr.success('Login Success!');
                        window.location.href='/';
                    }else{
                        toastr.error('Username or Password is Wrong!');
                    }
                }else{
                    toastr.error('Something went wrong!');
                }
            })
            .catch(function (error) {
                toastr.error('Something went wrong!');
            })
        }

    });

  </script>
</body>

</html>