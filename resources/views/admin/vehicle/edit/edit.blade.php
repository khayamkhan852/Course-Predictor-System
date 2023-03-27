@extends('admin.layouts.app')
@section('title', 'Vehicles')
@section('content')
    <x-breadcrum name="Vehicles" parent="1" parent-name="Operations" page-name="Edit Vehicle" />
    @include('admin.vehicle.edit.partials.edit-wizard')
@endsection

@section('javascript')
    @include('admin.vehicle.edit.partials.editScript')
@endsection



