<div class="row">
    <div class="col-md-4 col-lg-2 col-sm-12">
        <div class="form-group">
            {!! Form::label('name', 'Tag name') !!}
            {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
            @error('name')<span class="text-danger">{!!  $message  !!}</span>@enderror
        </div>
    </div>
</div>







