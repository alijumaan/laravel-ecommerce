<div class="row">
    <div class="col-md-4 col-lg-2 col-sm-12">
        <div class="form-group">
            {!! Form::label('name', 'Coupon name') !!}
            {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
            @error('name')<span class="text-danger">{!!  $message  !!}</span>@enderror
        </div>
    </div>
    <div class="col-md-4 col-lg-2 col-sm-12">
        <div class="form-group">
            {!! Form::label('type', 'Type') !!}
            {!! Form::text('type', old('type'), ['class' => 'form-control']) !!}
            @error('type')<span class="text-danger">{!!  $message  !!}</span>@enderror
        </div>
    </div>
    <div class="col-md-4 col-lg-2 col-sm-12">
        <div class="form-group">
            {!! Form::label('description', 'description') !!}
            {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => 'Optional']) !!}
            @error('description')<span class="text-danger">{!!  $message  !!}</span>@enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-3 col-sm-12">
        <div class="form-group">
            {!! Form::label('code', 'Code') !!}
            {!! Form::text('code', old('code'), ['class' => 'form-control']) !!}
            @error('code')<span class="text-danger">{!!  $message  !!}</span>@enderror
        </div>
    </div>
    <div class="col-md-6 col-lg-3 col-sm-12">
        <div class="form-group">
            {!! Form::label('value', 'Value') !!}
            {!! Form::text('value', old('value'), ['class' => 'form-control']) !!}
            @error('value')<span class="text-danger">{!!  $message  !!}</span>@enderror
        </div>
    </div>
</div>






