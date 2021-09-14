@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/vendor/datepicker/themes/classic.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendor/datepicker/themes/classic.date.css') }}">
    <style>
        .picker__select--month,
        .picker__select--year {
            padding: 0 !important;
        }
    </style>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                Create new coupon
            </h6>
            <div class="ml-auto">
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                    </span>
                    <span class="text">Back to coupons</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.coupons.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input class="form-control" id="code" type="text" name="code" value="{{ old('code') }}">
                            @error('code')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="">---</option>
                                <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : NULL }}>
                                    fixed
                                </option>
                                <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : NULL }}>
                                    percentage
                                </option>
                            </select>
                            @error('type')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="value">Value</label>
                            <input class="form-control" id="value" type="number" name="value"
                                   value="{{ old('value') }}">
                            @error('value')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="use_times">Use times</label>
                            <input class="form-control" id="use_times" type="number" name="use_times"
                                   value="{{ old('use_times') }}">
                            @error('use_times')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="start_date">Start date</label>
                            <input class="form-control" id="start_date" type="date" name="start_date"
                                   value="{{ old('start_date') }}">
                            @error('start_date')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="expire_date">Expire date</label>
                            <input class="form-control" id="expire_date" type="date" name="expire_date"
                                   value="{{ old('expire_date') }}">
                            @error('expire_date')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Greater than</label>
                            <input class="form-control" id="greater_than" type="number" name="greater_than"
                                   value="{{ old('greater_than') }}">
                            @error('greater_than')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">---</option>
                                <option value="1" {{ old('status') == "1" ? 'selected' : null }}>Active</option>
                                <option value="0" {{ old('status') == "0" ? 'selected' : null }}>Inactive</option>
                            </select>
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="is_public">Visibility</label>
                            <select name="is_public" id="is_public" class="form-control">
                                <option value="">---</option>
                                <option value="1" {{ old('is_public') == "1" ? 'selected' : null }}>Public</option>
                                <option value="0" {{ old('is_public') == "0" ? 'selected' : null }}>Private</option>
                            </select>
                            @error('is_public')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input class="form-control" id="description" type="text" name="description"
                                   value="{{ old('description') }}">
                            @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group pt-4">
                    <button class="btn btn-primary" type="submit" name="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('backend/vendor/datepicker/picker.js') }}"></script>
    <script src="{{ asset('backend/vendor/datepicker/picker.date.js') }}"></script>
    <script>
        $(function () {
            $('#code').keyup(function () {
                this.value = this.value.toUpperCase();
            });

            $("#start_date").pickadate({
                format: 'yyyy-mm-dd',
                selectMonths: true, // creates a dropdown to control month
                selectYears: true, // Creates a dropdown to control year
                clear: 'Clear',
                close: 'Ok',
                closeOnSelect: true, // Close upon selecting a date
            });

            var startdate = $('#start_date').pickadate('picker');
            var enddate = $('#expire_date').pickadate('picker');

            $("#start_date").change(function () {
               selected_ci_date = "";
                selected_ci_date = $('#start_date').val();
                if (selected_ci_date != null) {
                    var cidate = new Date(selected_ci_date);
                    min_codate = "";
                    min_codate = new Date();
                    min_codate.setDate(cidate.getDate() + 1);
                    enddate.set('min', min_codate);

                }
            });

            $('#expire_date').pickadate({
                format: 'yyyy-mm-dd',
                min: new Date(),
                selectMonths: true, // creates a dropdown to control month
                selectYears: true, // Creates a dropdown to control year
                clear: 'Clear',
                close: 'Ok',
                closeOnSelect: true, // Close upon selecting a date
            });
        });
    </script>
@endsection
