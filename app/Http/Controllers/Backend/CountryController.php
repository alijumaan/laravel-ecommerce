<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CountryRequest;
use App\Models\Country;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CountryController extends Controller
{
    public function index(): View
    {
        $this->authorize('access_country');

        $countries = Country::with('states')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sortBy ?? 'id', \request()->orderBy ?? 'desc')
            ->paginate(\request()->limitBy ?? 10);

        return view('backend.countries.index', compact('countries'));
    }

    public function create(): View
    {
        $this->authorize('create_country');

        return view('backend.countries.create');
    }

    public function store(CountryRequest $request): RedirectResponse
    {
        $this->authorize('create_country');

        Country::create($request->validated());

        return redirect()->route('admin.countries.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function show(Country $country): View
    {
        $this->authorize('show_country');

        return view('backend.countries.show', compact('country'));
    }

    public function edit(Country $country): View
    {
        $this->authorize('edit_country');

        return view('backend.countries.edit', compact('country'));
    }

    public function update(CountryRequest $request, Country $country): RedirectResponse
    {
        $this->authorize('edit_country');

        $country->update($request->validated());

        return redirect()->route('admin.countries.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Country $country): RedirectResponse
    {
        $this->authorize('delete_country');

        $country->delete();

        return redirect()->route('admin.countries.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
