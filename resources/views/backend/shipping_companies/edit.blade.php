@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/vendor/select2/css/select2.min.css') }}">
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                Edit shipping company ({{ $shippingCompany->name }})
            </h6>
            <div class="ml-auto">
                <a href="{{ route('admin.shipping_companies.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-shipping-fast"></i>
                    </span>
                    <span class="text">Back to Shipping companies</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.shipping_companies.update', $shippingCompany) }}">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name" class="text-small text-uppercase">{{ __('Name') }}</label>
                            <input name="name" type="text" class="form-control" id="name"
                                   value="{{ old('name', $shippingCompany->name) }}" placeholder="Company Name">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="code" class="text-small text-uppercase">{{ __('Code') }}</label>
                            <input id="code" type="text" class="form-control" name="code"
                                   value="{{ old('code', $shippingCompany->code) }}" placeholder="Company code">
                            @error('code')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="countries">Countries</label>
                            <select name="countries[]" id="countries" class="form-control select2" multiple="multiple">
                                @forelse($countries as $country)
                                    <option value="{{ $country->id }}"
                                        {{ in_array($country->id , old('countries', $shippingCompany->countries->pluck('id')->toArray())) ? 'selected' : null }}>
                                        {{ $country['name'] }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                            @error('countries')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="cost" class="text-small text-uppercase">{{ __('Cost') }}</label>
                            <input id="cost" type="number" min="0.00" class="form-control" name="cost" value="{{ old('cost', $shippingCompany->cost) }}" >
                            @error('cost')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="description" class="text-small text-uppercase">{{ __('Description') }}</label>
                            <input id="description" value="{{ old('description', $shippingCompany->description) }}" class="form-control" name="description">
                            @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="fast">Fast</label>
                            <select name="fast" id="fast" class="form-control">
                                <option value="">---</option>
                                <option value="1" {{ old('fast', $shippingCompany->fast) == "Fast delivery" ? 'selected' : null }}>Yes</option>
                                <option value="0" {{ old('fast', $shippingCompany->fast) == "Normal delivery" ? 'selected' : null }}>No</option>
                            </select>
                            @error('fast')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">---</option>
                                <option value="1" {{ old('status', $shippingCompany->status) == "Active" ? 'selected' : null }}>Active</option>
                                <option value="0" {{ old('status', $shippingCompany->status) == "Inactive" ? 'selected' : null }}>Inactive</option>
                            </select>
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('backend/vendor/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            // select2
            function matchStart(params, data) {
                // If there are no search terms, return all of the data
                if ($.trim(params.term) === '') {
                    return data;
                }

                // Skip if there is no 'children' property
                if (typeof data.children === 'undefined') {
                    return null;
                }

                // `data.children` contains the actual options that we are matching against
                var filteredChildren = [];
                $.each(data.children, function (idx, child) {
                    if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
                        filteredChildren.push(child);
                    }
                });

                // If we matched any of the timezone group's children, then set the matched children on the group
                // and return the group object
                if (filteredChildren.length) {
                    var modifiedData = $.extend({}, data, true);
                    modifiedData.children = filteredChildren;

                    // You can return modified objects from here
                    // This includes matching the `children` how you want in nested data sets
                    return modifiedData;
                }

                // Return `null` if the term should not be displayed
                return null;
            }

            $(".select2").select2({
                tags: true,
                closeOnSelect: false,
                minimumResultsForSearch: Infinity,
                matcher: matchStart
            });
        })
    </script>
@endsection
