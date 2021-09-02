<?php

namespace App\Http\Controllers\Backend_old;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ShippinCompanyRequest;
use App\Models\Country;
use App\Models\ShippingCompany;
use Illuminate\Http\Request;

class ShippingCompanyController extends Controller
{
    public function index()
    {
        $this->authorize('access_shipping_company');

        $shippingCompanies = ShippingCompany::withCount('countries')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sortBy ?? 'id', \request()->orderBy ?? 'desc')
            ->paginate(\request()->limitBy ?? 10);

        return view('backend.shipping_companies.index', compact('shippingCompanies'));
    }

    public function create()
    {
        $this->authorize('create_shipping_company');

        $countries = Country::whereStatus(true)->orderBy('id', 'asc')->get(['id', 'name']);

        return view('backend.shipping_companies.create', compact('countries'));
    }

    public function store(ShippinCompanyRequest $request)
    {
        $this->authorize('create_shipping_company');

        if ($request->validated()){
            $shippingCompany = ShippingCompany::create($request->except('countries', '_token'));
            $shippingCompany->countries()->attach($request->countries);

            return redirect()->route('admin.shipping_companies.index')->with([
                'message' => 'Created successfully',
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => 'Something was wrong, please try again late',
                'alert-type' => 'danger'
            ]);
        }
    }

    public function show(ShippingCompany $shippingCompany)
    {
        $this->authorize('show_shipping_company');

        return view('backend.shipping_companies.show', compact('shippingCompany'));
    }

    public function edit(ShippingCompany $shippingCompany)
    {
        $this->authorize('edit_shipping_company');

        $shippingCompany->with('countries');
        $countries = Country::whereStatus(true)->orderBy('id', 'asc')->get(['id', 'name']);

        return view('backend.shipping_companies.edit', compact('shippingCompany', 'countries'));
    }

    public function update(ShippinCompanyRequest $request, ShippingCompany $shippingCompany)
    {
        $this->authorize('edit_shipping_company');

        if ($request->validated()){
            $shippingCompany->update($request->except('countries', '_token', '_method'));
            $shippingCompany->countries()->sync($request->countries);

            return redirect()->route('admin.shipping_companies.index')->with([
                'message' => 'Updated successfully',
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => 'Something was wrong, please try again late',
                'alert-type' => 'danger'
            ]);
        }
    }

    public function destroy(ShippingCompany $shippingCompany)
    {
        $this->authorize('delete_shipping_company');

        $shippingCompany->delete();

        return redirect()->route('admin.shipping_companies.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
