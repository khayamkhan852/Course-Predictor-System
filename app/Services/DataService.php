<?php

namespace App\Services;

use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class DataService {
    public function getSemestersWithCoursesByDepartmentId($department_id): Collection
    {
        return Semester::with('courses:id,code,title,credit_hours')->where('department_id', $department_id)->get();
    }
}
