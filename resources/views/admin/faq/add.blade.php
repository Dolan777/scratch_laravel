@extends('admin.layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('faqpage')}}">Faq Management</a>
         <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Add</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Add</span>
                </div>
            </div>
            <div class="portlet-answere form">
                <form action="{{Route('faqpage-add')}}" method="post" class="form-horizontal">
                    {{csrf_field()}}
                    <div class="form-answere">
                        <div class="form-group {{ $errors->has('question') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Question</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Question" name="question" value="{{ (old('question')!="") ? old('question') : '' }}"/>
                                @if ($errors->has('question'))
                                <span class="help-block"> {{ $errors->first('question') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('answere') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Answere</label>
                            <div class="col-md-10">
                                <textarea class="form-control" placeholder="Answere" name="answere"  id="answere">{{ (old('answere')!="") ? old('answere') : 'Type your answere here..' }}</textarea>
                                @if ($errors->has('answere'))
                                <span class="help-block"> {{ $errors->first('answere') }} </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green"> Submit</button>
                                <a href="{{Route('faqpage')}}" class="btn btn-primary">Cancel</a>
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
    $('textarea#answere').ckeditor({
        height: "300px",
        toolbarStartupExpanded: true,
        width: "100%"
    });
});
</script>
@endsection