@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                {{ $review->user_id ? $review->user->full_name : $review->name }}
            </h6>
            <div class="ml-auto">
                <a href="{{ route('admin.reviews.index') }}" class="btn btn-primary">
                    <span class="text">Back to reviews</span>
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr class="bg-secondary text-white">
                    <th>Name</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Rating</th>
                    <th>Created at</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        {{ $review->user_id ? $review->user->full_name : $review->name }}<br>
                        <small>{{ $review->email }}</small>
                    </td>
                    <td>{{ $review->title }}</td>
                    <td>{{ $review->status }}</td>
                    <td><span class="badge badge-success">{{ $review->rating }}</span></td>
                    <td>{{ $review->created_at }}</td>
                </tr>
                </tbody>
                <thead>
                <tr class="bg-secondary text-white" >
                    <th colspan="5">Message</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="5">{{ $review->content }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
