<?php

namespace App\Services;

use App\Models\CourseRegistration;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class GpaService {
    public array $gradePoints = ["A+" => 4.0, "A" => 3.67, "B+" => 3.33, "B" => 3.0, "B-" => 2.67, "C+" => 2.33, "C" => 2.0, "C-" => 1.67, "D+" => 1.33, "D" => 1.0, "F" => 0.0];

    public function CourseGPA($grade)
    {
        if (array_key_exists($grade, $this->gradePoints)) {
            $gpa = $this->gradePoints[$grade];
        } else {
            $gpa = 0;
        }
        return $gpa;
    }

    public function semesterGpa($coursesGpa): float
    {
        $totalGradePoints = array_sum($coursesGpa);
        $totalCourses = count($coursesGpa);
        return $totalCourses > 0 ? round($totalGradePoints / $totalCourses, 2) : 0.0;

    }
}
