<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Result;
use App\Models\ResultCourse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RecommendationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('recommentations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function checkRecommendation(): View
    {
        $compulsory_courses = Course::isCompulsory()
            ->has('resultCourses')
            ->where('department_id', auth()->user()->department_id)
            ->pluck('id')->toArray();

        // compulsory subjects
        $compulsory_courses_to_take = Result::with([
            'resultCourses' => function ($query) use ($compulsory_courses) {
                $query->with('course')->whereIn('course_id', $compulsory_courses)->where('gpa', '<=', '2.33');
            },
        ])->whereStudentId(auth()->id())->get();

        $not_compulsory_courses = Course::isNotCompulsory()
            ->has('resultCourses')
            ->where('department_id', auth()->user()->department_id)
            ->pluck('id')->toArray();

        // compulsory subjects
        $compulsory_not_courses_to_take = Result::with([
            'resultCourses' => function ($query) use ($not_compulsory_courses) {
                $query->with('course')->whereIn('course_id', $not_compulsory_courses)->where('gpa', '<=', '2.33');
            },
        ])->whereStudentId(auth()->id())->get();


        return view('recommentations.check',
            compact('compulsory_courses_to_take', 'compulsory_not_courses_to_take'));
    }

}
