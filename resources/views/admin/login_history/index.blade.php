@extends('admin.layouts.main')
@section('title', 'Login History')
@section('breadcrump')

<li class="active">Login History</li>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="box box-primary box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-fw fa-bars"></i> Login History</h3>

                       
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">

                        <table class="table table-bordered" id="users-table">
                            <thead>
                                <tr>

                                    <th>Name</th>
                                    <th>ip</th>
                                    <th>Login DateTime</th>
                                   
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('javascript')
<script>
    $(function () {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route("login-history-list") !!}',
            columns: [
                {data: 'user_master_id', name: 'user_master_id'},
                {data: 'ip', name: 'ip'},
                {data: 'created_at', name: 'created_at'},
            ]
        });
    });
</script>
@endsection