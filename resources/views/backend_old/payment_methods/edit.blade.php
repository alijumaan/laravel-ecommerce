@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit Payment method ({{ $paymentMethod->name }})</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.payment_methods.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Payment methods</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.payment_methods.update', $paymentMethod->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ old('name', $paymentMethod->name) }}" class="form-control">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="code">code</label>
                            <input type="text" name="code" value="{{ old('code', $paymentMethod->code) }}" class="form-control">
                            @error('code')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="sandbox">Sandbox</label>
                            <select name="sandbox" class="form-control">
                                <option value="1" {{ old('sandbox', $paymentMethod->sandbox) == '1' ? 'selected' : null }}>Sandbox</option>
                                <option value="0" {{ old('sandbox', $paymentMethod->sandbox) == '0' ? 'selected' : null }}>Live</option>
                            </select>
                            @error('sandbox')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status', $paymentMethod->status) == '1' ? 'selected' : null }}>Active</option>
                                <option value="0" {{ old('status', $paymentMethod->status) == '0' ? 'selected' : null }}>Inactive</option>
                            </select>
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="merchant_email">Merchant Email</label>
                            <input type="text" name="merchant_email" value="{{ old('merchant_email', $paymentMethod->merchant_email) }}" class="form-control">
                            @error('merchant_email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="client_id">Client ID</label>
                            <input type="text" name="client_id" value="{{ old('client_id', $paymentMethod->client_id) }}" class="form-control">
                            @error('client_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="client_secret">Client secret</label>
                            <input type="text" name="client_secret" value="{{ old('client_secret', $paymentMethod->client_secret) }}" class="form-control">
                            @error('client_secret')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="sandbox_merchant_email">Sandbox Merchant Email</label>
                            <input type="text" name="sandbox_merchant_email" value="{{ old('sandbox_merchant_email', $paymentMethod->sandbox_merchant_email) }}" class="form-control">
                            @error('sandbox_merchant_email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="sandbox_client_id">Sandbox client id</label>
                            <input type="text" name="sandbox_client_id" value="{{ old('sandbox_client_id', $paymentMethod->sandbox_client_id) }}" class="form-control">
                            @error('sandbox_client_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="sandbox_client_secret">Sandbox client secret</label>
                            <input type="text" name="sandbox_client_secret" value="{{ old('sandbox_client_secret', $paymentMethod->sandbox_client_secret) }}" class="form-control">
                            @error('sandbox_client_secret')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Update Payment method</button>
                </div>
            </form>
        </div>
    </div>

@endsection
