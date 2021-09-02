@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                {{ $state->name }}
            </h6>
            <div class="ml-auto">
                <a href="{{ route('admin.states.index') }}" class="btn btn-primary">
                    <span class="text">Back to countries</span>
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $state->name }}</td>
                    <td>{{ $state->status }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
