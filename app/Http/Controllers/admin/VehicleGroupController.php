<?php

namespace App\Http\Controllers\admin;

use App\Models\Branch;
use App\Models\Vgroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class VehicleGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $vehicleGroups = Vgroup::with('user:id,name')->orderBy('id', 'DESC')->get();
        return view('admin.settings.vehicle-groups.index', compact('vehicleGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $branches = Branch::where('id', '!=', 1)->get(['id', 'name']);
        return view('admin.settings.vehicle-groups.create' ,compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'group_name' => ['required', 'string', 'max:191'],
            'branch_id' => ['required'],
        ]);
        $output = false;
        try {
            DB::beginTransaction();
            Vgroup::create([
                'group_name' => $request->input('group_name'),
                'branch_id' => $request->input('branch_id'),
                'user_id' => auth()->id()
            ]);
            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('Added', 'Vehicle Group Added');
            return redirect()->route('admin.settings.vehicle-groups.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.vehicle-groups.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Vgroup $vehicleGroup
     * @return View
     */
    public function edit(Vgroup $vehicleGroup): View
    {
        $branches = Branch::where('id', '!=', 1)->get(['id', 'name']);
        return view('admin.settings.vehicle-groups.edit', compact('vehicleGroup','branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Vgroup $vehicleGroup
     * @return RedirectResponse
     */
    public function update(Request $request, Vgroup $vehicleGroup): RedirectResponse
    {
        $request->validate([
            'group_name' => ['required', 'string', 'max:191'],
            'branch_id' => ['required'],
        ]);

        $output = false;
        try {
            DB::beginTransaction();

            $vehicleGroup->update(
                ['group_name' => $request->input('group_name')],
                ['branch_id' => $request->input('branch_id')],
            );

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('updated', 'Vehicle Group Updated');
            return redirect()->route('admin.settings.vehicle-groups.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.vehicle-groups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Vgroup $vehicleGroup
     * @return RedirectResponse
     */
    public function destroy(Vgroup $vehicleGroup): RedirectResponse
    {
        $output = false;
        try {
            DB::beginTransaction();

            $vehicleGroup->delete();

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('success', 'Vehicle Group Deleted Successfully');
            return redirect()->route('admin.settings.vehicle-groups.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.vehicle-groups.index');
    }
}
