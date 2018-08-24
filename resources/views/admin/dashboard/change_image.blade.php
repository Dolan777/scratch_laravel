@extends('admin.layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Change Image</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        @include('admin.dashboard.left')
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Change Image</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <form action="{{Route('user-change-image')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group text-center {{ $errors->has('image') ? ' has-error' : '' }}">
                                    <div class="">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                @if($model->image!="")
                                                <img src="{{URL::asset('public/uploads/user/'.$model->image)}}"/>
                                                @endIf
                                            </div>
                                            <div>
                                                <span class="btn red btn-outline btn-file">
                                                    <span class="fileinput-new"> Select image </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" name="image"/> </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                        @if ($errors->has('image'))
                                        <span class="help-block"> {{ $errors->first('image') }} </span>
                                        @endif
                                    </div>
                                </div>
                        </div>
                        <div class="box-footer">
                            <a href="{{Route('admin-dashboard')}}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn green pull-right"><i class="fa fa-check"></i> Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('plugin_js')
<script src="{{ URL::asset('themes/admin/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@endsection
@section('plugin_css')
<link href="{{ URL::asset('themes/admin/assets/pages/css/profile.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('themes/admin/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endsection