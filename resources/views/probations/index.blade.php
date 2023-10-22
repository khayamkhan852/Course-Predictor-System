@extends('layouts.app')
@section('title', 'Probations')
@section('css')

@endsection
@section('content')
    <x-breadcrum name="Probations" page-name="Probations List" permission="{{ auth()->user()->can('probation.create') ? '1' : '0' }}" button-url="{{ route('probations.create') }}" button-text="Check Probation" />

    <div class="docs-content d-flex flex-column flex-column-fluid" id="kt_docs_content">
        <div class="container d-flex flex-column flex-lg-row" id="kt_docs_content_container">
            <div class="card card-docs flex-row-fluid mb-2">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                    <div class="pb-10">
                        <table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded detail-table align-center">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                    <th scope="col" class="text-center">Name</th>
                                    <th scope="col" class="text-center">Reg Number</th>
                                    <th scope="col" class="text-center">Year</th>
                                    <th scope="col" class="text-center">Department</th>
                                    <th scope="col" class="text-center">Probation</th>
                                    <th scope="col" class="text-center">Cgpa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($probations as $probation)
                                    <tr>
                                        <td class="text-center">{{ $probation->student->name}}</td>
                                        <td class="text-center">{{ $probation->student->reg_number}}</td>
                                        <td class="text-center">{{ $probation->year}}</td>
                                        <td class="text-center">{{ $probation->student->department->name}}</td>
                                        <td class="text-center">{{ $probation->is_probation }}</td>
                                        <td class="text-center">{{ $probation->cgpa}}</td>
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
