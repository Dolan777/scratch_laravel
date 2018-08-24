@extends('admin.layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">CMS Management</span>
    </li>
</ul>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">CMS Management</span>
        </div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <table class="ui celled table" cellspacing="0" width="100%" id="cms-manager">
                <thead>
                    <tr>
                        <th> Page Name </th>
                        <th> Section </th>
                        <th> Actions </th>
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
        $('#cms-manager').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route("cms-list") !!}',
            columns: [
                {data: 'page_name', name: 'page_name'},
                {data: 'section_name', name: 'section_name'},
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