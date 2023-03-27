@extends('admin.layouts.app')
@section('title', 'Vehicles')
@section('content')
    <x-breadcrum name="Vehicles" parent="1" parent-name="Operations" page-name="New Vehicle" />
    @include('admin.vehicle.create.partials.create-wizard')
@endsection

@section('javascript')
    @include('admin.vehicle.create.partials.create-script')
@endsection



