@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex py-3">
                <h4 class="m-0 font-weight-bold text-success">Contact us</h4>
            </div>
            <div class="col-11 mr-auto">
                @include('partials.backend.filter', ['model' => route('admin.contacts.index')])
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
                        @forelse($contacts as $contact)
                            <tr>
                                <td><a href="{{ route('admin.contacts.show', $contact->id) }}">{{ $contact->name }}</a></td>
                                <td>{{ $contact->title }}</td>
                                <td>{{ $contact->status() }}</td>
                                <td>{{ $contact->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <div class="btn-group btn-group-toggle">
                                        <a href="{{ route('admin.contacts.show', $contact->id) }}" title="Show" class="btn-primary btn btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="javascript:void(0);" onclick="if (confirm('Are You sure want to Delete?'))
                                            { document.getElementById('contact-delete-{{ $contact->id }}').submit(); } else { return false; }"
                                           title="Delete" class="btn-danger btn btn-sm"><i class="fa fa-trash"></i>
                                        </a>
                                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="post" id="contact-delete-{{ $contact->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No contacts found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="5">
                            <div class="float-right">
                            {!!$contacts->appends(request()->all())->links() !!}
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
