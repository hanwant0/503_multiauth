@extends('layouts.admin_template')

@push('styles')
<link href="{{ asset("/bower_components/dropify/dist/css/dropify.css")}}" rel="stylesheet" type="text/css" />
<link href="{{ asset("/bower_components/AdminLTE/plugins/bootstrap-tags-input/bootstrap-tagsinput.css")}}" rel="stylesheet" type="text/css" />
<style>
    .bootstrap-tagsinput {
        width: 100%;
    }
</style>
@endpush
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{$page_title}}</h3>
                <div class="pull-right">
                    <a href="{{url('admin/auto')}}" class="btn btn-primary btn-sm btn-flat">
                        <i class="fa fa-arrow-left"> BACK</i>
                    </a>
                </div>
            </div>

            @include('backend.partials.messages')

            {!! Form::open(['files'=>TRUE,'class'=>'form-horizontal','url' => url('admin/auto')]) !!}
            @include('backend.auto._form',['submit_button' => 'Create'])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset ("/bower_components/dropify/dist/js/dropify.js") }}"></script>
<script src="{{ asset("/bower_components/AdminLTE/plugins/bootstrap-tags-input/bootstrap-tagsinput.js")}}" /></script>
<script>
$(function() {
    $('.dropify').dropify();
});
</script>
@endpush