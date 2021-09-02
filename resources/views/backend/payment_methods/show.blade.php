@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                {{ $paymentMethod->name }}
            </h6>
            <div class="ml-auto">
                <a href="{{ route('admin.payment_methods.index') }}" class="btn btn-primary">
                    <span class="text">Back to payment methods</span>
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <th>Name</th>
                    <td>{{ $paymentMethod->name }}</td>
                </tr>
                <tr>
                    <th>Code</th>
                    <td>{{ $paymentMethod->code }}</td>
                </tr>
                <tr>
                    <th>sandbox</th>
                    <td class="{{ $paymentMethod->sandbox == 'Live' ? 'text-danger' : 'text-primary' }}">
                        {{ $paymentMethod->sandbox }}
                    </td>
                </tr>
                <tr>
                    <th>Sandbox merchant email</th>
                    <td>{{ $paymentMethod->sandbox_merchant_email }}</td>
                </tr>
                <tr>
                    <th>Sandbox client ID</th>
                    <td>{{ $paymentMethod->sandbox_client_id }}</td>
                </tr>
                <tr>
                    <th>Sandbox client secret</th>
                    <td>{{ $paymentMethod->sandbox_client_secret }}</td>
                </tr>
                <tr>
                    <th>Merchant email</th>
                    <td>{{ $paymentMethod->merchant_email }}</td>
                </tr>
                <tr>
                    <th>Client ID</th>
                    <td>{{ $paymentMethod->client_id }}</td>
                </tr>
                <tr>
                    <th>Client secret</th>
                    <td>{{ $paymentMethod->client_secret }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td class="{{ $paymentMethod->status == 'Active' ? 'text-success' : 'text-secondary' }}">
                        {{ $paymentMethod->status }}
                    </td>
                </tr>
                <tr>
                    <th>Created at</th>
                    <td>{{ $paymentMethod->created_at ? $paymentMethod->created_at->format('Y-m-d') : '' }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
