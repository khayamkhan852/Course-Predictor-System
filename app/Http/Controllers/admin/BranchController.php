<?php

namespace App\Http\Controllers\admin;

use App\Models\Branch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $branches = Branch::where('id', '!=', 1)->orderBy('id', 'DESC')->get();
        return view('admin.settings.branches.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.settings.branches.create');
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
            'name' => ['required', 'string', 'max:191']
        ]);
        $output = false;
        try {
            DB::beginTransaction();

            Branch::create([
                'name' => $request->input('name'),
            ]);

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('success', 'Branch Added');
            return redirect()->route('admin.settings.branches.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.branches.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Branch $branch
     * @return View
     */
    public function edit(Branch $branch): View
    {
        return view('admin.settings.branches.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Branch $branch
     * @return RedirectResponse
     */
    public function update(Request $request, Branch $branch): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:191']
        ]);
        $output = false;
        try {
            DB::beginTransaction();

            $branch->update(['name' => $request->input('name')]);

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('success', 'branch Updated!');
            return redirect()->route('admin.settings.branches.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.branches.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Branch $branch
     * @return RedirectResponse
     */
    public function destroy(Branch $branch): RedirectResponse
    {
        $output = false;
        try {
            DB::beginTransaction();

            $branch->delete();

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('success', 'Branch deleted!');
            return redirect()->route('admin.settings.branches.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.settings.branches.index');
    }
}
