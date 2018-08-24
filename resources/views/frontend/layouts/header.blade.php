<?php
$routeArray = app('request')->route()->getAction();
$controllerAction = class_basename($routeArray['controller']);
list($controller, $action) = explode('@', $controllerAction);
$header_class = '';
if (in_array($controller, ['SiteController']) && in_array($action, ['get_contact', 'faq', 'teacher', 'gift_card', 'page', 'reset_password'])) {
    $header_class = 'inner-header';
}
$sliders = \App\Model\Slider::where('status', '1')->get()->first();
?>
<div class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center mobile-view">
                    <div class="top-social">
                        <ul>
                            <li class="facebook"><a href="#"><i class="fa fa-facebook-square"></i> -</a></li>
                            <li class="twitter"><a href="#"><i class="fa fa-twitter-square"></i> -</a></li>
                            <li class="terms"><a href="#">Terms of Use</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2 col-5">
                    <div class="logo-section"><a href="#">
                            <!--<img src="{{ URL::asset('themes/frontend/assets/images/logo.png') }}" alt=""/></a>-->
                    </div>
                </div>
                <div class="col-sm-10 col-7">
                    <div class="top-right-section">
                        <div class="top-social">
                            <ul>
                                <li class="facebook"><a href="#"><i class="fa fa-facebook-square"></i> Facebook -</a></li>
                                <li class="twitter"><a href="#"><i class="fa fa-twitter-square"></i> Twitter -</a></li>
                                <li class="terms"><a href="#">Terms of Use</a></li>
                            </ul>
                        </div>
                        <div class="top-menu">
                            <nav class="navbar navbar-expand-md">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                                    <ul>
                                        <li class="active"><a href="#">Home</a></li>
                                        <li><a href="#"><i class="fa fa-user"></i> Login</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
