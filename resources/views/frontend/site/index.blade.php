@extends('frontend.layouts.main')
@section('content')
<p>Welcome to laravel</p>
@endsection
@section('js_file')    
<script src="{{ URL::asset('themes/frontend/assets/js/jquery.isotope.min.js') }}"></script>
<script src="{{ URL::asset('themes/frontend/assets/custom/js/dashboard.js') }}"></script>
@endsection
