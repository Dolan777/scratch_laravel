@extends('admin.layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Faq Management</span>
    </li>
</ul>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Faq Management</span>
        </div>
        <div class="text-right">
            <a href="{{Route('faqpage-add')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add</a>
        </div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <table class="ui celled table" cellspacing="0" width="100%" id="faq-manager">
                <thead>
                    <tr>
                        <th> Question </th>
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
        $('#faq-manager').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route("faqpage-list") !!}',
            columns: [
                {data: 'question', name: 'question'},
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