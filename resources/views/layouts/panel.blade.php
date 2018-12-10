<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    @include('layouts.admin.masters.header')
    @yield('header')
</head>

<body >
<!--Navigation Top Bar Start-->
<nav class="navigation">
<div class="container-fluid">
<!--Logo text start-->
<div class="header-logo">
    <a href="/pref" title="">
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
        <a href="/admin/login">
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
<section id="left-navigation">
<!--Left navigation user details start-->

<!--Phone Navigation Menu icon start-->

<!--Left navigation start-->
    <ul class="mainNav">
        <li @if($title == 'بيانات الموقع') class="active"  @endif >
             <a href="/admin/pref">
               <i class="fa fa-bullhorn"></i> <span>بيانات الموقع</span>
            </a>
        </li>
        <li class="active">
            <a  href="/admin/user">
                <i class="fa fa-bar-chart-o"></i> <span>المستخدم</span>
            </a>
            <ul>
                <li>
                    <a  @if($title == 'اضافه مستخدم') class="active"  @endif href="/admin/user/create">اضافه مستخدم</a>
                </li>
                <li>
                    <a @if($title == 'عرض المستخدمين') class="active"  @endif  href="/admin/user">عرض المستخدمين</a>
                </li>
               
            </ul>
        </li>
        <li class="active">
            <a  href="/admin/service">
                <i class="fa fa-bar-chart-o"></i> <span>الخدمات</span>
            </a>
            <ul>
                <li>
                    <a  @if($title == 'اضافه خدمه') class="active"  @endif href="/admin/service/create">اضافه خدمه</a>
                </li>
                <li>
                    <a @if($title == 'عرض الخدمات') class="active"  @endif  href="/admin/service">عرض الخدمات</a>
                </li>
               
            </ul>
        </li>
        <li class="active">
                <a  href="/admin/category">
                    <i class="fa fa-bar-chart-o"></i> <span>الاقسام</span>
                </a>
                <ul>
                    <li>
                        <a  @if($title == 'اضافه قسم') class="active"  @endif href="/admin/category/create">اضافه قسم</a>
                    </li>
                    <li>
                        <a @if($title == 'عرض الاقسام') class="active"  @endif  href="/admin/category">عرض الاقسام</a>
                    </li>
                   
                </ul>
        </li>
        <li class="active">
                <a  href="/admin/product">
                    <i class="fa fa-bar-chart-o"></i> <span>المنتجات</span>
                </a>
                <ul>
                    <li>
                        <a  @if($title == 'اضافه منتج') class="active"  @endif href="/admin/product/create">اضافه منتج</a>
                    </li>
                    <li>
                        <a @if($title == 'عرض المنتجات') class="active"  @endif  href="/admin/product">عرض المنتجات</a>
                    </li>
                   
                </ul>
        </li>
        
        <li class="active">
                <a  href="/admin/show_prices">
                    <i class="fa fa-bar-chart-o"></i> <span>الاسعار</span>
                </a>

        </li>
        
    </ul>
<!--Left navigation end-->
</section>
</section>
<!--Left navigation section end-->

@yield('content')

@include('layouts.admin.masters.footer')
@yield('footer')