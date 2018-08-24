@extends('admin.layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('artists-list')}}">User</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Add Artist</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Add Artist</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('artists-add')}}" class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-body">
                        <div class="form-group {{ $errors->has('full_name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Artist Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Artist Name" name="full_name" value="{{ (old('full_name')!="") ? old('full_name') : '' }}"/>
                                @if ($errors->has('full_name'))
                                <span class="help-block"> {{ $errors->first('full_name') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Artist Image</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control" id="image" name="image">
                                @if ($errors->has('image'))
                                <span class="help-block"> {{ $errors->first('image') }} </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <a href="{{Route('artists-list')}}" class="btn btn-primary">Cancel</a>
                                <button type="submit" class="btn green">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection