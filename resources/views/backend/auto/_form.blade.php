<div class="box-body">
    <div class="form-group @if ($errors->has('automanufacturer_id')) has-error @endif">
        {!!Form::label('automanufacturer_id', 'Automanufacturer', ['class' => 'col-md-3 control-label'])!!}
        <div class="col-md-6">
            {!!
            Form::select
            ('automanufacturer_id',
            $arr_automanufacturer,
            old('automanufacturer_id',  isset($auto->automanufacturer->automanufacturer_id) ? $auto->automanufacturer->automanufacturer_id : null),
            ['class'=>'form-control','placeholder' => 'Pick a automanufacturer...'])
            !!}
            @if ($errors->has('automanufacturer_id')) <p class="help-block">{{ $errors->first('automanufacturer_id') }}</p> @endif
        </div>
    </div>
    <div class="form-group @if ($errors->has('auto_model')) has-error @endif">
        {!!Form::label('auto_model', 'Model', ['class' => 'col-md-3 control-label'])!!}
        <div class="col-md-6">
            {!!Form::text
            ('auto_model',
            old('auto_model',isset($auto->auto_model) ? $auto->auto_model : null),
            ['class'=>'form-control'])
            !!}
            @if ($errors->has('auto_model')) <p class="help-block">{{ $errors->first('auto_model') }}</p> @endif
        </div>
    </div>
    <div class="form-group @if ($errors->has('auto_model_year')) has-error @endif">
        {!!Form::label('auto_model_year', 'Model year', ['class' => 'col-md-3 control-label'])!!}
        <div class="col-md-6">
            {!!
            Form::select
            ('auto_model_year',
            $arr_year,
            old('auto_model_year',isset($auto->auto_model_year) ? $auto->auto_model_year : null),
            ['class'=>'form-control','placeholder' => 'Pick a year...'])
            !!}
            @if ($errors->has('auto_model_year')) <p class="help-block">{{ $errors->first('auto_model_year') }}</p> @endif
        </div>
    </div>
    <div class="form-group @if ($errors->has('auto_asking_price')) has-error @endif">
        {!!Form::label('auto_asking_price', 'Asking price', ['class' => 'col-md-3 control-label'])!!}
        <div class="col-md-6">
            {!!
            Form::text
            ('auto_asking_price',
            old('auto_asking_price',isset($auto->auto_asking_price) ? $auto->auto_asking_price : null),
            ['class'=>'form-control'])
            !!}
            @if ($errors->has('auto_asking_price')) <p class="help-block">{{ $errors->first('auto_asking_price') }}</p> @endif
        </div>
    </div>
    <div class="form-group @if ($errors->has('auto_mileage')) has-error @endif">
        {!!Form::label('auto_mileage', 'Mileage', ['class' => 'col-md-3 control-label'])!!}
        <div class="col-md-6">
            {!!
            Form::text
            ('auto_mileage',
            old('auto_mileage',isset($auto->auto_mileage) ? $auto->auto_mileage : null),
            ['class'=>'form-control'])
            !!}
            @if ($errors->has('auto_mileage')) <p class="help-block">{{ $errors->first('auto_mileage') }}</p> @endif
        </div>
    </div>
    @if(isset($auto->auto_image))
    <div class="form-group">
        <label class="col-md-3 control-label">Current Image</label>
        <div class="col-md-6">
            <img src="{!!url('/uploads/auto/'.$auto->auto_image)!!}" width="60%">
        </div>
    </div>
    @endif

    <div class="form-group @if ($errors->has('auto_image')) has-error @endif">
        {!!Form::label('auto_image', 'New Image', ['class' => 'col-md-3 control-label'])!!}
        <div class="col-md-6">
            <input type="file" class="dropify" data-height="150" name="auto_image" accept="image/*">
        </div>
    </div>

    @if ($errors->has('auto_image'))
    <div class="form-group  has-error">
        <div class="col-md-6 col-md-offset-3">
            @if ($errors->has('auto_image')) <p class="help-block">{{ $errors->first('auto_image') }}</p> @endif
        </div>
    </div>
    @endif


    <div class="form-group">
        {!!Form::label('tags', 'Tags', ['class' => 'col-md-3 control-label'])!!}
        <div class="col-md-6">
            {{-- bootstrap-tagsinput needs this to have 100% width to show properly --}}
            {!!
            Form::text
            ('tags',
            old('tags',isset($auto->tags) ?implode(', ', $auto->tags->pluck('tag_title')->all())  : null),
            ['class'=>'form-control','data-role'=>'tagsinput','style'=>'width:100%'])
            !!}
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