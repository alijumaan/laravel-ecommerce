@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                Addresses
            </h6>
            <div class="ml-auto">
                @can('create_user_address')
                    <a href="{{ route('admin.user_addresses.create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                        <span class="text">New Address</span>
                    </a>
                @endcan
            </div>
        </div>

        @include('partials.backend.filter', ['model' => route('admin.user_addresses.index')])

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Customer</th>
                    <th>Title</th>
                    <th>Shipping Info</th>
                    <th>Location</th>
                    <th>Address</th>
                    <th>Zip Code</th>
                    <th>PO Box</th>
                    <th class="text-center" style="width: 30px;">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($userAddresses as $address)
                    <tr>
                        <td>
                            <a href="{{ route('admin.users.show', $address->user_id) }}">
                                {{ $address->user->full_name }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.user_addresses.show', $address->id) }}">{{ $address->address_title }}</a>
                            <p class="text-gray-400"><b>{{ $address->default_address }}</b></p>
                        </td>
                        <td>
                            {{ $address->first_name . ' ' . $address->last_name }}
                            <p class="text-gray-400">{{ $address->email }}<br>{{ $address->phone }}</p>
                        </td>
                        <td>{{ $address->country->name . ' - ' . $address->state->name . ' ' . $address->city->name}}</td>
                        <td>{{ $address->address }}</td>
                        <td>{{ $address->zip_code }}</td>
                        <td>{{ $address->po_box }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.user_addresses.edit', $address) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);"
                                   onclick="if (confirm('Are you sure to delete this record?'))
                                       {document.getElementById('delete-user_address-{{ $address->id }}').submit();} else {return false;}"
                                   class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{ route('admin.user_addresses.destroy', $address) }}"
                                  method="POST"
                                  id="delete-user_address-{{ $address->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="8">No addresses found.</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="8">
                        <div class="float-right">
                            {!! $userAddresses->appends(request()->all())->links() !!}
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
