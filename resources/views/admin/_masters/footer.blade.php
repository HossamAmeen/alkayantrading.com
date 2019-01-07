<!--Layout Script start -->
<script type="text/javascript" src="{{asset('resources/assets/admin/js/color.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/assets/admin/js/lib/jquery-1.11.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/assets/admin/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/assets/admin/js/multipleAccordion.js')}}"></script>

<!--easing Library Script Start -->
<script src="{{asset('resources/assets/admin/js/lib/jquery.easing.js')}}"></script>
<!--easing Library Script End -->

<!--Nano Scroll Script Start -->
<script src="{{asset('resources/assets/admin/js/jquery.nanoscroller.min.js')}}"></script>
<!--Nano Scroll Script End -->

<!--switchery Script Start -->
<script src="{{asset('resources/assets/admin/js/switchery.min.js')}}"></script>
<!--switchery Script End -->

<!--bootstrap switch Button Script Start-->
<script src="{{asset('resources/assets/admin/js/bootstrap-switch.js')}}"></script>
<!--bootstrap switch Button Script End-->

<!--easypie Library Script Start -->
<script src="{{asset('resources/assets/admin/js/jquery.easypiechart.min.js')}}"></script>
<!--easypie Library Script Start -->

<!--bootstrap-progressbar Library script Start-->
<script src="{{asset('resources/assets/admin/js/bootstrap-progressbar.min.js')}}"></script>
<!--bootstrap-progressbar Library script End-->

<!--FLoat library Script Start -->
<script type="text/javascript" src="{{asset('resources/assets/admin/js/chart/flot/jquery.flot.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/assets/admin/js/chart/flot/jquery.flot.pie.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/assets/admin/js/chart/flot/jquery.flot.resize.js')}}"></script>
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

<script src="{{URL::asset('resources/assets/admin/js/bootbox.min.js')}}"></script>
<script type="text/javascript">
    $('.check').click(function(){
        $url = $(this).attr('href');
        bootbox.dialog({
            message: "هل أنت متأكد من أنك تريد القيام بهذه العملية؟",
            title: "تأكيد القيام بالعملية",
            buttons: {
                success: {
                    label: "نعم!",
                    className: "btn-success",
                    callback: function() {

                        if($url == undefined)
                            $('form').submit();
                        else{
                            console.log("should go to " + $url);
                            window.location = $url;

                        }
                    }
                },
                danger: {
                    label: "لا!",
                    className: "btn-danger",
                    callback: function() {
                        //Example.show("uh oh, look out!");
                    }
                },

            }
        });
        return false;
    });
    </script>