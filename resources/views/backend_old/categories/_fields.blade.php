<div class="row">
    <div class="col-12">
        {!! Form::label('parent_id', 'Parent') !!}
        {!! Form::select('parent_id',['' => '---'] + $categories->toArray(), old('parent_id'), ['class' => 'form-control']) !!}
        @error('parent_id')<span class="text-danger">{!!  $message  !!}</span>@enderror
    </div>
</div>
<div class="row">
    <div class="col-12">
        {!! Form::label('description', 'Description') !!}
        {!! Form::text('description', old('description'), ['class' => 'form-control']) !!}
        @error('description')<span class="text-danger">{!!  $message  !!}</span>@enderror
    </div>
</div>
<div class="row">
    <div class="col-12">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
        @error('name')<span class="text-danger">{!!  $message  !!}</span>@enderror
    </div>
</div>
<div class="row">
    <div class="col-12">
        {!! Form::label('status', 'Status') !!}
        {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], old('status'), ['class' => 'form-control']) !!}
        @error('status')<span class="text-danger">{!!  $message  !!}</span>@enderror
    </div>
</div>





