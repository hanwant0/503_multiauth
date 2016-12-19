@extends('layouts.admin_template')

@push('styles')
<link href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="{{ asset("/bower_components/AdminLTE/plugins/toastr/toastr.css")}}" rel="stylesheet" type="text/css" />

@endpush
@section('content')
<div class='row'>
    <div class='col-xs-12'>
        @include('backend.partials.messages')
        <div class="box box-info margin-bottom">
            <div class="box-header with-border">
                <div class="pull-left"><h3 class="box-title"><strong>{{ $page_title}}</strong></h3></div>
                <div class="pull-right">
                    <a class="btn btn-primary btn-sm btn-flat" href="{{url('admin/automanufacturer/create')}}">
                        <i class="fa fa-plus"> Create</i>
                    </a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover" id="automanufacturer-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script src="{{ asset ("/bower_components/AdminLTE/plugins/bootbox/bootbox.js") }}"></script>
<script src="{{ asset ("/bower_components/AdminLTE/plugins/toastr/toastr.js") }}"></script>


<script>
$(function() {
    var table = $('#automanufacturer-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('AutomanufacturerControllerData') !!}',
        paging: true,
        columns: [
            {data: 'automanufacturer_id', name: 'automanufacturer_id'},
            {data: 'title', name: 'title'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    $(document).on("click", ".delete-button", function(e) {
        e.preventDefault();
        var id = $(this).attr("id");
        bootbox.confirm({
            message: "Are you sure to delete ?",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function(result) {
                if (result)
                {
                    var token = '{!!csrf_token()!!}';

                    $.ajax(
                            {
                                url: "automanufacturer/" + id,
                                type: 'DELETE',
                                dataType: "JSON",
                                data: {
                                    "id": id,
                                    "_method": 'DELETE',
                                    "_token": token
                                },
                                error: function()
                                {
                                    toastr.error('something goes wrong');
                                },
                                success: function()
                                {
                                    toastr.success('automanufacturer deleted successfully');
                                    table.ajax.reload();
                                }
                            });
                }
            }
        });

    })
});


</script>
@endpush