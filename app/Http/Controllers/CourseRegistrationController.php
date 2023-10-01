<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CourseRegistration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;


class CourseRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        abort_if(! auth()->user()->can('course_registration.view'), '403', 'Unauthorized Action.');

        $registrations = CourseRegistration::when(auth()->user()->hasRole(['Student']), function ($query) {
            $query->where('student_id', auth()->id());
        })->withCount('registrationSemesterCourses')->with([
            'student' => function ($query) {
                $query->with('department:id,name')->select(['id', 'name', 'department_id', 'reg_number']);
            },
            'createdBy:id,name'
        ])->get();

        return view('registrations.index', compact('registrations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        abort_if(! auth()->user()->can('course_registration.create'), '403', 'Unauthorized Action.');

        $students = User::whereHas('roles', function ($query) {
            $query->where('name', 'Student');
        })->when(auth()->user()->hasRole(['Student']), function ($query) {
            $query->where('id', auth()->id());
        })->with('department:id,name')->get(['id', 'name', 'reg_number', 'department_id']);

        return view('registrations.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        abort_if(! auth()->user()->can('course_registration.create'), '403', 'Unauthorized Action.');

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
            return redirect()->route('');
        }
        alert()->success('title', 'description');
        return redirect()->route('');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id): View
    {
        abort_if(! auth()->user()->can('course_registration.view'), '403', 'Unauthorized Action.');

        return view('', compact());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id): View
    {
        abort_if(! auth()->user()->can('course_registration.update'), '403', 'Unauthorized Action.');

        return view('', compact(''));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        abort_if(! auth()->user()->can('course_registration.update'), '403', 'Unauthorized Action.');

        $output = false;
        try {
            DB::beginTransaction();

            // update code goes here

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('title', 'description');
            return redirect()->route('');
        }
        alert()->success('title', 'description');
        return redirect()->route('');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        abort_if(! auth()->user()->can('course_registration.delete'), '403', 'Unauthorized Action.');

        $output = false;
        try {
            DB::beginTransaction();
            // delete code goes here
            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('title', 'description');
            return redirect()->route('');
        }
        alert()->success('title', 'description');
        return redirect()->route('');
    }
}
