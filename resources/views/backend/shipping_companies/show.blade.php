@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                {{ $tag->name }}
            </h6>
            <div class="ml-auto">
                <a href="{{ route('admin.tags.index') }}" class="btn btn-primary">
                    <span class="text">Back to tags</span>
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Created at</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $tag->name }}</td>
                    <td>{{ $tag->status }}</td>
                    <td>{{ $tag->created_at }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
