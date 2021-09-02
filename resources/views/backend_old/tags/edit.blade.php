@extends('layouts.admin')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="header">Edit Tag ({{ $tag->name }})</h4>
        </div>
        <div class="card-body">
            {!! Form::model($tag, ['route' => ['admin.tags.update', $tag->id], 'method' => 'patch']) !!}
            @include('backend.tags._fields')
            <div class="form-group pt-4">
                {!! Form::submit('Edit tag', ['class' => 'btn btn-outline-success']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
