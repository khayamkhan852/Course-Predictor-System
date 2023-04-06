<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $departments = Department::all();
        return view('department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('department.create');
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
           'name' => ['required', 'string'],
           'short_name' => ['required', 'string'],
        ]);

        $output = false;
        try {
            DB::beginTransaction();

            Department::create([
                'name' => $request->input('name'),
                'short_name' => $request->input('short_name'),
            ]);


            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('added', 'Department Added Successfully');
            return redirect()->route('departments.index');
        }
        alert()->error('error', 'Something went wrong');
        return redirect()->route('departments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Department $department
     * @return View
     */
    public function show(Department $department): View
    {
        return view('department.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Department $department
     * @return View
     */
    public function edit(Department $department): View
    {
        return view('department.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Department $department
     * @return RedirectResponse
     */
    public function update(Request $request, Department $department): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string'],
            'short_name' => ['required', 'string'],
        ]);
        $output = false;
        try {
            DB::beginTransaction();

            $department->update([
                'name' => $request->input('name'),
                'short_name' => $request->input('short_name'),
            ]);

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('added', 'Department Updated Successfully');
            return redirect()->route('departments.index');
        }
        alert()->error('error', 'Something went wrong');
        return redirect()->route('departments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Department $department
     * @return RedirectResponse
     */
    public function destroy(Department $department): RedirectResponse
    {
        $output = false;
        try {
            DB::beginTransaction();

            $department->delete();

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('added', 'Department Deleted Successfully');
            return redirect()->route('departments.index');
        }
        alert()->error('error', 'Something went wrong');
        return redirect()->route('departments.index');
    }
}
