<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\CreatePartnerRequest;
use App\Http\Requests\PartnerEditRequest;
use App\Models\Branch;
use App\Models\Partner;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $partners = Partner::with('user:id,name', 'media')->orderBy('id', 'DESC')->get();
        return view('admin.settings.partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $branches = Branch::where('id', '!=', 1)->get(['id', 'name']);
        return view('admin.settings.partners.create' , compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePartnerRequest $request
     * @return RedirectResponse
     */
    public function store(CreatePartnerRequest $request): RedirectResponse
    {
        $output = false;
        try {
            DB::beginTransaction();

            $partner = Partner::create($request->validated() + [
                'user_id' => auth()->id()
            ]);

            if ($request->hasFile('partner_image')) {
                $partner->addMediaFromRequest('partner_image')->toMediaCollection('partners');
            }

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('success', 'Partner added!');
            return redirect()->route('admin.settings.partners.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.partners.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Partner $partner
     * @return View
     */
    public function edit(Partner $partner): View
    {
        $branches = Branch::where('id', '!=', 1)->get(['id', 'name']);
        return view('admin.settings.partners.edit', compact('partner','branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PartnerEditRequest $request
     * @param Partner $partner
     * @return RedirectResponse
     */
    public function update(PartnerEditRequest $request, Partner $partner): RedirectResponse
    {
        $output = false;
        try {
            DB::beginTransaction();

            $partner->update($request->validated());
            if ($request->hasFile('partner_image')) {
                $partner->clearMediaCollection('partners');
                $partner->addMediaFromRequest('partner_image')->toMediaCollection('partners');
            }
            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('updated', 'Partner Updated Successfully');
            return redirect()->route('admin.settings.partners.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.partners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Partner $partner
     * @return RedirectResponse
     */
    public function destroy(Partner $partner): RedirectResponse
    {
        $output = false;
        try {
            DB::beginTransaction();
            $partner->delete();
            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('deleted', 'Partner Deleted');
            return redirect()->route('admin.settings.partners.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.partners.index');
    }
}
