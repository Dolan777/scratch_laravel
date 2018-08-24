@extends('admin.layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Slider Management</span>
    </li>
</ul>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Slider Management</span>
        </div>
        <div class="text-right">
            <a href="{{Route('slider-add')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add</a>
        </div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <table class="ui celled table" cellspacing="0" width="100%" id="slider-manager">
                <thead>
                    <tr>
                        <th>Title </th>
                        <th>Background Image</th>
                        <th> Actions </th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('page_js')
<script>
    $(function () {
        $('#slider-manager').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route("slider-list") !!}',
            columns: [
                {data: 'title', name: 'title'},

                {data: 'background_image', name: 'background_image', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            drawCallback: function () {
                $('[data-toggle=confirmation]').confirmation({
                    rootSelector: '[data-toggle=confirmation]',
                    container: 'body'
                });

            }
        });
    });
    function deleteConfirm(obj) {
        var r = confirm("Are you sure want to delete this instrument ?");
        if (r == true) {
            window.location.href = $(obj).attr('data-href');
        }
    }
</script>
@endsection