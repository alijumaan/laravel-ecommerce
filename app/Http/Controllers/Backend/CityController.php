<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CityRequest;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CityController extends Controller
{
    public function index(): View
    {
        $this->authorize('access_city');

        $cities = City::with('state')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sortBy ?? 'id', \request()->orderBy ?? 'desc')
            ->paginate(\request()->limitBy ?? 10);

        return view('backend.cities.index', compact('cities'));
    }

    public function create(): View
    {
        $this->authorize('create_city');

        $states = State::get(['id', 'name']);

        return view('backend.cities.create', compact('states'));
    }

    public function store(CityRequest $request): RedirectResponse
    {
        $this->authorize('create_city');

        City::create($request->validated());

        return redirect()->route('admin.cities.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function show(City $city): View
    {
        $this->authorize('show_city');

        return view('backend.cities.show', compact('city'));
    }

    public function edit(City $city): View
    {
        $this->authorize('edit_city');

        $states = State::get(['id', 'name']);

        return view('backend.cities.edit', compact('city', 'states'));
    }

    public function update(CityRequest $request, City $city): RedirectResponse
    {
        $this->authorize('edit_city');

        $city->update($request->validated());

        return redirect()->route('admin.cities.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(City $city): RedirectResponse
    {
        $this->authorize('delete_city');

        $city->delete();

        return redirect()->route('admin.cities.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }

    public function get_cities(Request $request): JsonResponse
    {
        $cities = City::whereStateId($request->state_id)
            ->whereStatus(true)
            ->get(['id', 'name'])
            ->toArray();

        return response()->json($cities);
    }
}
