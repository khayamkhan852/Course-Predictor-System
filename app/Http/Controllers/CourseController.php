<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (! auth()->user()->can('courses.view')) {
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
        $courses = Course::with([
            'coordinator:id,name',
            'department:id,name,short_name',
        ])->latest('id')->get();
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        if (! auth()->user()->can('courses.create')) {
            abort(403, 'Unauthorized action.');
        }

        $departments = Department::get(['id', 'name']);
        return view('courses.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if (! auth()->user()->can('courses.create')) {
            abort(403, 'Unauthorized action.');
        }

        $output = false;
        try {
            DB::beginTransaction();
            // store code goes here

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('title', 'description');
            return redirect()->route('.index');
        }
        alert()->error('error', 'something went wrong');
        return redirect()->route('.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Course $course
     * @return View
     */
    public function show(Course $course): View
    {
        // eager loading relationship if any
        $course->load();
        return view('', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Course $course
     * @return View
     */
    public function edit(Course $course): View
    {
        if (! auth()->user()->can('courses.update')) {
            abort(403, 'Unauthorized action.');
        }

        return view('', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Course $course
     * @return RedirectResponse
     */
    public function update(Request $request, Course $course): RedirectResponse
    {
        if (! auth()->user()->can('courses.update')) {
            abort(403, 'Unauthorized action.');
        }

        $output = false;
        try {
            DB::beginTransaction();

            $course->update([

            ]);

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('title', 'description');
            return redirect()->route('.index');
        }
        alert()->error('error', 'something went wrong');
        return redirect()->route('.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Course $course
     * @return RedirectResponse
     */
    public function destroy(Course $course): RedirectResponse
    {
        if (! auth()->user()->can('courses.delete')) {
            abort(403, 'Unauthorized action.');
        }

        $output = false;
        try {
            DB::beginTransaction();

            $course->delete();

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('title', 'description');
            return redirect()->route('.index');
        }
        alert()->error('error', 'something went wrong');
        return redirect()->route('.index');
    }
}
