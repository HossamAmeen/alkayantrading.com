<!DOCTYPE html>
<html lang="ar">
	<head>
        <title>{{$title}}</title>
        <!--		meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="description" content="شركة كيان لتوريد جميع مواد البناء (حديد - اسمنت - الرمل - الزلط السن بجميع مقاساته) وادارة وتشغيل اساطيل النقل البرى بالاضافه الى تشغيل وادارة محطات الخرسانه الجاهزه " >
        <meta name=”keywords” content="مواد البناء, المقاولات, محطات الخرسانه الجاهزه, اساطيل النقل البرى , تشطيبات" />

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('resources/assets/site/css/bootstrap.min.css')}}">


        <!--        our revolution slider-->
        <link rel="stylesheet" href="{{asset('resources/assets/site/css/settings.css')}}">
        <link rel="stylesheet" href="{{asset('resources/assets/site/css/extralayers.css')}}">

        <!--		owl slider-->
        <link rel="stylesheet" href="{{asset('resources/assets/site/css/swiper.min.css')}}">

        <!--		animate.css -->
        <link rel="stylesheet" href="{{asset('resources/assets/site/css/animate.css')}}">

        <!--		fonts -->
        <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">

        <!--		custom style-->
        <link rel="stylesheet" href="{{asset('resources/assets/site/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('resources/assets/sitecss/style-en.css')}}">
		
	</head>
	<body>
		<!-- navbar -->	
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
                  <a class="navbar-brand" href="index.html">
                      <img src="{{asset('resources/assets/site/images/logo.png')}}" alt="logo" class="logo">
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
            href= "{{url('en/')}}">Home</a></li>
           
					<li><a @if($title == 'شركة كيان - خدماتنا')
            class="page-scroll active"
            @else
            class="page-scroll"
            @endif
            href="{{url('en/services')}}">Services </a></li>
					<li><a @if($title == 'شركة كيان - الاسعار اليوميه')
            class="page-scroll active"
            @else
            class="page-scroll"
            @endif
           href="{{url('en/daily_price')}}">Daily Price</a></li>

          <li><a 
            @if($title == 'شركة كيان -  من نحن')
            class="page-scroll active"
            @else
            class="page-scroll"
            @endif
             href="{{url('en/about')}}">AboutUs</a></li>

					<li><a @if($title == 'شركة كيان -  انضم إلينا')
            class="page-scroll active"
            @else
            class="page-scroll"
            @endif
             href="{{url('en/join_us')}}">JoinUs</a></li>

					<li><a @if($title == 'شركة كيان - تواصل معانا')
            class="page-scroll active"
            @else
            class="page-scroll"
            @endif
             href="{{url('en/contact')}}">ContactUs</a></li>

					<li>
						<div class="dropdown">
						  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
							  lang
						  <span class="caret"></span></button>
						  <ul class="dropdown-menu">
                              <li><a href="{{url('changeLanguage/ar')}}">Arabic</a></li>

						  </ul>
						</div>
					</li>
			     </ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
        </nav>
        
        @yield('content')

        <footer>
            <div class="container text-center">
                <div class="content">
                    <img class="img-responsive logo wow pulse" data-wow-duration="3s" src="{{asset('resources/assets/site/images/Logo.png')}}" >
                    <div class="text-center socialMedia">
                        <a href="{{$pref->facebook}}" target="_blank" class="social hvr-grow wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a   href="{{$pref->twitter}}" target="_blank" class="social hvr-grow wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="{{$pref->instgram}}" target="_blank" class="social hvr-grow wow fadeIn" data-wow-duration="2s" data-wow-delay="1s">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a  href="{{$pref->linkedin}}" target="_blank" class="social hvr-grow wow fadeIn" data-wow-duration="2s" data-wow-delay="1.5s">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="copywrite" style="direction: ltr;">
                <p class="text-center">created by
                    <a href="{{url('en/')}}">
                        <img src="{{asset('resources/assets/site/images/zedy_logo.png')}}" width="70px" alt="zedy company">
                    </a>
                </p>
            </div>
        </footer>
        <!--		preload section -->
        <div id="loader-wrapper">
            <div id="loader"></div>
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>

        </div>
        <script src="{{asset('resources/assets/site/js/jquery-2.2.4.min.js')}}"></script>
        <script src="{{asset('resources/assets/site/js/bootstrap.min.js')}}"></script>

        <!--        our revolution slider-->
        <script src="{{asset('resources/assets/site/js/jquery.themepunch.tools.min.js')}}"></script>
        <script src="{{asset('resources/assets/site/js/jquery.themepunch.revolution.min.js')}}"></script>

        <!-- Revolution Slider -->
        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('.banner').revolution({
                    delay:9000,
                    startwidth: 1200,
                    startheight: 650,
                    startWithSlide: 0,

                    fullScreenAlignForce:"off",
                    autoHeight:"on",
                    minHeight:"off",

                    shuffle:"off",

                    onHoverStop:"on",

                    thumbWidth:100,
                    thumbHeight:50,
                    thumbAmount:3,

                    hideThumbsOnMobile:"off",
                    hideNavDelayOnMobile:1500,
                    hideBulletsOnMobile:"off",
                    hideArrowsOnMobile:"on",
                    hideThumbsUnderResoluition:0,

                    hideThumbs:0,
                    hideTimerBar:"off",

                    keyboardNavigation:"on",

                    navigationType:"bullet",
                    navigationArrows:"solo",
                    navigationStyle:"round",

                    navigationHAlign:"center",
                    navigationVAlign:"bottom",
                    navigationHOffset:30,
                    navigationVOffset:30,

                    soloArrowLeftHalign:"left",
                    soloArrowLeftValign:"center",
                    soloArrowLeftHOffset:20,
                    soloArrowLeftVOffset:0,

                    soloArrowRightHalign:"right",
                    soloArrowRightValign:"center",
                    soloArrowRightHOffset:20,
                    soloArrowRightVOffset:0,


                    touchenabled:"on",
                    swipe_velocity:"0.7",
                    swipe_max_touches:"1",
                    swipe_min_touches:"1",
                    drag_block_vertical:"false",

                    parallax:"mouse",
                    parallaxBgFreeze:"on",
                    parallaxLevels:[10,7,4,3,2,5,4,3,2,1],
                    parallaxDisableOnMobile:"off",

                    stopAtSlide:-1,
                    stopAfterLoops:-1,
                    hideCaptionAtLimit:0,
                    hideAllCaptionAtLilmit:0,
                    hideSliderAtLimit:0,

                    dottedOverlay:"none",

                    spinned:"spinner4",

                    fullWidth:"off",
                    forceFullWidth:"off",
                    fullScreen:"off",
                    fullScreenOffsetContainer:"#topheader-to-offset",
                    fullScreenOffset:"0px",

                    panZoomDisableOnMobile:"off",

                    simplifyAll:"off",

                    shadow:0

                });

            });
        </script>

        <!--		our swiper slider-->
        <script src="{{asset('resources/assets/site/js/swiper.min.js')}}"></script>
        <script>
            var swiper = new Swiper('.swiper-container', {
                spaceBetween: 30,
                centeredSlides: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        </script>

        <!--		wow.js-->
        <script src="{{asset('resources/assets/site/js/wow.min.js')}}"></script>
        <script>
            new WOW().init();
        </script>
        <!--		our preload icon-->
        <script tabindex="text/javescript">
            $(window).load(function() {
                $('body').addClass('loaded');
            });
        </script>
    </body>
</html>