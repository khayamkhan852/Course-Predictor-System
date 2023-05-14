@extends('layouts.app')
@section('title', 'Semester View')

@section('content')
    <x-breadcrum name="Courses" page-name="Course View" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15">
                    <div class="pb-10">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                                <x-label for="name">Name</x-label>
                                <p>{{ $semester->name }}</p>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                                <x-label for="year">Year</x-label>
                                <p>{{ $semester->year }}</p>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                                <x-label for="credit_hours">Total Credit Hours</x-label>
                                <p>{{ $semester->total_credit_hours }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                                <x-label for="department_id">Department</x-label>
                                <p>{{ $semester->department->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





