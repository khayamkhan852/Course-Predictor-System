@extends('layouts.app')
@section('title', 'Results')
@section('css')

@endsection

@section('content')
    <x-breadcrum name="Results" page-name="New Result" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15">
                    <div class="pb-10">
                        <form class="form w-100" action="{{ route('results.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <x-label for="semester_id" class="required">Semester</x-label>
                                    <x-select-two name="semester_id" id="semester_id" message="Select Semester"></x-select-two>
                                    @error('semester_id')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header border-0">
                                    <div class="card-title">
                                        <h2>Semester Courses</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0 pb-5">
                                    <div class="table-responsive">
                                        <table class="table align-middle table-row-dashed fs-6 gy-4">
                                            <tbody class="fs-6 fw-semibold text-gray-600" id="courses_tbody">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <x-button class="btn-primary">Save New Result</x-button>
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
            $('#student_id').on('change', function () {
                $('#semester_id, #courses_tbody').empty();
                let url = '{{ route("get.semesters.student.id", ":id") }}';
                url = url.replace(':id', $(this).val());
                $.ajax({
                    type: 'get',
                    url: url,
                    async: false,
                    data: {},
                    success: function(data) {
                        $.each(data, function(index, semester) {
                            var newOption = '';
                            newOption = new Option(semester.semester_name,  semester.semester_id, false, false);
                            $('#semester_id').append(newOption).val('');
                        });
                    },
                    error: function(data) {
                        if (data.responseJSON.error === 'empty_semesters') {
                            Swal.fire({
                                title: "Empty Data",
                                icon: 'warning',
                                text: 'The Student is not Enrolled in any semester'
                            });
                        }
                    }
                });
            });

            $('#semester_id').on('change', function() {
                $('#courses_tbody').empty();
                let semester_id = $(this).val();
                let student_id = $('#student_id').val();
                let url = '{{ route("get.courses.semesters.student.id", [":semester_id", ":student_id"]) }}';
                url = url.replace(':semester_id', semester_id).replace(':student_id', student_id);
                $.ajax({
                    type: 'get',
                    async: false,
                    url: url,
                    data: {},
                    success: function(data) {
                        $.each(data, function (index, course) {
                            var courses = `
                                <tr class="course-row">
                                    <td>
                                        ${course.course_code}, ${course.course_title}
                                        <x-input type="hidden" value="${course.course_id}" name="courses[${index}][course_id]" />
                                        <x-input type="hidden" value="${course.credit_hours}" name="courses[${index}][credit_hours]" />
                                    <td>
                                    <td>${course.credit_hours} Credit Hours<td>
                                    <td>
                                        <select class="form-select" name="courses[${index}][grade]" required>
                                            <option value="">--Select Grade--</option>
                                            <option value="A+">A+</option>
                                            <option value="A">A</option>
                                            <option value="B+">B+</option>
                                            <option value="B">B</option>
                                            <option value="B-">B-</option>
                                            <option value="C+">C+</option>
                                            <option value="C">C</option>
                                            <option value="C-">C-</option>
                                            <option value="D+">D+</option>
                                            <option value="D">D</option>
                                            <option value="F">F</option>
                                        </select>
                                    </td>
                                </tr>
                            `;

                            $('#courses_tbody').append(courses);
                        });
                    },
                    error: function() {
                        if (data.responseJSON.error === 'empty_courses') {
                            Swal.fire({
                                title: "Empty Data",
                                icon: 'warning',
                                text: 'No Course Found in this Semester You Selected!'
                            });
                            $('#semester_id, #courses_tbody').empty();
                        }
                    }
                });

            });
        });
    </script>
@endsection
