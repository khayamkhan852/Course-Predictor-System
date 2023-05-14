<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\Department;
use App\Models\Section;
use App\Models\User;
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
        $courses = Course::get(['id', 'title']);
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Teacher');
        })->get(['id', 'name']);
        $sections = Section::get(['id', 'name']);
        return view('courses.create', compact('departments', 'courses', 'users', 'sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCourseRequest $request
     * @return RedirectResponse
     */
    public function store(CreateCourseRequest $request): RedirectResponse
    {
        if (! auth()->user()->can('courses.create')) {
            abort(403, 'Unauthorized action.');
        }

        $output = false;
        try {
            DB::beginTransaction();

            $course = Course::create($request->validated());
            $course_instructors = [];
            foreach ($request->input('course_instructors') as $course_instructor) {
                if ($course_instructor['section_id'] === null && $course_instructor['instructor_id'] === null) {
                    continue;
                }
                $course_instructors[] = [
                    'instructor_id' => $course_instructor['instructor_id'],
                    'section_id' => $course_instructor['section_id'],
                ];
            }

            $course->courseInstructors()->createMany($course_instructors);

            DB::commit();
            $output = true;
        } catch (\Exception|\Error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('added', 'Course Added Successfully');
            return redirect()->route('courses.index');
        }
        alert()->error('error', 'something went wrong');
        return redirect()->route('courses.index');
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
        $course->load([
            'courseInstructors.instructor:id,name',
            'courseInstructors.section:id,name',
            'pre_requisite_course:id,title,code',
            'coordinator:id,name',
            'department:id,name',
        ]);
        return view('courses.show', compact('course'));
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

        $course->load([
            'courseInstructors.section:id,name'
        ]);

        $departments = Department::get(['id', 'name']);
        $courses = Course::get(['id', 'title']);
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Teacher');
        })->get(['id', 'name']);

        $instructorIds = $course->courseInstructors->pluck(['section_id']);

        $sections = Section::whereNotIn('id', $instructorIds)->get(['id', 'name']);

        return view('courses.edit', compact('course', 'departments', 'courses', 'users', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCourseRequest $request
     * @param Course $course
     * @return RedirectResponse
     */
    public function update(UpdateCourseRequest $request, Course $course): RedirectResponse
    {
        if (! auth()->user()->can('courses.update')) {
            abort(403, 'Unauthorized action.');
        }

        $output = false;
        try {
            DB::beginTransaction();

            $course->update($request->validated());

            $course_instructors = [];
            foreach ($request->input('course_instructors') as $course_instructor) {
                if ($course_instructor['section_id'] === null && $course_instructor['instructor_id'] === null) {
                    continue;
                }
                $course_instructors[] = [
                    'instructor_id' => $course_instructor['instructor_id'],
                    'section_id' => $course_instructor['section_id'],
                ];
            }

            $course->courseInstructors()->delete();
            $course->courseInstructors()->createMany($course_instructors);

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('updated', 'Course Updated Successfully');
            return redirect()->route('courses.index');
        }
        alert()->error('error', 'something went wrong');
        return redirect()->route('courses.index');
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

            $course->courseInstructors()->delete();
            $course->delete();

            DB::commit();
            $output = true;
        } catch (\Exception|\Error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('Deleted', 'Course Deleted Successfully');
            return redirect()->route('courses.index');
        }
        alert()->error('error', 'something went wrong, There May be other Records against this'. $course->title);
        return redirect()->route('courses.index');
    }
}
