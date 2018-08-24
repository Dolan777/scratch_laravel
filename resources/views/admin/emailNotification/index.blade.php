@extends('admin.layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Email Management</span>
    </li>
</ul>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Email Management</span>
        </div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <table class="ui celled table" cellspacing="0" width="100%" id="email-notification">
                <thead>
                    <tr>
                        <th> Email Code </th>
                        <th> Subject </th>
                        <th> About </th>
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
        $('#email-notification').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route("emailNotification-list") !!}',
            columns: [
                {data: 'email_code', name: 'email_code'},
                {data: 'subject', name: 'subject'},
                {data: 'about', name: 'about'},
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