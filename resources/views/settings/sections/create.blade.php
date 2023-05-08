@extends('layouts.app')
@section('title', 'sections')

@section('content')
    <x-breadcrum name="sections" parent="1" parent-name="Settings" page-name="New Section" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15">
                    <div class="pb-10">
                        <form class="form w-100" action="{{ route('settings.sections.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="name" class="required">Name</x-label>
                                    <x-input id="name" name="name" value="{{ old('name') }}" placeholder="Name" autofocus required />
                                    @error('name')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10 mt-8">
                                    <x-button class="btn-primary">Create New Section</x-button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





