@extends('admin.layouts.app')

@section('content')

    <div class="row">

        <div class="col-md-12">

            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex py-3">
                    <h4 class="m-0 font-weight-bold text-success">Edit Comment ({{ $comment->product->name }})</h4>
                    <div class="ml-auto">
                        <a href="{{ route('admin.product-comments.index') }}" class="btn btn-outline-success">
                        <span class="icon text-success-50">
                            <i class="fa fa-home"></i>
                        </span>
                            <span class="text">Edit comment</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::model($comment, ['route' => ['admin.product-comments.update', $comment->id], 'method' => 'patch']) !!}
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Comment Name') !!} {{ $comment->user_id != '' ? '(Member)' : '' }}
                                {!! Form::text('name', old('name', $comment->name), ['class' => 'form-control']) !!}
                                @error('name')<span class="text-danger">{!!  $message  !!}</span>@enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                {!! Form::label('email', 'Email') !!}
                                {!! Form::email('email', old('email', $comment->email), ['class' => 'form-control']) !!}
                                @error('email')<span class="text-danger">{!!  $message  !!}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                {!! Form::label('ip_address', 'IP Address') !!}
                                {!! Form::text('ip_address', old('ip_address', $comment->ip_address), ['class' => 'form-control']) !!}
                                @error('ip_address')<span class="text-danger">{!!  $message  !!}</span>@enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                {!! Form::label('status', 'Status') !!}
                                {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], old('status', $comment->status), ['class' => 'form-control']) !!}
                                @error('status')<span class="text-danger">{!!  $message  !!}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                {!! Form::label('comment', 'Comment') !!}
                                {!! Form::textarea('comment', old('comment'), ['class' => 'form-control', 'rows' => 5]) !!}
                                @error('comment')<span class="text-danger">{!!  $message  !!}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                {!! Form::submit('Update comment', ['class' => 'btn btn-outline-success']) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
