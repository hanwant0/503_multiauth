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
<!--            {!! Form::open(['enctype'=>"multipart/form-data",'method' => 'put','class'=>'form-horizontal','url' => url('admin/automanufacturer/'.$automanufacturer->automanufacturer_id)]) !!}-->
            {!! Form::open(['enctype'=>"multipart/form-data",'class'=>'form-horizontal','url' => url('admin/automanufacturer/save/'.$automanufacturer->automanufacturer_id)]) !!}
            @include('backend.automanufacturer._form',['submit_button' => 'Update'])

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection