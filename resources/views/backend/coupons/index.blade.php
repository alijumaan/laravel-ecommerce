@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                Coupons
            </h6>
            <div class="ml-auto">
                @can('create_coupon')
                    <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                        <span class="text">New coupon</span>
                    </a>
                @endcan
            </div>
        </div>

        @include('partials.backend.filter', ['model' => route('admin.coupons.index')])

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Code</th>
                    <th>Value</th>
                    <th>Use times</th>
                    <th>Validity date</th>
                    <th>Greater than</th>
                    <th>Status</th>
                    <th>Coupon visibility</th>
                    <th>Created at</th>
                    <th class="text-center" style="width: 30px;">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($coupons as $coupon)
                    <tr>
                        <td><a href="{{ route('admin.coupons.show', $coupon->id) }}">
                                {{ $coupon->code }}
                            </a></td>
                        <td>{{ $coupon->type == 'fixed' ? '$' : '%' }}{{ $coupon->value }}</td>
                        <td>{{ $coupon->used_times . '/' . $coupon->use_times }}</td>
                        <td>Start:  {{ $coupon->start_date != '' ? $coupon->start_date->format('Y-m-d') : '-' }}
                            <br>
                            Expire:
                            <span class="text-danger">
                                {{ $coupon->expire_date != '' ? $coupon->expire_date->format('Y-m-d') : '-' }}
                            </span>
                        </td>
                        <td>{{ $coupon->greater_than ?? '-' }}</td>
                        <td>{{ $coupon->status }}</td>
                        <td>{{ $coupon->is_public }}</td>
                        <td>{{ $coupon->created_at ?? $coupon->created_at->format('Y-m-d h:i a') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);"
                                   onclick="if (confirm('Are you sure to delete this record?'))
                                       {document.getElementById('delete-coupon-{{ $coupon->id }}').submit();} else {return false;}"
                                   class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{ route('admin.coupons.destroy', $coupon) }}"
                                  method="POST"
                                  id="delete-coupon-{{ $coupon->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="8">No coupons found.</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="8">
                        <div class="float-right">
                            {!! $coupons->appends(request()->all())->links() !!}
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
