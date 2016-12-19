@extends('layouts.admin_template')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{$page_title}}</h3>
                <div class="pull-right">
                    <a href="{{url('admin/automanufacturer')}}" class="btn btn-primary btn-sm btn-flat">
                        <i class="fa fa-arrow-left"> BACK</i>
                    </a>
                </div>
            </div>
            @include('backend.partials.messages')
            {!! Form::open(['enctype'=>"multipart/form-data",'method' => 'put','class'=>'form-horizontal','url' => url('admin/automanufacturer/'.$automanufacturer->automanufacturer_id)]) !!}
            <div class="box-body">
                <div class="form-group">
                    {!!Form::label('title', 'Title', ['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-6">
                        {!!Form::text('title',$automanufacturer->title,['class'=>'form-control','autofocus'])!!}
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