@extends('layouts.app')
@section('title', 'departments')

@section('content')
    <x-breadcrum name="departments" page-name="New Department" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15" style="background-color:#F5F6FA;">
                    <div class="pb-10">
                        <form class="form w-100" action="{{ route('departments.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="name" class="required">Name</x-label>
                                    <x-input id="name" name="name" value="{{ old('name') }}" placeholder="Name" autofocus required />
                                    @error('name')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="short_name" class="required">Short Name</x-label>
                                    <x-input id="short_name" name="short_name" value="{{ old('short_name') }}" placeholder="Short Name (CSE)" required />
                                    @error('short_name')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>
                            <x-button class="btn-primary">Create New Department</x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





