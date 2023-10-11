<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Models\ResultCourse;
use App\Models\User;
use App\Services\GpaService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;


class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        abort_if(! auth()->user()->can('results.view'), '403', 'Unauthorized Action.');

        $results = Result::when(auth()->user()->hasRole(['Student']), function ($query) {
            $query->where('student_id', auth()->id());
        })->with([
            'student' => function ($query) {
                $query->with('department:id,name')->select(['id', 'name', 'reg_number', 'department_id']);
            },
            'semester:id,name,total_credit_hours',
        ])->get();

        return view('results.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        abort_if(! auth()->user()->can('results.create'), '403', 'Unauthorized Action.');

        $students = User::whereHas('roles', function ($query) {
            $query->where('name', 'Student');
        })->when(auth()->user()->hasRole(['Student']), function ($query) {
            $query->where('id', auth()->id());
        })->get(['id', 'name', 'reg_number']);

        return view('results.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param GpaService $gpaService
     * @return RedirectResponse
     */
    public function store(Request $request, GpaService $gpaService): RedirectResponse
    {
        abort_if(! auth()->user()->can('results.create'), '403', 'Unauthorized Action.');

        $request->validate([
            'student_id' => ['required'],
            'semester_id' => ['required'],
        ]);

        if (! $request->has('courses')) {
            alert()->warning('Warning', 'No Course Selected, Provide the courses');
            return redirect()->back();
        }

        $output = false;
        try {
            DB::beginTransaction();

            $result = Result::create([
                'student_id' => $request->input('student_id'),
                'semester_id' => $request->input('semester_id'),
            ]);

            $individualGPAs = [];
            foreach ($request->input('courses') as $course) {
                $courseGpa = $gpaService->CourseGPA($course['grade']);
                $individualGPAs[] = $courseGpa;

                $result->resultCourses()->create([
                    'course_id' => $course['course_id'],
                    'grade' => $course['grade'],
                    'gpa' => $courseGpa,
                ]);
            }

            $result->cgpa = $gpaService->semesterGpa($individualGPAs);
            $result->save();

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('Success', 'Result Created Successfully');
            return redirect()->route('results.index');
        }

        alert()->error('something went wrong', 'Please Try again');
        return redirect()->route('results.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id): View
    {
        abort_if(! auth()->user()->can('results.view'), '403', 'Unauthorized Action.');

        $result = Result::with([
            'resultCourses' => function ($query) {
                $query->with(['course:id,title,credit_hours,code'])->select(['id', 'course_id', 'result_id', 'gpa', 'grade']);
            },
            'student:id,name,reg_number',
            'semester:id,name,total_credit_hours',
        ])->where('id', $id)->firstOrFail();

        return view('results.show', compact('result'));
    }

    public function showStudentOverAllResult($student_id): View
    {
        abort_if(! auth()->user()->can('results.view'), '403', 'Unauthorized Action.');

        $results = Result::with([
            'resultCourses' => function ($query) {
                $query->with(['course:id,title,credit_hours,code'])->select(['id', 'course_id', 'result_id', 'gpa', 'grade']);
            },
            'student:id,name,reg_number',
            'semester:id,name,total_credit_hours',
        ])->where('student_id', $student_id)->get();

        $cgpa = $results->average('cgpa');

        return view('results.overall', compact('results', 'cgpa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id): View
    {
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
        abort_if(! auth()->user()->can('results.delete'), '403', 'Unauthorized Action.');

        $result = Result::where('id', $id)->firstOrFail();

        $output = false;
        try {
            DB::beginTransaction();

            ResultCourse::where('result_id', $result->id)->delete();
            $result->delete();
            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('Success', 'Result Deleted Successfully');
            return redirect()->route('results.index');
        }
        alert()->success('something went wrong', 'Please Try again');
        return redirect()->route('results.index');
    }
}
