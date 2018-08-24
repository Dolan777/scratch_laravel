@extends('admin.layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Profile Settings</span>
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
                                <span class="caption-subject font-blue-madison bold uppercase">Profile Settings</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <form action="{{Route('admin-profile')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group {{ $errors->has('full_name') ? ' has-error' : '' }}">
                                    <label class="control-label">Name</label>
                                    <div>
                                        <input type="text" class="form-control" placeholder="Name" name="full_name" value="{{ (old('full_name')!="") ? old('full_name') : $model->full_name }}"/>
                                        @if ($errors->has('full_name'))
                                        <span class="help-block"> {{ $errors->first('full_name') }} </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="control-label">Email</label>
                                    <div class="">
                                        <input type="text" class="form-control" placeholder="Email" name="email" value="{{ (old('email')!="") ? old('email') : $model->email }}">
                                        @if ($errors->has('email'))
                                        <span class="help-block"> {{ $errors->first('email') }} </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <a href="{{Route('admin-dashboard')}}" class="btn btn-default">Cancel</a>
                                    <button type="submit" class="btn green pull-right">Save</button>
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