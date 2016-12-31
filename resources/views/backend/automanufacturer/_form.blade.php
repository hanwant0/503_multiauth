<div class="box-body">
    <div class="form-group @if ($errors->has('automanufacturer_title')) has-error @endif">
        {!!Form::label('automanufacturer_title',trans('language.title'), ['class' => 'col-md-3 control-label'])!!}
        <div class="col-md-6">
            {!!Form::text('automanufacturer_title',old('automanufacturer_title',  isset($automanufacturer->automanufacturer_title) ? $automanufacturer->automanufacturer_title : null),['class'=>'form-control','autofocus'])!!}
            @if ($errors->has('automanufacturer_title')) <p class="help-block">{{ $errors->first('automanufacturer_title') }}</p> @endif
        </div>
    </div>
    <div class="box-footer">
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                {!!Form::submit($submit_button,['class'=>'btn bg-primary btn-flat'])!!}
            </div>
        </div>
    </div>
</div>