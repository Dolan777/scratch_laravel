@extends('admin.layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Artists Management</span>
    </li>
</ul>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Artists Management</span>
        </div>
        <div class="pull-right"><a href="{{route('artists-add')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a></div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <table class="ui celled table" cellspacing="0" width="100%" id="artist-manager">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('page_js')
<script>
    $(function () {
        $('#artist-manager').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("artists-list-datatable") }}',
            columns: [
                {data: 'full_name', name: 'full_name'},
                {data: 'image', name: 'image', orderable: false, searchable: false},
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
    function btnDelete(obj) {
        var r = confirm("Are you sure want to delete this artist ?");
        if (r == true) {
            window.location.href = $(obj).attr('data-href');
        }
    }
</script>
@endsection