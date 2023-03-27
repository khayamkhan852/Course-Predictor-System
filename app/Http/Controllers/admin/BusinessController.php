<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessSettingRequest;
use App\Http\Requests\BusinessUpdateRequest;
use App\Models\Branch;
use App\Models\BusinessSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index() : View
    {
        $businessSettings = BusinessSetting::with('media')
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.settings.business.index', compact('businessSettings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create() : View
    {
        $branches = Branch::where('id', '!=', 1)->get(['id', 'name']);
        return view('admin.settings.business.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BusinessSettingRequest $request
     * @return RedirectResponse
     */
    public function store(BusinessSettingRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $business = BusinessSetting::create($request->validated() + [
                'user_id' => auth()->id()
            ]);
            if ($request->hasFile('business_logo')) {
                $business->addMediaFromRequest('business_logo')->toMediaCollection('businesses');
            }
            DB::commit();
            alert()->success('success', 'Business added!');
        } catch (\Exception|\error $error) {
            DB::rollBack();
            alert()->error('failed', 'Something Went Wrong! Try again');
        }

        return redirect()->route('admin.settings.business-settings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param BusinessSetting $businessSetting
     * @return View
     */
    public function show(BusinessSetting $businessSetting): View
    {
        $businessSetting->load('media');
        return view('admin.settings.business.show', compact('businessSetting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BusinessSetting $businessSetting
     * @return View
     */
    public function edit(BusinessSetting $businessSetting): View
    {
        $businessSetting->load('media');
        $branches = Branch::where('id', '!=', 1)->get(['id', 'name']);
        return view('admin.settings.business.edit', compact('businessSetting','branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BusinessUpdateRequest $request
     * @param BusinessSetting $businessSetting
     * @return RedirectResponse
     */
    public function update(BusinessUpdateRequest $request, BusinessSetting $businessSetting): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $businessSetting->update($request->validated());
            if ($request->hasFile('business_logo')) {
                $businessSetting->clearMediaCollection('businesses');
                $businessSetting->addMediaFromRequest('business_logo')->toMediaCollection('businesses');
            }
            DB::commit();
            alert()->success('success', 'Business Updated!');
        } catch (\Exception|\error $error) {
            DB::rollBack();
            alert()->error('failed', 'Something Went Wrong! Try again');
        }

        return redirect()->route('admin.settings.business-settings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BusinessSetting $businessSetting
     * @return RedirectResponse
     */
    public function destroy(BusinessSetting $businessSetting): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $businessSetting->delete();
            DB::commit();
            alert()->success('success', 'Business deleted!');
        } catch (\Exception|\error $error) {
            DB::rollBack();
            alert()->error('failed', 'Something Went Wrong! Try again');
        }

        return redirect()->route('admin.settings.business-settings.index');
    }
}
