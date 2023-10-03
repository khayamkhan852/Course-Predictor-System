@extends('layouts.app')
@section('title', 'Course Registrations')
@section('css')

@endsection

@section('content')
    <x-breadcrum name="Course Registrations" page-name="New Course Registration" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15">
                    <div class="pb-10">
                        <form class="form w-100" action="{{ route('course-registrations.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="student_id" class="required">Student</x-label>
                                    <x-select-two name="student_id" id="student_id" message="Select Student">
                                        <option value=""></option>
                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}" {{ ( (old('student_id') ?? $student->id) == auth()->id()) ? 'selected' : '' }}>{{ $student->name }} : {{ $student->reg_number }}</option>
                                        @endforeach
                                    </x-select-two>
                                    @error('student_id')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="department_id" class="required">Department</x-label>
                                    <x-select-two name="department_id" id="department_id" message="Select Student Department">
                                        <option value=""></option>
                                        @foreach($students as $student)
                                            <option value="{{ $student->department_id }}" {{ old('department_id') == $student->department_id ? 'selected' : '' }}>{{ $student->department->name }}</option>
                                        @endforeach
                                    </x-select-two>
                                    @error('department_id')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header border-0">
                                    <div class="card-title">
                                        <h2>Related Semesters</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0 pb-5">
                                    <div class="table-responsive">
                                        <table class="table align-middle table-row-dashed fs-6 gy-4">
                                            <tbody class="fs-6 fw-semibold text-gray-600" id="semester_tbody">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <x-button class="btn-primary">Save Your Registration</x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            $('#semester_tbody').on('click', '.semester-checkbox', function () {
                var $parentRow = $(this).closest('tr');
                var $childRows = $parentRow.nextUntil('tr:not(.course-row)');
                $childRows.toggle();
            });
            $('#department_id').on('change', function() {
                $('#semester_tbody').empty();
                let department_id = $(this).val();
                let url = '{{ route("get.semesters.by.department", ":id") }}';
                url = url.replace(':id', department_id);
                $.ajax({
                    type: 'get',
                    async: false,
                    url: url,
                    data: {},
                    success: function(data) {
                        $.each(data, function (index, semester) {
                            var semesterData = `
                                <tr class="text-success">
                                    <th><x-checkbox class="h-20px w-20px semester-checkbox" name="semesterData[${index}][semester_id]" value="${semester.id}" /><td>
                                    <th><b>${semester.name}</b><td>
                                    <th><b>${semester.year}</b><td>
                                    <th><b>${semester.total_credit_hours} Total Credit Hours</b><td>
                                </tr>
                            `;
                            $.each(semester.courses, function (courseIndex, course) {
                                semesterData += `
                                    <tr class="course-row" style="display: none;">
                                        <td>
                                            <x-checkbox class="h-20px w-20px" name="semesterData[${index}][courses][${courseIndex}][course_id]" value="${course.id}" />
                                        <td>
                                        <td>${course.code}, ${course.title}<td>
                                        <td>${course.credit_hours} Credit hours<td>
                                    </tr>
                                `;
                            });
                            $('#semester_tbody').append(semesterData);
                        });
                    },
                    error: function() {

                    }
                });
            });
        });
    </script>
@endsection
