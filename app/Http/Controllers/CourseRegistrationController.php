<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CourseRegistration;
use App\Models\RegistrationSemester;
use App\Models\RSemesterCourse;
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

        $request->validate([
            'student_id' => ['required'],
            'department_id' => ['required'],
        ]);

        if (! $request->has('semesterData')) {
            alert()->warning('Warning', 'No Course Select, Select a course');
            return redirect()->back();
        }

        foreach ($request->input('semesterData') as $semester) {
            if (empty($semester['courses'])) {
                alert()->warning('Warning', 'No Courses in Some Semesters');
                return redirect()->back();
            }
        }

        $output = false;
        try {
            DB::beginTransaction();

            $courseRegistration = CourseRegistration::create([
                'student_id' => $request->input('student_id'),
                'created_by' => auth()->id(),
            ]);

            foreach ($request->input('semesterData') as $semester) {
                $registrationSemester = $courseRegistration->registrationSemesters()->create([
                    'semester_id' => $semester['semester_id']
                ]);

                foreach ($semester['courses'] as $course) {
                    $registrationSemester->registrationSemesterCourses()->create([
                        'registration_id' => $courseRegistration->id,
                        'course_id' => $course['course_id']
                    ]);
                }

            }

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('Success', 'Courses Registered Successfully');
            return redirect()->route('course-registrations.index');
        }
        alert()->success('something went wrong', 'Please Try again');
        return redirect()->route('course-registrations.index');
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

        $registeredCourses = CourseRegistration::with([
            'student' => function ($query) {
                $query->with('department:id,name')->select(['id', 'name', 'department_id', 'reg_number']);
            },
            'registrationSemesters' => function ($query) {
                $query->with([
                    'semester:id,name,year,total_credit_hours',
                    'registrationSemesterCourses' => function ($query) {
                        $query->with('course:id,title,code,credit_hours');
                    }
                ]);
            }
        ])->where('id', $id)->firstOrFail();


        return view('registrations.show', compact('registeredCourses'));
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

            $registeredCourse = CourseRegistration::where('id', $id)->firstOrFail();
            RegistrationSemester::where('registration_id', $id)->delete();
            RSemesterCourse::where('registration_id', $id)->delete();

            $registeredCourse->delete();

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('Success', 'Course Registration Deleted Successfully');
            return redirect()->route('course-registrations.index');
        }
        alert()->success('something went wrong', 'Please Try again');
        return redirect()->route('course-registrations.index');
    }
}
