@extends('admin.layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Contact Us Management</span>
    </li>
</ul>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Contact Us Management</span>
        </div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <table class="ui celled table" cellspacing="0" width="100%" id="contact-manager">
                <thead>
                    <tr>
                        <th> Name </th>
                        <th> Email </th>
                        <th> Subject </th>
                        <th> Date Time </th>
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
        $('#contact-manager').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route("contactus-list") !!}',
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'subject', name: 'subject'},
                {data: 'created_at', name: 'created_at'},
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