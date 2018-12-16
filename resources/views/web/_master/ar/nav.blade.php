<nav id="mainNav" class="navbar navbar-default navbar-fixed-top"  data-spy="affix" data-offset-top="100">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('ar/')}}">

                <img src="{{asset('resources/assets/site/images/Logo.png')}}" alt="logo" class="logo">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a
                            @if($title == 'kayan trading company')
                            class="page-scroll active"
                            @else
                            class="page-scroll"
                            @endif
                            href= "{{url('ar/')}}">الرئيسيه</a></li>

                <li><a @if($title == 'شركة كيان - خدماتنا')
                       class="page-scroll active"
                       @else
                       class="page-scroll"
                       @endif
                       href="{{url('ar/services')}}">خدماتنا </a></li>
                <li><a @if($title == 'شركة كيان - الاسعار اليوميه')
                       class="page-scroll active"
                       @else
                       class="page-scroll"
                       @endif
                       href="{{url('ar/daily_price')}}">الاسعار اليوميه</a></li>

                <li><a
                            @if($title == 'شركة كيان -  من نحن')
                            class="page-scroll active"
                            @else
                            class="page-scroll"
                            @endif
                            href="{{url('ar/about')}}">من نحن</a></li>

                <li><a @if($title == 'شركة كيان -  انضم إلينا')
                       class="page-scroll active"
                       @else
                       class="page-scroll"
                       @endif
                       href="{{url('ar/join_us')}}">انضم إلينا</a></li>

                <li><a @if($title == 'شركة كيان - تواصل معانا')
                       class="page-scroll active"
                       @else
                       class="page-scroll"
                       @endif
                       href="{{url('ar/contact')}}">تواصل معانا</a></li>

                <li>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                            lang
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">

                            <li><a href="{{url('changeLanguage/en')}}" >English</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>