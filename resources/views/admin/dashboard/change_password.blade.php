@extends('admin.layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Change Password</span>
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
                                <span class="caption-subject font-blue-madison bold uppercase">Change Password</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <form action="{{Route('admin-change-password')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group {{ $errors->has('current_password') ? ' has-error' : '' }}">
                                    <label class="control-label">Current Password</label>
                                    <div class="">
                                        <input type="password" class="form-control" placeholder="Current Password" name="current_password">
                                        @if ($errors->has('current_password'))
                                        <span class="help-block"> {{ $errors->first('current_password') }} </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label class="control-label">Password</label>
                                    <div class="">
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                        @if ($errors->has('password'))
                                        <span class="help-block"> {{ $errors->first('password') }} </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                                    <label class="control-label">Confirm Password</label>
                                    <div class="">
                                        <input type="password" name="confirm_password" class="form-control"  placeholder="Confirm Password">
                                        @if ($errors->has('confirm_password'))
                                        <span class="help-block"> {{ $errors->first('confirm_password') }} </span>
                                        @endif
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
</div>
@endsection
@section('plugin_css')
<link href="{{ URL::asset('themes/admin/assets/pages/css/profile.min.css') }}" rel="stylesheet" type="text/css" />
@endsection