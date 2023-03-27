<?php

namespace App\Http\Controllers\admin;

use App\Models\Branch;
use App\Models\Fueltype;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class FuelTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $fuelTypes = Fueltype::with('user:id,name')->orderBy('id', 'DESC')->get();
        return view('admin.settings.fuel-types.index', compact('fuelTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $branches = Branch::where('id', '!=', 1)->get(['id', 'name']);
        return view('admin.settings.fuel-types.create', compact('branches'));
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
            'fuel_type' => ['required', 'string', 'max:191'],
            'branch_id' => ['required'],
        ]);
        $output = false;
        try {
            DB::beginTransaction();
            Fueltype::create([
                'fuel_type' => $request->input('fuel_type'),
                'branch_id' => $request->input('branch_id'),
                'user_id' => auth()->id()
            ]);
            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('Added', 'Fuel Type Added');
            return redirect()->route('admin.settings.fuel-types.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.fuel-types.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Fueltype $fuelType
     * @return View
     */
    public function edit(Fueltype $fuelType): View
    {
        $branches = Branch::where('id', '!=', 1)->get(['id', 'name']);
        return view('admin.settings.fuel-types.edit', compact('fuelType','branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Fueltype $fuelType
     * @return RedirectResponse
     */
    public function update(Request $request, Fueltype $fuelType): RedirectResponse
    {
        $request->validate([
            'fuel_type' => ['required', 'string', 'max:191'],
            'branch_id' => ['required'],
        ]);

        $output = false;
        try {
            DB::beginTransaction();

            $fuelType->update(
                ['fuel_type' => $request->input('fuel_type')],
                ['branch_id' => $request->input('branch_id')],
            );

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('updated', 'Fuel Type Updated');
            return redirect()->route('admin.settings.fuel-types.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.fuel-types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Fueltype $fuelType
     * @return RedirectResponse
     */
    public function destroy(Fueltype $fuelType): RedirectResponse
    {
        $output = false;
        try {
            DB::beginTransaction();

            $fuelType->delete();

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('success', 'Fuel Type Deleted Successfully');
            return redirect()->route('admin.settings.fuel-types.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.fuel-types.index');
    }
}
