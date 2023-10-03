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
    public function getSemestersWithCoursesByDepartmentId($department_id, DataService $dataService) {
        $semesters = $dataService->getSemestersWithCoursesByDepartmentId($department_id);
        return response()->json($semesters);
    }
}
