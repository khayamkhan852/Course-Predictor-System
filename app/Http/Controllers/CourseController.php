<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Controllers\Controller;
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
        return view('');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
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
     * @param  \App\Models\Course  $course
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
     * @param  \App\Models\Course  $course
     * @return View
     */
    public function edit(Course $course): View
    {
        return view('', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return RedirectResponse
     */
    public function update(Request $request, Course $course): RedirectResponse
    {
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
     * @param  \App\Models\Course  $course
     * @return RedirectResponse
     */
    public function destroy(Course $course): RedirectResponse
    {
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
