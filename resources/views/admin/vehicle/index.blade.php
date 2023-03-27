@extends('admin.layouts.app')
@section('title', 'Vehicles')
@section('css')

@endsection
@section('content')
    <x-breadcrum name="Vehicles" parent="1" parent-name="Operations" page-name="Vehicles" permission="{{ auth()->user()->can('vehicle.create') ? '1' : '0' }}"
                 button-url="{{ route('admin.operations.vehicles.create') }}" button-text="Create" />

    <div class="docs-content d-flex flex-column flex-column-fluid" id="kt_docs_content">
        <div class="container d-flex flex-column flex-lg-row" id="kt_docs_content_container">
            <div class="card card-docs flex-row-fluid mb-2">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                    <div class="pb-10">
                        <table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded detail-table">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                    <th scope="col" style="width: 16%;">Vehicle</th>
                                    <th scope="col" style="width: 14%;">Engine Type</th>
                                    <th scope="col" style="width: 14%;">Brand</th>
                                    <th scope="col" style="width: 14%;">VIN</th>
                                    <th scope="col" style="width: 14%;">Partner</th>
                                    <th scope="col" style="width: 14%;">Company</th>
                                    <th scope="col" style="width: 14%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vehicles as $vehicle)
                                    <tr>
                                        <td class="d-flex align-items-center">
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="{{ route('admin.operations.vehicles.show', $vehicle) }}">
                                                    <div class="symbol-label">
                                                        <img src="{{ $vehicle->getFirstMediaUrl('vehicles') ?: asset('pictures/car.jpg') }}" alt="" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <a href="{{ route('admin.operations.vehicles.show', $vehicle) }}" class="text-gray-800 text-hover-primary mb-1">{{ $vehicle->type }}</a>
                                                <span>{{ $vehicle->model }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $vehicle->engine_type }}</td>
                                        <td>{{ $vehicle->brand }}</td>
                                        <td>{{ $vehicle->vin }}</td>
                                        <td>{{ $vehicle->partner->name ?? '--' }}</td>
                                        <td>{{ $vehicle->company->name ?? '--' }}</td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                <span class="svg-icon svg-icon-5 m-0">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                            </a>
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true" style="">
                                                @can('vehicle.view')
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('admin.operations.vehicles.show', $vehicle) }}" class="menu-link px-3">View</a>
                                                    </div>
                                                @endcan
                                                @can('vehicle.update')
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('admin.operations.vehicles.edit', $vehicle) }}" class="menu-link px-3">Edit</a>
                                                    </div>
                                                @endcan
                                                @can('vehicle.delete')
                                                    <div class="menu-item px-3">
                                                        <form method="POST" id="deleteForm{{$vehicle->id}}" action="{{ route('admin.operations.vehicles.destroy', $vehicle) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        <a onclick="return deleteFunction('{{ $vehicle->id }}')" class="menu-link px-3"> Delete </a>
                                                    </div>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        function deleteFunction(id) {
            if (confirm('Do you want to delete this Vehicle?') === true) {
                $('#deleteForm' + id).submit();
            }
        }

        $(document).ready(function() {
            $("#kt_datatable_dom_positioning").DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom":
                    "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">"
            });
        });

    </script>
@endsection
