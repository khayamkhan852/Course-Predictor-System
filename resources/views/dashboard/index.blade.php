@extends('layouts.app')
@section('title', 'dashboard')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar d-flex flex-stack mb-3 mb-lg-5" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack flex-wrap">
                <div class="page-title d-flex flex-column me-5 py-2">
                    <h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">Smart Guide</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard.index') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="row gy-5 g-xl-10">
                    @if(auth()->user()->hasRole(['Teacher', 'Head Of Department', 'Super Admin']))
                        <div class="col-sm-6 col-xl-2 mb-xl-10">
                            <div class="card h-lg-100">
                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                    <div class="m-0">
                                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M2.10001 10C3.00001 5.6 6.69998 2.3 11.2 2L8.79999 4.39999L11.1 7C9.60001 7.3 8.30001 8.19999 7.60001 9.59999L4.5 12.4L2.10001 10ZM19.3 11.5L16.4 14C15.7 15.5 14.4 16.6 12.7 16.9L15 19.5L12.6 21.9C17.1 21.6 20.8 18.2 21.7 13.9L19.3 11.5Z" fill="currentColor"></path>
                                            <path d="M13.8 2.09998C18.2 2.99998 21.5 6.69998 21.8 11.2L19.4 8.79997L16.8 11C16.5 9.39998 15.5 8.09998 14 7.39998L11.4 4.39998L13.8 2.09998ZM12.3 19.4L9.69998 16.4C8.29998 15.7 7.3 14.4 7 12.8L4.39999 15.1L2 12.7C2.3 17.2 5.7 20.9 10 21.8L12.3 19.4Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    </div>
                                    <div class="d-flex flex-column my-7">
                                        <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ $studentsCount }}</span>
                                        <div class="m-0">
                                            @if(auth()->user()->can('user.view'))
                                                <a href="{{ route('settings.users.index') }}"><span class="fw-semibold fs-6 text-gray-600">Students</span></a>
                                            @else
                                                <span class="fw-semibold fs-6 text-gray-600">Students</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-2 mb-xl-10">
                            <div class="card h-lg-100">
                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                    <div class="m-0">
                                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M2.10001 10C3.00001 5.6 6.69998 2.3 11.2 2L8.79999 4.39999L11.1 7C9.60001 7.3 8.30001 8.19999 7.60001 9.59999L4.5 12.4L2.10001 10ZM19.3 11.5L16.4 14C15.7 15.5 14.4 16.6 12.7 16.9L15 19.5L12.6 21.9C17.1 21.6 20.8 18.2 21.7 13.9L19.3 11.5Z" fill="currentColor"></path>
                                            <path d="M13.8 2.09998C18.2 2.99998 21.5 6.69998 21.8 11.2L19.4 8.79997L16.8 11C16.5 9.39998 15.5 8.09998 14 7.39998L11.4 4.39998L13.8 2.09998ZM12.3 19.4L9.69998 16.4C8.29998 15.7 7.3 14.4 7 12.8L4.39999 15.1L2 12.7C2.3 17.2 5.7 20.9 10 21.8L12.3 19.4Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    </div>
                                    <div class="d-flex flex-column my-7">
                                        <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ $teachersCount }}</span>
                                        <div class="m-0">
                                            @if(auth()->user()->can('user.view'))
                                                <a href="{{ route('settings.users.index') }}"><span class="fw-semibold fs-6 text-gray-600">Teachers</span></a>
                                            @else
                                                <span class="fw-semibold fs-6 text-gray-600">Teachers</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-2 mb-xl-10">
                            <div class="card h-lg-100">
                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                    <div class="m-0">
                                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M2.10001 10C3.00001 5.6 6.69998 2.3 11.2 2L8.79999 4.39999L11.1 7C9.60001 7.3 8.30001 8.19999 7.60001 9.59999L4.5 12.4L2.10001 10ZM19.3 11.5L16.4 14C15.7 15.5 14.4 16.6 12.7 16.9L15 19.5L12.6 21.9C17.1 21.6 20.8 18.2 21.7 13.9L19.3 11.5Z" fill="currentColor"></path>
                                            <path d="M13.8 2.09998C18.2 2.99998 21.5 6.69998 21.8 11.2L19.4 8.79997L16.8 11C16.5 9.39998 15.5 8.09998 14 7.39998L11.4 4.39998L13.8 2.09998ZM12.3 19.4L9.69998 16.4C8.29998 15.7 7.3 14.4 7 12.8L4.39999 15.1L2 12.7C2.3 17.2 5.7 20.9 10 21.8L12.3 19.4Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    </div>
                                    <div class="d-flex flex-column my-7">
                                        <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ $departmentHeadsCount }}</span>
                                        <div class="m-0">
                                            @if(auth()->user()->can('user.view'))
                                                <a href="{{ route('settings.users.index') }}"><span class="fw-semibold fs-6 text-gray-600">Dept Heads</span></a>
                                            @else
                                                <span class="fw-semibold fs-6 text-gray-600">Department Heads</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-2 mb-xl-10">
                            <div class="card h-lg-100">
                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                    <div class="m-0">
                                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M2.10001 10C3.00001 5.6 6.69998 2.3 11.2 2L8.79999 4.39999L11.1 7C9.60001 7.3 8.30001 8.19999 7.60001 9.59999L4.5 12.4L2.10001 10ZM19.3 11.5L16.4 14C15.7 15.5 14.4 16.6 12.7 16.9L15 19.5L12.6 21.9C17.1 21.6 20.8 18.2 21.7 13.9L19.3 11.5Z" fill="currentColor"></path>
                                            <path d="M13.8 2.09998C18.2 2.99998 21.5 6.69998 21.8 11.2L19.4 8.79997L16.8 11C16.5 9.39998 15.5 8.09998 14 7.39998L11.4 4.39998L13.8 2.09998ZM12.3 19.4L9.69998 16.4C8.29998 15.7 7.3 14.4 7 12.8L4.39999 15.1L2 12.7C2.3 17.2 5.7 20.9 10 21.8L12.3 19.4Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    </div>
                                    <div class="d-flex flex-column my-7">
                                        <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ $departmentsCount }}</span>
                                        <div class="m-0">
                                            @if(auth()->user()->can('departments.view'))
                                                <a href="{{ route('departments.index') }}"><span class="fw-semibold fs-6 text-gray-600">Departments</span></a>
                                            @else
                                                <span class="fw-semibold fs-6 text-gray-600">Departments</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-2 mb-xl-10">
                            <div class="card h-lg-100">
                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                    <div class="m-0">
                                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M2.10001 10C3.00001 5.6 6.69998 2.3 11.2 2L8.79999 4.39999L11.1 7C9.60001 7.3 8.30001 8.19999 7.60001 9.59999L4.5 12.4L2.10001 10ZM19.3 11.5L16.4 14C15.7 15.5 14.4 16.6 12.7 16.9L15 19.5L12.6 21.9C17.1 21.6 20.8 18.2 21.7 13.9L19.3 11.5Z" fill="currentColor"></path>
                                            <path d="M13.8 2.09998C18.2 2.99998 21.5 6.69998 21.8 11.2L19.4 8.79997L16.8 11C16.5 9.39998 15.5 8.09998 14 7.39998L11.4 4.39998L13.8 2.09998ZM12.3 19.4L9.69998 16.4C8.29998 15.7 7.3 14.4 7 12.8L4.39999 15.1L2 12.7C2.3 17.2 5.7 20.9 10 21.8L12.3 19.4Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    </div>
                                    <div class="d-flex flex-column my-7">
                                        <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ $coursesCount }}</span>
                                        <div class="m-0">
                                            @if(auth()->user()->can('courses.view'))
                                                <a href="{{ route('courses.index') }}"><span class="fw-semibold fs-6 text-gray-600">Courses</span></a>
                                            @else
                                                <span class="fw-semibold fs-6 text-gray-600">Courses</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-sm-6 col-xl-2 mb-xl-10">
                            <div class="card h-lg-100">
                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                    <div class="m-0">
                                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M2.10001 10C3.00001 5.6 6.69998 2.3 11.2 2L8.79999 4.39999L11.1 7C9.60001 7.3 8.30001 8.19999 7.60001 9.59999L4.5 12.4L2.10001 10ZM19.3 11.5L16.4 14C15.7 15.5 14.4 16.6 12.7 16.9L15 19.5L12.6 21.9C17.1 21.6 20.8 18.2 21.7 13.9L19.3 11.5Z" fill="currentColor"></path>
                                            <path d="M13.8 2.09998C18.2 2.99998 21.5 6.69998 21.8 11.2L19.4 8.79997L16.8 11C16.5 9.39998 15.5 8.09998 14 7.39998L11.4 4.39998L13.8 2.09998ZM12.3 19.4L9.69998 16.4C8.29998 15.7 7.3 14.4 7 12.8L4.39999 15.1L2 12.7C2.3 17.2 5.7 20.9 10 21.8L12.3 19.4Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    </div>
                                    <div class="d-flex flex-column my-7">
                                        <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ $probationCount }}</span>
                                        <div class="m-0">
                                            @if(auth()->user()->can('probation.view'))
                                                <a href="{{ route('probations.index') }}"><span class="fw-semibold fs-6 text-gray-600">Probations</span></a>
                                            @else
                                                <span class="fw-semibold fs-6 text-gray-600">Probations</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection





