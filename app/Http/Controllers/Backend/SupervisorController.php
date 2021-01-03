<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupervisorRequest;
use App\Models\User;
use App\Repositories\Backend\SupervisorRepository;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public $supervisor;

    public function __construct(SupervisorRepository $supervisor)
    {
        $this->supervisor = $supervisor;
        $this->middleware('superAdmin');
    }

    public function index()
    {
        $supervisors = $this->supervisor->index();

        return view('backend.supervisors.index', compact(  'supervisors'));
    }

    public function create()
    {
        abort_if(!auth()->user()->can('add-user'), 403, 'You did not have permission to access this page!');

        return view('backend.supervisors.create');
    }

    public function store(StoreSupervisorRequest $request)
    {
        $this->supervisor->store($request);

        return redirect()->route('admin.supervisors.index')->with(['message' => 'User create successfully', 'alert-type' => 'success']);
    }

    public function show(User $supervisor)
    {
        return view('backend.supervisors.show', compact('supervisor'));
    }

    public function edit(User $supervisor)
    {
        abort_if(!auth()->user()->can('edit-user'), 403, 'You did not have permission to access this page!');

        return view('backend.supervisors.edit', compact('supervisor'));

    }

    public function update(Request $request, User $supervisor)
    {
        $this->supervisor->update($request, $supervisor);

        return redirect()->route('admin.supervisors.index')->with(['message' => 'Supervisor updated successfully', 'alert-type' => 'success']);


    }

    public function destroy(User $supervisor)
    {
        $this->supervisor->delete($supervisor);

        return redirect()->route('admin.supervisors.index')->with(['message' => 'Supervisor deleted successfully', 'alert-type' => 'success']);
    }

    public function removeImage(Request $request, User $supervisor)
    {
        $this->supervisor->removeImage($request, $supervisor);
    }
}
