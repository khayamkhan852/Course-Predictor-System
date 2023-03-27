<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Vdrive;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class VehicleDriveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $vehicleDrives = Vdrive::with('user:id,name')->orderBy('id', 'DESC')->get();
        return view('admin.settings.vehicle-drives.index', compact('vehicleDrives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $branches = Branch::where('id', '!=', 1)->get(['id', 'name']);
        return view('admin.settings.vehicle-drives.create', compact('branches'));
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
            'vehicle_drive' => ['required', 'string', 'max:191'],
            'branch_id' => ['required'],
        ]);
        $output = false;
        try {
            DB::beginTransaction();
            Vdrive::create([
                'vehicle_drive' => $request->input('vehicle_drive'),
                'branch_id' => $request->input('branch_id'),
                'user_id' => auth()->id()
            ]);
            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
            dd($error);
        }

        if ($output) {
            alert()->success('Added', 'Vehicle Drive Added');
            return redirect()->route('admin.settings.vehicle-drives.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.vehicle-drives.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Vdrive $vehicleDrive
     * @return View
     */
    public function edit(Vdrive $vehicleDrive): View
    {
        $branches = Branch::where('id', '!=', 1)->get(['id', 'name']);
        return view('admin.settings.vehicle-drives.edit', compact('vehicleDrive','branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Vdrive $vehicleDrive
     * @return RedirectResponse
     */
    public function update(Request $request, Vdrive $vehicleDrive): RedirectResponse
    {
        $request->validate([
            'vehicle_drive' => ['required', 'string', 'max:191'],
            'branch_id' => ['required'],
        ]);

        $output = false;
        try {
            DB::beginTransaction();

            $vehicleDrive->update(
                ['vehicle_drive' => $request->input('vehicle_drive')],
                ['branch_id' => $request->input('branch_id')],
            );

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('updated', 'Vehicle Drive Updated');
            return redirect()->route('admin.settings.vehicle-drives.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.vehicle-drives.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Vdrive $vehicleDrive
     * @return RedirectResponse
     */
    public function destroy(Vdrive $vehicleDrive): RedirectResponse
    {
        $output = false;
        try {
            DB::beginTransaction();

            $vehicleDrive->delete();

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('success', 'Vehicle Drive Deleted Successfully');
            return redirect()->route('admin.settings.vehicle-drives.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.vehicle-drives.index');
    }
}
