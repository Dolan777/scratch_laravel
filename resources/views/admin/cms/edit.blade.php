@extends('admin.layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('cms')}}">CMS Management</a>
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
                <form action="{{Route('cms-edit',['id'=>$model->id])}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-body">
                        <div class="form-group {{ $errors->has('page_name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Page Name</label>
                            <div class="col-md-10">
                                <input readonly="true" type="text" class="form-control" placeholder="Page Name" value="{{ (old('page_name')!="") ? old('page_name') : $model->page_name }}"/>
                                @if ($errors->has('page_name'))
                                <span class="help-block"> {{ $errors->first('page_name') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('section_name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Section Name</label>
                            <div class="col-md-10">
                                <input readonly="true" type="text" class="form-control" placeholder="Section Name" value="{{ (old('section_name')!="") ? old('section_name') : $model->section_name }}"/>
                                @if ($errors->has('section_name'))
                                <span class="help-block"> {{ $errors->first('section_name') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('section_content') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Section Content</label>
                            <div class="col-md-10">
                                <textarea class="form-control my_editor" placeholder="Section Content" name="section_content" id="section_content">{{ (old('section_content')!="") ? old('section_content') : $model->section_content }}</textarea>
                                @if ($errors->has('section_content'))
                                <span class="help-block"> {{ $errors->first('section_content') }} </span>
                                @endif
                            </div>
                        </div>
                        <?php
                        $ext = pathinfo(URL::asset('public/uploads/cms/' . $model->image), PATHINFO_EXTENSION);
                        ?>
                        <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2"><?= ($ext == 'mp4') ? 'Video' : 'Image' ?></label>
                            <div class="col-md-10">
                                <?php
                                if ($ext == 'mp4') {
                                    ?>
                                    <div class="welcome-video panel-r-r animated">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <video id="firstvideo" style="width:100%" poster="{{ URL::asset('themes/frontend/assets/images/welcome-video.jpg') }}">
                                                <source src="{{ URL::asset('public/uploads/cms/' . $model->image) }}" />
                                            </video>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <img alt="" style="width: 166px;margin-bottom: 5px;" src="{{URL::asset('public/uploads/cms/'.$model->image)}}" onerror="this.src='{{ URL::asset('themes/admin/assets/no-image.png') }}';" />
                                    <?php
                                }
                                ?>
                                <input type="file" name="image" class="form-control" accept="image/*"/>
                                @if ($errors->has('image'))
                                <span class="help-block"> {{ $errors->first('image') }} </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">

                                <button type="submit" class="btn green">Submit</button>
                                <a href="{{Route('cms')}}" class="btn btn-primary">Cancel</a>
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
    $('textarea#section_content').ckeditor({
        height: "250px",
        toolbarStartupExpanded: true,
        width: "100%"
    });
});
</script>
@endsection