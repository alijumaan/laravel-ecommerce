@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                Edit Address ({{ $userAddress->address_title }})
            </h6>
            <div class="ml-auto">
                <a href="{{ route('admin.user_addresses.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                    </span>
                    <span class="text">Back to addresses</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.user_addresses.update', $userAddress->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="user_name">Customer</label>
                            <input class="form-control" id="user_name" type="text" name="user_name" value="{{ $userAddress->user->full_name }}" readonly>
                            <input class="form-control" id="user_id" type="hidden" name="user_id" value="{{ $userAddress->user_id }}" readonly>
                            @error('user_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="address_title">Address title</label>

                            <input class="form-control" id="address_title" type="text" name="address_title" value="{{ old('address_title', $userAddress->address_title) }}">
                            @error('address_title')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="default_address">Default Address</label>
                            <select name="default_address" id="default_address" class="form-control">
                                <option value="">---</option>
                                <option value="1" {{ old('default_address', $userAddress->default_address) == "Default Address" ? 'selected' : null }}>Yes</option>
                                <option value="0" {{ old('default_address', $userAddress->default_address) == "" ? 'selected' : null }}>No</option>
                            </select>
                            @error('default_address')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input class="form-control" id="first_name" type="text" name="first_name" value="{{ old('first_name', $userAddress->first_name) }}">
                            @error('first_name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input class="form-control" id="last_name" type="text" name="last_name" value="{{ old('last_name', $userAddress->last_name) }}">
                            @error('last_name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" id="email" type="email" name="email" value="{{ old('email', $userAddress->email) }}">
                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input class="form-control" id="phone" type="text" name="phone" value="{{ old('phone', $userAddress->phone) }}">
                            @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="country_id">Country</label>
                            <select name="country_id" id="country_id" class="form-control">
                                <option value="">---</option>
                                @forelse($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('country_id', $userAddress->country_id) == $country->id ? 'selected' : null }}>
                                        {{ $country->name }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                            @error('country_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="state_id">State</label>
                            <select name="state_id" id="state_id" class="form-control">
                            </select>
                            @error('state_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="city_id">City</label>
                            <select name="city_id" id="city_id" class="form-control">
                            </select>
                            @error('city_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input class="form-control" id="address" type="text" name="address" value="{{ old('address', $userAddress->address) }}">
                            @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="address2">Address2</label>
                            <input class="form-control" id="address2" type="text" name="address2" value="{{ old('address2', $userAddress->address2) }}">
                            @error('address2')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="zip_code">ZIP Code</label>
                            <input class="form-control" id="zip_code" type="text" name="zip_code" value="{{ old('zip_code', $userAddress->zip_code) }}">
                            @error('zip_code')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="po_box">PO Box</label>
                            <input class="form-control" id="po_box" type="text" name="po_box" value="{{ old('po_box', $userAddress->po_box) }}">
                            @error('po_box')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group pt-4">
                    <button class="btn btn-primary" type="submit" name="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('backend/vendor/typeahead/bootstrap3-typeahead.min.js') }}"></script>

    <script>
        $(function () {

            populateStates();
            populateCities();

            $("#country_id").change(function () {
                populateStates();
                return false
            });

            $("#state_id").change(function () {
                populateCities();
                return false
            });

            function populateStates()
            {
                let countryId = $('#country_id').val() != null ? $('#country_id').val() : "{{ old('country_id', $userAddress->country_id) }}";
                $.get("{{ route('admin.states.get_states') }}", { country_id: countryId }, function (data) {
                    $('option', $("#state_id")).remove();
                    $("#state_id").append($('<option><option>').val('').html(' --- '));

                    $.each(data, function (val, text) {
                        let selectedVal = text.id == "{{ old('state_id', $userAddress->state_id) }}" ? "selected" : "";
                        $("#state_id").append($(`<option value="${text.id}" ${selectedVal}>${text.name}<option>`));
                    });

                }, "json");
            }

            function populateCities()
            {
                let stateId = $('#state_id').val() != null ? $('#state_id').val() : "{{ old('state_id', $userAddress->state_id) }}";
                $.get("{{ route('admin.cities.get_cities') }}", { state_id: stateId }, function (data) {
                    $('option', $("#city_id")).remove();
                    $("#city_id").append($("<option><option>").val('').html(' --- '));

                    $.each(data, function (val, text) {
                        let selectedVal = text.id == "{{ old('city_id', $userAddress->city_id) }}" ? "selected" : "";
                        $("#city_id").append($(`<option value="${text.id}" ${selectedVal}>${text.name}<option>`));
                    });
                }, "json");
            }
        });
    </script>
@endsection
