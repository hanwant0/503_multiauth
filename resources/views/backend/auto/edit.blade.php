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

            {!! Form::open(['enctype'=>"multipart/form-data",'method' => 'put','class'=>'form-horizontal','url' => url('admin/auto/'.$auto->auto_id)]) !!}

            <div class="box-body">
                <div class="form-group">
                    {!!Form::label('automanufacturer_id', 'Automanufacturer', ['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-6">
                        {!!Form::select('automanufacturer_id',$arr_automanufacturer,$auto->automanufacturer->automanufacturer_id,['class'=>'form-control','placeholder' => 'Pick a automanufacturer...'])!!}
                    </div>
                </div>
                <div class="form-group">
                    {!!Form::label('auto_model', 'Model', ['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-6">
                        {!!Form::text('auto_model',$auto->auto_model,['class'=>'form-control'])!!}
                    </div>
                </div>
                <div class="form-group">
                    {!!Form::label('auto_model_year', 'Model year', ['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-6">
                        {!!Form::select('auto_model_year',$arr_year,$auto->auto_model_year,['class'=>'form-control','placeholder' => 'Pick a year...'])!!}
                    </div>
                </div>
                <div class="form-group">
                    {!!Form::label('auto_asking_price', 'Asking price', ['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-6">
                        {!!Form::text('auto_asking_price',$auto->auto_asking_price,['class'=>'form-control'])!!}
                    </div>
                </div>
                <div class="form-group">
                    {!!Form::label('auto_mileage', 'Mileage', ['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-6">
                        {!!Form::text('auto_mileage',$auto->auto_mileage,['class'=>'form-control'])!!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Current Image</label>
                    <div class="col-md-6">
                        <img src="{!!url('/uploads/auto/'.$auto->auto_image)!!}" width="60%">
                    </div>
                </div>

                <div class="form-group">
                    {!!Form::label('auto_image', 'New Image', ['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-6">
                        <input type="file" class="dropify" data-height="150" name="auto_image" accept="image/*">
                    </div>
                </div>

                <div class="form-group">
                    {!!Form::label('tags', 'Tags', ['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-6">
                        {{-- bootstrap-tagsinput needs this to have 100% width to show properly --}}
                        {!!Form::text('tags',implode(', ', $auto->tags->pluck('tag_title')->all()),['class'=>'form-control','data-role'=>'tagsinput','style'=>'width:100%'])!!}
                    </div>
                </div>

                <div class="box-footer">
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            {!!Form::submit('Update',['class'=>'btn bg-primary btn-flat'])!!}
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset ("/bower_components/dropify/dist/js/dropify.js") }}" type="text/javascript"></script>
<script src="{{ asset("/bower_components/AdminLTE/plugins/bootstrap-tags-input/bootstrap-tagsinput.js")}}" /></script>
<script>
$(function() {
    $('.dropify').dropify();
});
</script>
@endpush