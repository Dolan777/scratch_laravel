@extends('admin.layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">CMS Page Management</span>
    </li>
</ul>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">CMS Page Management</span>
        </div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <table class="ui celled table" cellspacing="0" width="100%" id="cmspage-manager">
                <thead>
                    <tr>
                        <th> Title </th>
                        <th> Page Type </th>
                        <th> Last Update </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script>
    $(function () {
        $('#cmspage-manager').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route("cmspage-list") !!}',
            columns: [
                {data: 'title', name: 'title'},
                {data: 'page_type', name: 'page_type'},
                {data: 'updated_at', name: 'updated_at'},
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
</script>
@endsection