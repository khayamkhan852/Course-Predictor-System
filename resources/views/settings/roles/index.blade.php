@extends('layouts.app')
@section('title', 'roles')
@section('css')

@endsection
@section('content')
    <x-breadcrum name="Roles" parent="1" parent-name="Settings" page-name="Roles" permission="{{ auth()->user()->can('roles.create') ? '1' : '0' }}"
                 button-url="{{ route('settings.roles.create') }}" button-text="Create" />

    <div class="docs-content d-flex flex-column flex-column-fluid" id="kt_docs_content">
        <div class="container d-flex flex-column flex-lg-row" id="kt_docs_content_container">
            <div class="card card-docs flex-row-fluid mb-2">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                    <div class="pb-10">
                        <table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded detail-table align-middle">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                    <th scope="col" class="text-center">S.No</th>
                                    <th scope="col" class="text-center">User Type</th>
                                    @if(auth()->user()->can('roles.update') || auth()->user()->can('roles.delete'))
                                        <th scope="col" class="text-center">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td class="text-center">{{ $loop->index + 1 }}</td>
                                        <td class="text-center">{{ $role->name }}</td>
                                        @if(auth()->user()->can('roles.update') || auth()->user()->can('roles.delete'))
                                            @if($role->id !== 1)
                                                <td class="text-center">
                                                    <a href="#" class="btn btn-primary btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                        <span class="svg-icon svg-icon-5 m-0">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true" style="">
                                                        @can('roles.update')
                                                            <div class="menu-item px-3">
                                                                <a href="{{ route('settings.roles.edit', [$role->id]) }}" class="menu-link px-3">Edit</a>
                                                            </div>
                                                        @endcan
                                                        @can('roles.delete')
                                                            <div class="menu-item px-3">
                                                                <form method="POST" id="deleteForm{{ $role->id }}" action="{{ route('settings.roles.destroy', [$role->id]) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                                <a onclick="return deleteFunction('{{ $role->id }}')" class="menu-link px-3"> Delete </a>
                                                            </div>
                                                        @endcan
                                                    </div>
                                                </td>
                                            @else
                                                <td class="text-center"><div class="badge badge-light-danger fw-bold">Cannot be Edited or Deleted</div></td>
                                            @endif
                                        @endif
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
            if (confirm('Do you want to delete this Role ?') === true) {
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
