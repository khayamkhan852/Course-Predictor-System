@extends('admin.layouts.app')

@section('title', 'Customers')

@section('css')

@endsection

@section('content')

    <div class="toolbar d-flex flex-stack mb-3 mb-lg-5" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack flex-wrap">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column me-5 py-2">
                <!--begin::Title-->
                <h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">Manage Customer</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.dashboard.index') }}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Customers List</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center py-2">
                <!--begin::Button-->
                <a href="{{ route('admin.operations.customers.create') }}" class="btn btn-sm btn-primary" id="kt_toolbar_primary_button">Create</a>
                <!--end::Button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Container-->
    </div>

    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <!--begin::Table-->
                    <div id="kt_table_users_wrapper" class="">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5  no-footer" id="customers">
                                <!--begin::Table head-->
                                <thead>
                                   <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Full Name</th>
                                        <th>Customer Code</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>DOB</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Created By</th>
                                        <th>Updated At</th>
                                        <th>Actions</th>
                                   </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-semibold">
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img src="{{ $customer->getFirstMediaUrl('customers') ?: asset('theme/assets/media/avatars/300-6.jpg') }}" alt="{{ $customer->name }}" class="w-100" /></td>
                                            <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                                            <td>{{ $customer->customer_code }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td>{{ $customer->dob }}</td>
                                            <td>{{ $customer->customer_type->type }}</td>
                                            <td>{{ $customer->customer_status->status }}</td>
                                            <td>{{ $customer->country }}</td>
                                            <td>{{ $customer->state }}</td>
                                            <td>{{ $customer->city }}</td>
                                            <td>{{ $customer->user->name }}</td>
                                            <td>{{ $customer->updated_at }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" id="dropdown-default-success" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown-default-success">
                                                        <a class="dropdown-item" href="{{ route('admin.customers.edit') }}"><i class="fa fa-edit"></i> Edit</a>
                                                        <a class="dropdown-item" href="#"><i class="fa fa-trash"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                        </div>
                    </div>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>

@endsection

@section('javascript')
    @include('admin.customers.customers.scripts')
@endsection
