<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class SemesterController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (! auth()->user()->can('semesters.view')) {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $semesters = Semester::with(['department:id,name'])->latest('year')->get();
        return view('semesters.index', compact('semesters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        if (! auth()->user()->can('semesters.create')) {
            abort(403, 'Unauthorized action.');
        }

        $departments = Department::get(['id', 'name']);

        return view('semesters.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if (! auth()->user()->can('semesters.create')) {
            abort(403, 'Unauthorized action.');
        }

        $data = $request->validate([
            'name' => ['required', 'string'],
            'year' => ['required', 'numeric'],
            'total_credit_hours' => ['nullable', 'numeric'],
            'department_id' => ['required', 'numeric'],
        ]);

        Semester::create($data);

        alert()->success('added', 'Semester Added Successfully');
        return redirect()->route('semesters.index');

    }

    /**
     * Display the specified resource.
     *
     * @param Semester $semester
     * @return View
     */
    public function show(Semester $semester): View
    {
        // eager loading relationship if any
        $semester->load([
            'department:id,name,short_name'
        ]);
        return view('semesters.show', compact('semester'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Semester $semester
     * @return View
     */
    public function edit(Semester $semester): View
    {
        if (! auth()->user()->can('semesters.update')) {
            abort(403, 'Unauthorized action.');
        }

        $departments = Department::get(['id', 'name']);

        return view('semesters.edit', compact('departments', 'semester'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Semester $semester
     * @return RedirectResponse
     */
    public function update(Request $request, Semester $semester): RedirectResponse
    {
        if (! auth()->user()->can('semesters.update')) {
            abort(403, 'Unauthorized action.');
        }

        $data = $request->validate([
            'name' => ['required', 'string'],
            'year' => ['required', 'numeric'],
            'total_credit_hours' => ['nullable', 'numeric'],
            'department_id' => ['required', 'numeric'],
        ]);

        $semester->update($data);

        alert()->success('updated', 'Semester Updated Successfully');
        return redirect()->route('semesters.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Semester $semester
     * @return RedirectResponse
     */
    public function destroy(Semester $semester): RedirectResponse
    {
        if (! auth()->user()->can('semesters.delete')) {
            abort(403, 'Unauthorized action.');
        }

        $output = false;
        try {
            DB::beginTransaction();

            $semester->delete();

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('Deleted', 'Semester Deleted Successfully');
            return redirect()->route('semesters.index');
        }
        alert()->error('error', 'something went wrong, There May be other Records against this'. $semester->name);
        return redirect()->route('semesters.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Semester $semester
     * @return View
     */
    public function assignCoursesView(Semester $semester): View
    {
        if (! auth()->user()->can('semesters.assign_courses')) {
            abort(403, 'Unauthorized action.');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Semester $semester
     * @return RedirectResponse
     */
    public function assignCourses(Request $request, Semester $semester): RedirectResponse
    {
        if (! auth()->user()->can('semesters.assign_courses')) {
            abort(403, 'Unauthorized action.');
        }



    }
}
