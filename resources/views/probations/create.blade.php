@extends('layouts.app')
@section('title', 'Probations')
@section('css')

@endsection

@section('content')
    <x-breadcrum name="Probations" page-name="Check Probation" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15">
                    <div class="pb-10">
                        <form class="form w-100" action="{{ route('probations.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <x-label for="year" class="required">Year</x-label>
                                    <x-input name="year" id="year" value="{{ old('year') }}" required />
                                    @error('year')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>


                            <x-button class="btn-primary">Check For Probation</x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
