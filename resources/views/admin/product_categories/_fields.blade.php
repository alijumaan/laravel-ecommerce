<div class="row">
    <div class="col-12">
        {!! Form::label('parent_id', 'Parent') !!}
        {!! Form::select('parent_id',['' => '---'] + $categories->toArray(), old('parent_id'), ['class' => 'form-control']) !!}
        @error('parent_id')<span class="text-danger">{!!  $message  !!}</span>@enderror
    </div>
</div>
<div class="row">
    <div class="col-12">
        {!! Form::label('order', 'Order') !!}
        {!! Form::text('order', old('order'), ['class' => 'form-control']) !!}
        @error('order')<span class="text-danger">{!!  $message  !!}</span>@enderror
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





