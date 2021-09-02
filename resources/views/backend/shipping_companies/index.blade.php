@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                Shipping Companies
            </h6>
            <div class="ml-auto">
                @can('create_shipping_company')
                    <a href="{{ route('admin.shipping_companies.create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                        <span class="text">New company</span>
                    </a>
                @endcan
            </div>
        </div>

        @include('partials.backend.filter', ['model' => route('admin.shipping_companies.index')])

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Fast</th>
                    <th>Cost</th>
                    <th>Countries Count</th>
                    <th>Status</th>
                    <th class="text-center" style="width: 30px;">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($shippingCompanies as $shippingCompany)
                    <tr>
                        <td><a href="{{ route('admin.shipping_companies.show', $shippingCompany->id) }}">{{ $shippingCompany->name }}</a></td>
                        <td>{{ $shippingCompany->code }}</td>
                        <td>{{ $shippingCompany->description }}</td>
                        <td>{{ $shippingCompany->fast }}</td>
                        <td>{{ $shippingCompany->cost }}</td>
                        <td>{{ $shippingCompany->countries_count }}</td>
                        <td>{{ $shippingCompany->status }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.shipping_companies.edit', $shippingCompany) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);"
                                   onclick="if (confirm('Are you sure to delete this record?'))
                                       {document.getElementById('delete-shipping-company-{{ $shippingCompany->id }}').submit();} else {return false;}"
                                   class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{ route('admin.shipping_companies.destroy', $shippingCompany) }}"
                                  method="POST"
                                  id="delete-shipping-company-{{ $shippingCompany->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="8">No shipping companies found.</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="8">
                        <div class="float-right">
                            {!! $shippingCompanies->appends(request()->all())->links() !!}
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
