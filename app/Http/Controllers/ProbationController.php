<?php

namespace App\Http\Controllers;

use App\Models\Probation;
use App\Models\Result;
use App\Models\User;
use App\Services\GpaService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;


class ProbationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        abort_if(! auth()->user()->can('probation.view'), '403', 'Unauthorized Action.');

        $probations = Probation::when(auth()->user()->hasRole(['Student']), function ($query) {
            $query->where('student_id', auth()->id());
        })->with([
            'student' => function ($query) {
                $query->with('department:id,name')->select(['id', 'name', 'reg_number', 'department_id']);
            },
        ])->get();

        return view('probations.index', compact('probations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        abort_if(! auth()->user()->can('probation.create'), '403', 'Unauthorized Action.');

        $students = User::whereHas('roles', function ($query) {
            $query->where('name', 'Student');
        })->when(auth()->user()->hasRole(['Student']), function ($query) {
            $query->where('id', auth()->id());
        })->get(['id', 'name', 'reg_number']);

        return view('probations.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request, GpaService $gpaService): RedirectResponse
    {
        abort_if(! auth()->user()->can('probation.create'), '403', 'Unauthorized Action.');

        $data = $request->validate([
            'student_id' => ['required'],
            'year' => ['required'],
        ]);

        $results = Result::with([
            'resultCourses' => function ($query) {
                $query->with(['course:id,title,credit_hours,code'])->select(['id', 'course_id', 'result_id', 'gpa', 'grade']);
            },
            'student:id,name,reg_number',
            'semester:id,name,total_credit_hours',
        ])->where('student_id', $data['student_id'])->get();

        if ($results->isEmpty()) {
            alert()->success('no Result', 'No Result Found of Selected Student');
            return redirect()->route('probations.index');
        }

        $cgpa = $results->average('cgpa');


        $output = false;
        try {
            DB::beginTransaction();

            Probation::create([
                'student_id' => $data['student_id'],
                'cgpa' => $cgpa,
                'year' => $data['year'],
                'is_probation' => $cgpa <= 1.9 ? 'yes' : 'no'
            ]);

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('success', 'successfully Checked for Probation');
            return redirect()->route('probations.index');
        }
        alert()->success('something went wrong', 'please try again');
        return redirect()->route('probations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id): View
    {
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
