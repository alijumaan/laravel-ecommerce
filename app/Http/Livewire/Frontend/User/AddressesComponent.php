<?php

namespace App\Http\Livewire\Frontend\User;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\UserAddress;
use Livewire\Component;

class AddressesComponent extends Component
{
    public $showForm = false;
    public $editMode = false;
    public $address_id = '';
    public $address_title = '';
    public $default_address = '';
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $phone = '';
    public $address = '';
    public $address2 = '';
    public $countries;
    public $states = [];
    public $cities = [];
    public $country_id;
    public $state_id;
    public $city_id;
    public $zip_code = '';
    public $po_box = '';

    public function rules()
    {
        return [
            'address_title' => ['required', 'string'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'numeric'],
            'address' => ['required', 'string'],
            'country_id' => ['required'],
            'state_id' => ['required'],
            'city_id' => ['required'],
            'zip_code' => ['required', 'numeric', 'min:10000', 'max:99999'],
            'po_box' => ['required', 'numeric', 'min:1000', 'max:9999'],
        ];
    }

    public function validationAttributes()
    {
        return [
            'country_id' => 'country',
            'state_id' => 'state',
            'city_id' => 'city',
            'zip_code' => 'ZIP Code',
            'po_box' => 'P.O.Box',
        ];
    }

    public function storeAddress()
    {
        $this->validate();

        $address = auth()->user()->addresses()->create($this->formData());

        if ($this->default_address) {
            auth()->user()->addresses()->where('id', '!=', $address->id)->update([
                'default_address' => false,
            ]);
        }

        $this->resetForm();
        $this->showForm = false;
        $this->alert('success', 'Address created successfully');
    }

    public function editAddress($id)
    {
        $address = UserAddress::find($id);

        $this->address_id = $address->id;
        $this->address_title = $address->address_title;
        $this->default_address = $address->default_address;
        $this->first_name = $address->first_name;
        $this->last_name = $address->last_name;
        $this->email = $address->email;
        $this->phone = $address->phone;
        $this->address = $address->address;
        $this->address2 = $address->address2;
        $this->country_id = $address->country_id;
        $this->state_id = $address->state_id;
        $this->city_id = $address->city_id;
        $this->zip_code = $address->zip_code;
        $this->po_box = $address->po_box;

        $this->showForm = true;
        $this->editMode = true;
    }

    public function updateAddress()
    {
        $this->validate();

        auth()->user()->addresses()
            ->where('id', $this->address_id)
            ->update($this->formData());

        if ($this->default_address) {
            auth()->user()->addresses()->where('id', '!=', $this->address_id)->update([
                'default_address' => false,
            ]);
        }

        $this->resetForm();
        $this->showForm = false;
        $this->alert('success', 'Address updated successfully');
    }

    public function deleteAddress($id)
    {
        $address = auth()->user()->addresses()->where('id', $id)->first();
        if ($address->default_address) {
            auth()->user()->addresses()->first()->update(['default_address' => true]);
        }
        $address->delete();
        $this->alert('success', 'Address deleted successfully');
    }

    public function resetForm()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function formData(): array
    {
        return [
            'address_title' => $this->address_title,
            'default_address' => $this->default_address,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'address2' => $this->address2,
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'zip_code' => $this->zip_code,
            'po_box' => $this->po_box,
        ];
    }

    public function render()
    {
        $this->countries = Country::whereStatus(true)->get(['id', 'name']);
        $this->states = $this->country_id != '' ? State::whereStatus(true)->whereCountryId($this->country_id)->get(['id', 'name']) : [];
        $this->cities = $this->state_id != '' ? City::whereStatus(true)->whereStateId($this->state_id)->get(['id', 'name']) : [];

        return view('livewire.frontend.user.addresses-component', [
            'addresses' => auth()->user()->addresses,
            'countries' => $this->countries,
            'states' => $this->states,
            'cities' => $this->cities,
        ]);
    }
}
