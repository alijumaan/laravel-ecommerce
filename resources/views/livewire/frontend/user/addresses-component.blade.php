<div x-data="{ formShow: @entangle('showForm') }">
    <div class="d-flex">
        <h2 class="h5 text-uppercase mb-4">Addresses</h2>
        <div class="ml-auto">
            <button type="button" @click="formShow = true" class="btn btn-dark rounded shadow">
                Add new address
            </button>
        </div>
    </div>

    <form wire:submit.prevent="{{ $editMode ? 'updateAddress' : 'storeAddress' }}" x-show="formShow" @click.away="formShow = false">
        @if ($editMode)
            <input type="hidden" wire:model="address_id">
        @endif
        <div class="row">
            <div class="col-lg-8 form-group">
                <label class="text-small text-uppercase" for="address_title">Address title</label>
                <input class="form-control" wire:model="address_title" type="text" placeholder="Enter your address title">
                @error('address_title')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-4 form-group">
                <label class="text-small text-uppercase">&nbsp;</label>
                <div class="form-check">
                    <input class="form-check-input" id="default_address" wire:model="default_address" type="checkbox">
                    <label class="form-check-label" for="default_address">Default address?</label>
                </div>
            </div>
            <div class="col-lg-6 form-group">
                <label class="text-small text-uppercase" for="first_name">First name</label>
                <input class="form-control form-control-lg" wire:model="first_name" type="text" placeholder="Enter your first name">
                @error('first_name')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-6 form-group">
                <label class="text-small text-uppercase" for="last_name">Last name</label>
                <input class="form-control form-control-lg" wire:model="last_name" type="text" placeholder="Enter your last name">
                @error('last_name')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-6 form-group">
                <label class="text-small text-uppercase" for="email">Email address</label>
                <input class="form-control form-control-lg" wire:model="email" type="email" placeholder="e.g. Jason@example.com">
                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-6 form-group">
                <label class="text-small text-uppercase" for="phone">Phone number</label>
                <input class="form-control form-control-lg" wire:model="phone" type="tel" placeholder="e.g. 966512345678">
                @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="col-lg-6 form-group">
                <label class="text-small text-uppercase" for="address">address</label>
                <input class="form-control form-control-lg" wire:model="address" type="text" placeholder="Enter your first name">
                @error('address')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-6 form-group">
                <label class="text-small text-uppercase" for="address2">address2</label>
                <input class="form-control form-control-lg" wire:model="address2" type="text" placeholder="Enter your last name">
                @error('address2')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-4 form-group">
                <label class="text-small text-uppercase" for="country_id">Country</label>
                <select class="form-control form-control-lg" wire:model="country_id">
                    <option value="">Select Country</option>
                    @forelse($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @empty
                    @endforelse
                </select>
                @error('country_id')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-4 form-group">
                <label class="text-small text-uppercase" for="state_id">State</label>
                <select class="form-control form-control-lg" wire:model="state_id">
                    <option value="">Select State</option>
                    @forelse($states as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @empty
                    @endforelse
                </select>
                @error('state_id')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-4 form-group">
                <label class="text-small text-uppercase" for="city_id">City</label>
                <select class="form-control form-control-lg" wire:model="city_id">
                    <option value="">Select City</option>
                    @forelse($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @empty
                    @endforelse
                </select>
                @error('city_id')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="col-lg-6 form-group">
                <label class="text-small text-uppercase" for="zip_code">ZIP Code</label>
                <input class="form-control form-control-lg" wire:model="zip_code" type="text" placeholder="Enter your first name">
                @error('zip_code')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-6 form-group">
                <label class="text-small text-uppercase" for="po_box">P.O.Box</label>
                <input class="form-control form-control-lg" wire:model="po_box" type="text" placeholder="Enter your last name">
                @error('po_box')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-12 form-group">
                <button class="btn btn-dark" type="submit">
                    {{ $editMode ? 'Update address' : 'Add address' }}
                </button>
            </div>
        </div>
    </form>

    <div class="my-4">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Location</th>
                    <th width="10%"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($addresses as $address)
                    <tr>
                        <td>
                            {{ $address->address_title }}
                            <p class="text-gray-400">{{ $address->default_address }}</p>
                        </td>
                        <td>
                            {{ $address->address }}<br>
                            {{ $address->address2 }}<br>
                            <small>{{ $address->country->name . '-' . $address->state->name . '-' . $address->city->name}}</small>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button type="button" wire:click.prevent="editAddress('{{ $address->id }}')" class="btn btn-primary">
                                    <i class="fa fa-edit fa-sm"></i>
                                </button>
                                <button type="button"
                                        x-on:click.prevent="return confirm('Are you sure?') ? @this.deleteAddress('{{ $address->id }}') : false"
                                        class="btn btn-danger">
                                    <i class="fa fa-trash fa-sm"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
