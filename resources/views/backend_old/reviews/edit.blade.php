@extends('layouts.admin')

@section('content')

    <div class="row">

        <div class="col-md-12">

            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex py-3">
                    <h4 class="m-0 font-weight-bold text-success">Edit Review ({{ $review->product->name }})</h4>
                    <div class="ml-auto">
                        <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-success">
                        <span class="icon text-success-50">
                            <i class="fa fa-home"></i>
                        </span>
                            <span class="text">Edit review</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::model($review, ['route' => ['admin.reviews.update', $review->id], 'method' => 'patch']) !!}
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                {!! Form::label('name', 'review Name') !!} {{ $review->user_id != '' ? '(Member)' : '' }}
                                {!! Form::text('name', old('name', $review->name), ['class' => 'form-control']) !!}
                                @error('name')<span class="text-danger">{!!  $message  !!}</span>@enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                {!! Form::label('email', 'Email') !!}
                                {!! Form::email('email', old('email', $review->email), ['class' => 'form-control']) !!}
                                @error('email')<span class="text-danger">{!!  $message  !!}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                {!! Form::label('ip_address', 'IP Address') !!}
                                {!! Form::text('ip_address', old('ip_address', $review->ip_address), ['class' => 'form-control']) !!}
                                @error('ip_address')<span class="text-danger">{!!  $message  !!}</span>@enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                {!! Form::label('status', 'Status') !!}
                                {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], old('status', $review->status), ['class' => 'form-control']) !!}
                                @error('status')<span class="text-danger">{!!  $message  !!}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                {!! Form::label('review', 'review') !!}
                                {!! Form::textarea('review', old('review'), ['class' => 'form-control', 'rows' => 5]) !!}
                                @error('review')<span class="text-danger">{!!  $message  !!}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                {!! Form::submit('Update review', ['class' => 'btn btn-outline-success']) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
