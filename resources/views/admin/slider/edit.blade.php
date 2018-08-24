@extends('admin.layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('slider')}}">Slider Management</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Edit</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Edit</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="{{Route('slider-edit',['id'=>$model->id])}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-body">
                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Title</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Title" name="title" value="{{ (old('title')!="") ? old('title') : $model->title }}"/>
                                @if ($errors->has('title'))
                                <span class="help-block"> {{ $errors->first('title') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('background_image') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Background image</label>
                            <div class="col-md-10">
                                <input type="file"  name="background_image"/>
                                <span class="help-block"> Image resolution must be with 16:9 ratio. </span>
                                @if ($errors->has('background_image'))
                                <span class="help-block"> {{ $errors->first('background_image') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Body</label>
                            <div class="col-md-10">
                                <textarea rows="5" class="form-control" placeholder="Description" name="description"  id="description">{{ (old('description')!="") ? old('description') : $model->description }}</textarea>
                                @if ($errors->has('description'))
                                <span class="help-block"> {{ $errors->first('description') }} </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green"> Submit</button>
                                <a href="{{Route('slider')}}" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection