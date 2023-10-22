<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Department;
use App\Models\Probation;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $probationCount = Probation::where('student_id', auth()->id())
            ->where('is_probation', 'yes')->count();

        $studentsCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'Student');
        })->count();

        $teachersCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'Teacher');
        })->count();

        $departmentHeadsCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'Head Of Department');
        })->count();

        $departmentsCount = Department::count();
        $coursesCount = Course::count();

        return view('dashboard.index',
            compact(
                'probationCount',
                'studentsCount',
                'teachersCount',
                'departmentHeadsCount',
                'departmentsCount',
                'coursesCount',
            ));
    }
}
