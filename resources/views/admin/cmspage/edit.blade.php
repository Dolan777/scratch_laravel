@extends('admin.layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('cmspage')}}"> CMS Page Management</a>
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
                    <i class="fa fa-edit font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Edit</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="{{Route('cmspage-edit',['id'=>$model->id])}}" method="post" class="form-horizontal" enctype="multipart/form-data">
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
                        <div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Content</label>
                            <div class="col-md-10">
                                <textarea class="form-control my_editor" placeholder="Content" name="content" id="content">{{ (old('content')!="") ? old('content') : $model->content }}</textarea>
                                @if ($errors->has('content'))
                                <span class="help-block"> {{ $errors->first('content') }} </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">Submit</button>
                                <a href="{{Route('cmspage')}}" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="http://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.2/ckeditor.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.2/adapters/jquery.js"></script>
@endsection
@section('page_js')
<script>
$(document).ready(function () {
    $('textarea#content').ckeditor({
        height: "250px",
        toolbarStartupExpanded: true,
        width: "100%"
    });
});
</script>
@endsection