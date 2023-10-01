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
                        @if($semester->courses_count > 0)
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header border-0">
                                    <div class="card-title">
                                        <h2>Courses Assigned</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0 pb-5">
                                    <!--begin::Table-->
                                    <div id="kt_table_customers_payment_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-row-dashed gy-5">
                                                <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                                                <tr class="text-center text-uppercase gs-0">
                                                    <th>S.No</th>
                                                    <th>Code</th>
                                                    <th>Title</th>
                                                    <th>Credit Hours</th>
                                                    <th>Pre-requisite Course</th>
                                                    @can('courses.view')
                                                        <th>view</th>
                                                    @endcan
                                                </tr>
                                                </thead>
                                                <tbody class="fs-6 fw-semibold text-center text-gray-800">
                                                @foreach($semester->courses as $course)
                                                    <tr class="{{ $loop->even ? 'even' : 'odd' }}">
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $course->code }}</td>
                                                        <td>{{ $course->title }}</td>
                                                        <td>{{ $course->credit_hours }}</td>
                                                        <td>{{ $course->pre_requisite_course->title }}</td>
                                                        @can('courses.view')
                                                            <td class="pe-0 text-end">
                                                                <a href="{{ route('courses.show', $course) }}" target="_blank" class="btn btn-sm btn-primary"> View Course</a>
                                                            </td>
                                                        @endcan
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





