<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UserAddressRequest;
use App\Models\Country;
use App\Models\UserAddress;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserAddressController extends Controller
{
    public function index(): View
    {
        $this->authorize('access_user_address');
        $userAddresses = UserAddress::with(['user', 'country', 'state', 'city'])
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereDefaultAddress(\request()->status);
            })
            ->orderBy(\request()->sortBy ?? 'id', \request()->orderBy ?? 'desc')
            ->paginate(\request()->limitBy ?? 10);
        return view('backend.user_addresses.index', compact('userAddresses'));
    }

    public function create(): View
    {
        $this->authorize('create_user_address');

        $countries = Country::whereStatus(true)->get(['id', 'name']);

        return view('backend.user_addresses.create', compact('countries'));
    }

    public function store(UserAddressRequest $request): RedirectResponse
    {
        $this->authorize('create_user_address');

        UserAddress::create($request->validated());

        return redirect()->route('admin.user_addresses.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function show(UserAddress $userAddress): View
    {
        $this->authorize('show_user_address');

        return view('backend.user_addresses.show', compact('userAddress'));
    }

    public function edit(UserAddress $userAddress): View
    {
        $this->authorize('edit_user_address');

        $countries = Country::whereStatus(true)->get(['id', 'name']);

        return view('backend.user_addresses.edit', compact('userAddress', 'countries'));
    }

    public function update(UserAddressRequest $request, UserAddress $userAddress): RedirectResponse
    {
        $this->authorize('edit_user_address');

        $userAddress->update($request->validated());

        return redirect()->route('admin.user_addresses.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(UserAddress $userAddress): RedirectResponse
    {
        $this->authorize('delete_user_address');

        $userAddress->delete();

        return redirect()->route('admin.user_addresses.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
