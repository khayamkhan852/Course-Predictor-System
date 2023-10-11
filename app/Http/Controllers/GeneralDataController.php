<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use App\Services\DataService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class GeneralDataController extends Controller
{
    public $dataService;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    public function getSemestersWithCoursesByDepartmentId($department_id) {
        $semesters = $this->dataService->getSemestersWithCoursesByDepartmentId($department_id);
        return response()->json($semesters);
    }

    public function getSemesterOfStudent($student_id)
    {
        $semesters = $this->dataService->getSemestersOfStudentByStudentId($student_id);
        if (empty($semesters)) {
            return response()->json(['error' => 'empty_semesters'], 404);
        }
        return response()->json($semesters);
    }

    public function getCoursesOfSemesterOfStudent($semester_id, $student_id)
    {
        $courses = $this->dataService->getRegisteredSemesterCourses($semester_id, $student_id);
        if (empty($courses)) {
            return response()->json(['error' => 'empty_courses'], 404);
        }
        return response()->json($courses);
    }
}
