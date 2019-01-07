<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
@include('admin._masters.header')
    @yield('header')
</head>

<body >
<!--Navigation Top Bar Start-->
<nav class="navigation">
    <div class="container-fluid">
        <!--Logo text start-->
        <div class="header-logo">
            <a target="_blank" href="{{url('/')}}" title="">
                <h1>kayan</h1>
            </a>
        </div>
        <!--Logo text End-->
        <div class="top-navigation">
            <!--Collapse navigation menu icon start -->
            <div class="menu-control hidden-xs">
                <a href="javascript:void(0)">
                    <i class="fa fa-bars"></i>
                </a>
            </div>

            <!--Collapse navigation menu icon end -->
            <!--Top Navigation Start-->

            <ul>
                <li>
                    <a href="{{url('admin/logout')}}">
                        <i class="fa fa-power-off"></i>
                    </a>
                </li>

            </ul>
            <!--Top Navigation End-->
        </div>
    </div>
</nav>
<!--Navigation Top Bar End-->
<section id="main-container">

    <!--Left navigation section start-->
    @include('admin._masters.left-navigation')
    <!--Left navigation section end-->

@yield('content')
</section>


@include('admin._masters.footer')
@yield('footer')
</body>
</html>