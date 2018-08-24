@extends('admin.layouts.main')
@section('content')
<div class="page-head">
    <div class="page-title">
        <h1>Dashboard
            <small>dashboard & statistics</small>
        </h1>
    </div>
</div>
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Dashboard</span>
    </li>
</ul>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 bordered">
            <div class="display">
                <div class="number">
                    <h3 class="font-green-sharp">
                        <span data-counter="counterup" data-value="{{$total_artist}}">0</span>
                    </h3>
                    <small>Total Artist</small>
                </div>
                <div class="icon">
                    <i class="icon-pie-chart"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 bordered">
            <div class="display">
                <div class="number">
                    <h3 class="font-green-sharp">
                        <span data-counter="counterup" data-value="{{$total_customer}}">0</span>
                    </h3>
                    <small>Total Customer</small>
                </div>
                <div class="icon">
                    <i class="icon-pie-chart"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 bordered">
            <div class="display">
                <div class="number">
                    <h3 class="font-red-haze">
                        <span data-counter="counterup" data-value="0">0</span>
                    </h3>
                    <small>Total Alley</small>
                </div>
                <div class="icon">
                    <i class="icon-like"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 bordered">
            <div class="display">
                <div class="number">
                    <h3 class="font-blue-sharp">
                        <span data-counter="counterup" data-value="0"></span>
                    </h3>
                    <small>Total Events</small>
                </div>
                <div class="icon">
                    <i class="icon-basket"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
@endsection
@section('plugin_css')
<link href="{{ URL::asset('themes/admin/assets/global/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('plugin_js')
<script src="{{ URL::asset('themes/admin/assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('themes/admin/assets/global/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('themes/admin/assets/global/plugins/morris/raphael-min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('themes/admin/assets/global/plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('themes/admin/assets/global/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('themes/admin/assets/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('themes/admin/assets/global/plugins/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('themes/admin/assets/global/plugins/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script>
@endsection
@section('javascript')
<script src="{{ URL::asset('themes/admin/assets/pages/scripts/dashboard.min.js') }}" type="text/javascript"></script>
@endsection