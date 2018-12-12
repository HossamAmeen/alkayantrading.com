<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    
    <meta name="author" content="">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Viewport metatags -->
    <meta name="HandheldFriendly" content="true" />
    <meta name="MobileOptimized" content="320" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- TODO: Add a favicon -->
    <link rel="shortcut icon" href="{{asset('resources/assets/admin/images/ico/fab.ico')}}">

<title>{{$title}}</title>

    <!--Page loading plugin Start -->
    <link rel="stylesheet" href="{{asset('resources/assets/admin/css/rtl-css/plugins/pace-rtl.css')}}">
    <script src="{{asset('resources/assets/admin/js/pace.min.js')}}"></script>
    <!--Page loading plugin End   -->

    <!-- Plugin Css Put Here -->
    <link href="{{asset('resources/assets/admin/css/bootstrap-rtl.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('resources/assets/admin/css/rtl-css/plugins/bootstrap-progressbar-3.1.1-rtl.css')}}">
    <link rel="stylesheet" href="{{asset('resources/assets/admin/css/rtl-css/plugins/jquery-jvectormap-rtl.css')}}">

    <!--AmaranJS Css Start-->
    <link href="{{asset('resources/assets/admin/css/rtl-css/plugins/amaranjs/jquery.amaran-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('resources/assets/admin/css/rtl-css/plugins/amaranjs/theme/all-themes-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('resources/assets/admin/css/rtl-css/plugins/amaranjs/theme/awesome-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('resources/assets/admin/css/rtl-css/plugins/amaranjs/theme/default-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('resources/assets/admin/css/rtl-css/plugins/amaranjs/theme/blur-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('resources/assets/admin/css/rtl-css/plugins/amaranjs/theme/user-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('resources/assets/admin/css/rtl-css/plugins/amaranjs/theme/rounded-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('resources/assets/admin/css/rtl-css/plugins/amaranjs/theme/readmore-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('resources/assets/admin/css/rtl-css/plugins/amaranjs/theme/metro-rtl.css')}}" rel="stylesheet">
    <!--AmaranJS Css End -->

    <!-- Plugin Css End -->
    <!-- Custom styles Style -->
    <link href="{{asset('resources/assets/admin/css/rtl-css/style-rtl.css')}}" rel="stylesheet">
    <!-- Custom styles Style End-->

    <!-- Responsive Style For-->
    <link href="{{asset('resources/assets/admin/css/rtl-css/responsive-rtl.css')}}" rel="stylesheet">
    <!-- Responsive Style For-->

    <!-- Custom styles for this template -->


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-screen">
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="login-box">
                    <div class="login-content">
                        <div class="login-user-icon">
                            <i class="glyphicon glyphicon-user"></i>

                        </div>
                        <h3>Identify Yourself</h3>
                        <div class="social-btn-login">
                            <ul>
                                <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-github"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-bitbucket"></i></a></li>
                            </ul>
                            <!--<button class="btn ls-dark-btn rounded"><i class="fa fa-facebook"></i></button>
                            <button class="btn ls-dark-btn rounded"><i class="fa fa-twitter"></i></button>
                            <button class="btn ls-dark-btn rounded"><i class="fa fa-linkedin"></i></button>
                            <button class="btn ls-dark-btn rounded"><i class="fa fa-google-plus"></i></button>
                            <button class="btn ls-dark-btn rounded"><i class="fa fa-github"></i></button>
                            <button class="btn ls-dark-btn rounded"><i class="fa fa-bitbucket"></i></button>-->
                        </div>
                    </div>

                    <div class="login-form">

                        <form action="{{url('admin/login')}}"  method="post">
                            {{csrf_field()}}
                            <div class="input-group ls-group-input">
                                <input class="form-control" type="email" value="asd@asd.asd" name="email"> 
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            </div>


                            <div class="input-group ls-group-input">
                                <input type="password" placeholder="Password" name="password"
                                       class="form-control" value="">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            </div>
                            <div class="input-group ls-group-input">
                                <input type="submit"  class="form-control" value="login">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            </div>

                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
</section>
<script type="text/javascript" src="{{asset('resources/assets/admin/js/color.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/assets/admin/js/lib/jquery-1.11.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/assets/admin/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/assets/admin/js/multipleAccordion.js')}}"></script>

<!--easing Library Script Start -->
<script src="{{asset('resources/assets/js/lib/jquery.easing.js')}}"></script>
<!--easing Library Script End -->

<!--Nano Scroll Script Start -->
<script src="{{asset('resources/assets/admin/js/jquery.nanoscroller.min.js')}}"></script>
<!--Nano Scroll Script End -->

<!--switchery Script Start -->
<script src="{{asset('resources/assets/js/switchery.min.js')}}"></script>
<!--switchery Script End -->

<!--bootstrap switch Button Script Start-->
<script src="assets/js/bootstrap-switch.js"></script>
<!--bootstrap switch Button Script End-->

<!--easypie Library Script Start -->
<script src="assets/js/jquery.easypiechart.min.js"></script>
<!--easypie Library Script Start -->

<!--bootstrap-progressbar Library script Start-->
<script src="assets/js/bootstrap-progressbar.min.js"></script>
<!--bootstrap-progressbar Library script End-->

<!--FLoat library Script Start -->
<script type="text/javascript" src="{{asset('resources/assets/js/chart/flot/jquery.flot.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/assets/js/chart/flot/jquery.flot.pie.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/assets/js/chart/flot/jquery.flot.resize.js')}}"></script>
<!--FLoat library Script End -->

<script type="text/javascript" src="{{asset('resources/assets/admin/js/pages/layout.js')}}"></script>
<!--Layout Script End -->



<script src="{{asset('resources/assets/admin/js/countUp.min.js')}}"></script>

<!-- skycons script start -->
<script src="{{asset('resources/assets/admin/js/skycons.js')}}"></script>
<!-- skycons script end   -->

<!--Vector map library start-->
<script src="{{asset('resources/assets/admin/js/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('resources/assets/admin/js/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!--Vector map library end-->

<!--AmaranJS library script Start -->
<script src="{{asset('resources/assets/admin/js/jquery.amaran.js')}}"></script>
<!--AmaranJS library script End   -->
<script src="{{asset('resources/assets/admin/js/pages/dashboard.js')}}"></script>
</body>
</html>