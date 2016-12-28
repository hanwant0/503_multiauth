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
                    <a class="btn btn-primary btn-sm btn-flat" href="{{url('admin/auto/add')}}">
                        <i class="fa fa-plus"> Add</i>
                    </a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover" id="auto-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Model</th>
                            <th>Automanufacturer</th>
                            <th>Model Year</th>
                            <th>Asking Price</th>
                            <th>Mileage</th>
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
    var table = $('#auto-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('AutoControllerData') !!}',
        paging: true,
        columns: [
            {data: 'auto_id', name: 'autos.auto_id'},
            {data: 'auto_model', name: 'autos.auto_model'},
            {data: 'automanufacturer.automanufacturer_title', name: 'automanufacturer.title'},
            {data: 'auto_model_year', name: 'autos.auto_model_year'},
            {data: 'auto_asking_price', name: 'autos.auto_asking_price'},
            {data: 'auto_mileage', name: 'autos.auto_mileage'},
            {data: 'created_at', name: 'autos.created_at'},
            {data: 'updated_at', name: 'autos.updated_at'},
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
                                url: "auto/" + id,
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
                                success: function(res)
                                {
                                    if (res.status == "success")
                                    {
                                        toastr.success(res.message, {timeOut: 3000});
                                        table.ajax.reload();

                                    }
                                    else
                                    {
                                        toastr.error(res.message, {timeOut: 3000});
                                    }
                                }
                            });
                }
            }
        });

    })
});


</script>
@endpush