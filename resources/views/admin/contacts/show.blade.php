@extends('admin.layouts.app')

@section('content')

    <div class="card shadow-sm mb-2">
        <div class="card-header d-flex py-3">
            <h4 class="m-0 font-weight-bold text-success">{{ $message->title }}</h4>
            <div class="ml-auto">
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-success">
                        <span class="icon text-success-50">
                            <i class="fa fa-home"></i>
                        </span>
                    <span class="text">Messages</span>
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tbody>
                <tr>
                    <th>Title</th>
                    <td>{{ $message->title }}</td>
                </tr>
                <tr>
                    <th>From</th>
                    <td>{{ $message->name }} < {{ $message->email }} ></td>
                </tr>
                <tr>
                    <th>Message</th>
                    <td>{!! $message->message !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection

