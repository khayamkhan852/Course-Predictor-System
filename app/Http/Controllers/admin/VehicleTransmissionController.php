<?php

namespace App\Http\Controllers\admin;

use App\Models\Branch;
use App\Models\Vtransmission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class VehicleTransmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $vehicleTransmissions = Vtransmission::with('user:id,name')->orderBy('id', 'DESC')->get();
        return view('admin.settings.vehicle-transmissions.index', compact('vehicleTransmissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $branches = Branch::where('id', '!=', 1)->get(['id', 'name']);
        return view('admin.settings.vehicle-transmissions.create', compact('branches'));
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
            'v_transmission' => ['required', 'string', 'max:191'],
            'branch_id' => ['required'],
        ]);
        $output = false;
        try {
            DB::beginTransaction();
            Vtransmission::create([
                'v_transmission' => $request->input('v_transmission'),
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
            alert()->success('Added', 'Vehicle Transmission Added');
            return redirect()->route('admin.settings.vehicle-transmissions.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.vehicle-transmissions.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Vtransmission $vehicleTransmission
     * @return View
     */
    public function edit(Vtransmission $vehicleTransmission): View
    {
        $branches = Branch::where('id', '!=', 1)->get(['id', 'name']);
        return view('admin.settings.vehicle-transmissions.edit', compact('vehicleTransmission','branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Vtransmission $vehicleTransmission
     * @return RedirectResponse
     */
    public function update(Request $request, Vtransmission $vehicleTransmission): RedirectResponse
    {
        $request->validate([
            'v_transmission' => ['required', 'string', 'max:191'],
            'branch_id' => ['required'],
        ]);

        $output = false;
        try {
            DB::beginTransaction();

            $vehicleTransmission->update(
                ['v_transmission' => $request->input('v_transmission')],
                ['branch_id' => $request->input('branch_id')],
            );

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('updated', 'Vehicle Transmission Updated');
            return redirect()->route('admin.settings.vehicle-transmissions.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.vehicle-transmissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Vtransmission $vehicleTransmission
     * @return RedirectResponse
     */
    public function destroy(Vtransmission $vehicleTransmission): RedirectResponse
    {
        $output = false;
        try {
            DB::beginTransaction();

            $vehicleTransmission->delete();

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('success', 'Vehicle Transmission Deleted Successfully');
            return redirect()->route('admin.settings.vehicle-transmissions.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.vehicle-transmissions.index');
    }
}
