<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- Title -->
        <title>Sci-Fi Cafe</title>

        <!-- Css -->
        <link rel="stylesheet" href="{{ URL::asset('themes/frontend/assets/css/owl.carousel.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('themes/frontend/assets/css/custom.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('themes/frontend/assets/css/responsive.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('themes/frontend/assets/css/font-awesome.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('themes/frontend/assets/css/animate.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('themes/frontend/assets/css/bootstrap.min.css') }}" />

        <!-- Font -->
        <link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet" />
        <!--<script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>-->
        @yield('css_file')
        @yield('css')
        <style>
            .errorJsSummary, .errorSummary {
                z-index: 999999999;
                padding: 10px;
                width: 100%;
                background: brown;
                position: fixed;
                color: #fff;
                text-align: center;
                top: 0px;
                left: 0px;
            }
            .success_msg, .successmsg {
                z-index: 999999999;
                padding: 10px;
                width: 100%;
                background: rgba(89,179,89,0.9);
                position: fixed;
                color: #fff;
                text-align: center;
                top: 0px;
                left: 0px;
            }
            .alert-cross {
                float: right;
                color: #f5f2f2;
                font-weight: bold;
            }
        </style>
        <script src="{{ URL::asset('themes/frontend/assets/js/jquery.js')}}"></script>
        <script>
            var assets_path = '<?php echo URL::asset('/'); ?>';
            var full_path = '<?php echo Route('/'); ?>';
            $.ajaxSetup({headers: {'csrftoken': '{{ csrf_token() }}'}});
        </script>
    </head>
    <!--/head-->
    <body>
        @include('frontend.layouts.header')
        @include('frontend.layouts.message')
        @yield('content')
        @include('frontend.layouts.footer')
        @yield('js_file')
        <script src="{{ URL::asset('themes/frontend/assets/custom/js/common.js')}}"></script>
        @yield('js')
        <script type="text/javascript" src="{{ URL::asset('themes/frontend/assets/js/owl.carousel.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('themes/frontend/assets/js/jquery.scrollTo.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('themes/frontend/assets/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript">
            var owl = $('.featured-slide');
            owl.owlCarousel({
                margin: 10,
                loop: true,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            });
        </script>
        <script type="text/javascript">
            var $ = jQuery;
            $(document).ready(function () {
                $('#playvideo').on('click', function (ev) {
                    $('#firstvideo')[0].play();
                    $('#firstvideo')[0].controls = true;
                    $("#playvideo").hide();
                });
                var lastScrollTop = 0;
                var lastScroll = 0;

                $(window).scroll(function (event) {

                    var st = $(this).scrollTop();
                    var scroll = $(window).scrollTop();
                    if (scroll == 0) {

                        $('.header-top').removeClass('sticky');
                    } else if (lastScroll - scroll > 0) {
                        $('.header-top').addClass('sticky');
                    }
                    if (st > lastScrollTop && st > 100) {
                        $('.header-top').fadeOut(0);
                    } else {
                        $('.header-top').fadeIn(0);
                    }
                    lastScrollTop = st;
                    lastScroll = scroll;
                });
            });
        </script>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                var $animation_elements = $('.animated');
                var $window = $(window);

                function check_if_in_view() {
                    var window_height = $window.height();
                    var window_top_position = $window.scrollTop();
                    var window_bottom_position = (window_top_position + window_height);

                    $.each($animation_elements, function () {
                        var $element = $(this);
                        var element_height = $element.outerHeight();
                        var element_top_position = $element.offset().top;
                        var element_bottom_position = (element_top_position + element_height);
    //                    console.log($element);
                        //check to see if this current container is within viewport
                        if ((element_bottom_position >= window_top_position) &&
                                (element_top_position <= window_bottom_position)) {
                            if ($element.hasClass('heading')) {
                                $element.addClass('zoomIn');
                            } else if ($element.hasClass('panel-r-l')) {
                                $element.addClass('bounceInLeft');
                            } else if ($element.hasClass('imgs-up')) {
                                $element.addClass('bounceInUp');
                            } else if ($element.hasClass('panel-r-r')) {
                                $element.addClass('bounceInRight');
                            }
                        } else {
                            if ($element.hasClass('heading')) {
                                $element.removeClass('zoomIn');
                            } else if ($element.hasClass('panel-r-l')) {
                                $element.removeClass('bounceInLeft');
                            } else if ($element.hasClass('panel-r-r')) {
                                $element.removeClass('bounceInRight');
                            }

                        }

                    });
                }
                $window.on('scroll resize', check_if_in_view);
                $window.trigger('scroll');
            });
        </script>
    </body>
</html>

