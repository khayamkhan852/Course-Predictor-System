@extends('admin.layouts.app')
@section('title', 'Branches')

@section('content')
    <x-breadcrum name="Branches" parent="1" parent-name="Settings" page-name="New Branch" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15" style="background-color:#F5F6FA;">
                    <div class="pb-10">
                        <form class="form w-100" action="{{ route('admin.settings.branches.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-5">
                                    <x-label for="name" class="required">Name</x-label>
                                    <x-input class="{{ $errors -> has('name') ? 'is-invalid' : '' }}"
                                             id="name" name="name" value="{{ old('name') }}" placeholder="Branch Name" autofocus />
                                    @error('name')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-5 mt-8">
                                    <x-button class="btn-primary ms-4">Save Branch</x-button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





