<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Vbody;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class VehicleBodyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $vehicleBodies = Vbody::with('user:id,name')->orderBy('id', 'DESC')->get();
        return view('admin.settings.body-types.index', compact('vehicleBodies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $branches = Branch::where('id', '!=', 1)->get(['id', 'name']);
        return view('admin.settings.body-types.create', compact('branches'));
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
            'body_type' => ['required', 'string', 'max:191'],
            'branch_id' => ['required'],
        ]);
        $output = false;
        try {
            DB::beginTransaction();
            Vbody::create([
                'body_type' => $request->input('body_type'),
                'branch_id' => $request->input('branch_id'),
                'user_id' => auth()->id()
            ]);
            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('Added', 'Body Type Added');
            return redirect()->route('admin.settings.vehicle-body-types.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.vehicle-body-types.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Vbody $vehicleBodyType
     * @return View
     */
    public function edit(Vbody $vehicleBodyType): View
    {
        $branches = Branch::where('id', '!=', 1)->get(['id', 'name']);
        return view('admin.settings.body-types.edit', compact('vehicleBodyType','branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Vbody $vehicleBodyType
     * @return RedirectResponse
     */
    public function update(Request $request, Vbody $vehicleBodyType): RedirectResponse
    {
        $request->validate([
            'body_type' => ['required', 'string', 'max:191'],
            'branch_id' => ['required'],
        ]);

        $output = false;
        try {
            DB::beginTransaction();

            $vehicleBodyType->update(
                ['body_type' => $request->input('body_type')],
                ['branch_id' => $request->input('branch_id')],
            );

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('updated', 'Body Type Updated');
            return redirect()->route('admin.settings.vehicle-body-types.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.vehicle-body-types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Vbody $vehicleBodyType
     * @return RedirectResponse
     */
    public function destroy(Vbody $vehicleBodyType): RedirectResponse
    {
        $output = false;
        try {
            DB::beginTransaction();

            $vehicleBodyType->delete();

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('success', 'Body Type Deleted Successfully');
            return redirect()->route('admin.settings.vehicle-body-types.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.vehicle-body-types.index');
    }
}
