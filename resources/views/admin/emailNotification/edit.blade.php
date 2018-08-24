@extends('admin.layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('emailNotification')}}">Email Notification</a>
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
                    <span class="caption-subject font-red-sunglo bold uppercase">Edit Email Notification</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="{{Route('emailNotification-edit',['id'=>$model->id])}}" method="post" class="form-horizontal">
                    {{csrf_field()}}
                    <div class="form-body">
                        <div class="form-group {{ $errors->has('subject') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Subject</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Subject" name="subject" value="{{ (old('subject')!="") ? old('subject') : $model->subject }}"/>
                                @if ($errors->has('subject'))
                                <span class="help-block"> {{ $errors->first('subject') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('about') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">About</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="About" name="about" value="{{ (old('about')!="") ? old('about') : $model->about }}"/>
                                @if ($errors->has('about'))
                                <span class="help-block"> {{ $errors->first('about') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Body</label>
                            <div class="col-md-10">
                                <textarea class="form-control" placeholder="Body" name="body"  id="body">{{ (old('body')!="") ? old('body') : $model->body }}</textarea>
                                @if ($errors->has('body'))
                                <span class="help-block"> {{ $errors->first('body') }} </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green"> Submit</button>
                                <a href="{{Route('emailNotification')}}" class="btn btn-primary">Cancel</a>
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
    $('textarea#body').ckeditor({
        height: "300px",
        toolbarStartupExpanded: true,
        width: "100%"
    });
});
</script>
@endsection