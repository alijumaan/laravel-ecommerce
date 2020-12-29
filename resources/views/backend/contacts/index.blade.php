@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex py-3">
                <h4 class="m-0 font-weight-bold text-success">Contact us</h4>
            </div>
            <div class="col-11 mr-auto">
                @include('backend.contacts.filter.filter')
            </div>
            <div class="table-responsive">
                <table class="table table-content table-hover">
                    <thead>
                        <tr>
                            <th>From</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Create at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $message)
                            <tr>
                                <td><a href="{{ route('admin.contacts.show', $message->id) }}">{{ $message->name }}</a></td>
                                <td>{{ $message->title }}</td>
                                <td>{{ $message->status() }}</td>
                                <td>{{ $message->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <div class="btn-group btn-group-toggle">
                                        <a href="{{ route('admin.contacts.show', $message->id) }}" title="Show" class="btn-primary btn btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="javascript:void(0);" onclick="if (confirm('Are You sure want to Delete?'))
                                            { document.getElementById('contact-delete-{{ $message->id }}').submit(); } else { return false; }"
                                           title="Delete" class="btn-danger btn btn-sm"><i class="fa fa-trash"></i>
                                        </a>
                                        <form action="{{ route('admin.contacts.destroy', $message->id) }}" method="post" id="contact-delete-{{ $message->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No messages found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="5">
                            <div class="float-right">
                            {!! $messages->appends(request()->input())->links() !!}
                            </div>
                        </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
