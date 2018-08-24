@extends('frontend.layouts.main')
@section('content')
<div class="contact-body">
    <div class="common-heading-inner" style="background: url({{ URL::asset('themes/frontend/assets/images/contact_top_banner_1.png')}});">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="text-center">
                        <img src="{{ URL::asset('themes/frontend/assets/images/contact_heading_img.png')}}" alt="" class="rounded img-responsive">
                        <h1>CONTACT US</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="map-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-no-pad">
                    <div class="tp-heading">
                        <h1>Location map</h1>
                    </div>
                    <div id='map'></div>
                </div>
            </div>
        </div>
    </section>
    <section class="contact_btm_area">
        <div class="container">
            <div class="bdr-cls">
                <div class="row">
                    <div class="col-md-5 col-sm-6">
                        <section class="left-part">
                            <div class="top-part">
                                <h2>Contact Details</h2>
                                <p>You can also enrol or book a trial lesson by contacting us in the following ways:</p>
                            </div>
                            <div class="bottom-part">
                                <div class="top-info-sec">
                                    <ul>
                                        <li>
                                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                                            <div class="address-bar-right">
                                                <p>{{get_settings_by_slug('site_location')}}</p>
                                            </div>
                                        </li>
                                        <li>
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                            <div class="address-bar-right">
                                                <p>{{get_settings_by_slug('site_phone')}}</p>
                                            </div>
                                        </li>
                                        <li>
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                            <div class="address-bar-right">
                                                <p> {{get_settings_by_slug('site_email')}}</p>
                                            </div>
                                        </li>
                                    </ul>
                                    <ol class="list-inline social-nav-1">
                                        <li><a href="{{get_settings_by_slug('facebook_url')}}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="{{get_settings_by_slug('twitter_url')}}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    </ol>
                                </div>
                            </div>
                        </section>  
                    </div>
                    <div class="col-md-6 col-md-offset-1 col-sm-6">
                        <section class="right-part">
                            <div class="top-part">
                                <h2>DROP US A LINE</h2>
                                <p>Please feel free to ask us any questions you may still have.</p>
                            </div>

                            <form class="form" role="form" method="post" id="contact_form" action="{{Route('contact')}}">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Your name" name="name" id="name" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">

                                            <input class="form-control" placeholder="Email address" type="text" name="email" id="email">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Subject" name="subject" id="subject" type="text">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group message-box">
                                            <textarea name="message" placeholder="Message" class="form-control frm-text-area" id="message" rows="6"></textarea>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="btn-rap text-left">
                                    <!--<a href="#" class="">Submit message</a>-->
                                    <button class="btn btn-all" type="submit">Submit message</button>
                                </div>
                            </form>


                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection

@section('css_file')
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.44.1/mapbox-gl.css' rel='stylesheet' />
@endsection
@section('js_file')

<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.44.1/mapbox-gl.js'></script>
@endsection
@section('js')
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoiZG9sYW4iLCJhIjoiY2pkdHg0ZWw5MzFlYzJycWh1NnEzZzhtbSJ9.RDU7i9noP850fhLhKQguLw';
var map = new mapboxgl.Map({
    container: 'map', // container id
    style: 'mapbox://styles/mapbox/dark-v9', //hosted style id
    center: [-77.38, 39], // starting position
    zoom: 3 // starting zoom
});
</script>
@endsection

