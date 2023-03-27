@extends('admin.layouts.app')
@section('title', 'Vehicles')
@section('css')

@endsection
@section('content')
    <x-breadcrum name="Vehicles" parent="1" parent-name="Operations" page-name="Vehicle" />
    @include('admin.vehicle.show.partials.show-wizard')
@endsection

@section('javascript')
    @include('admin.vehicle.show.partials.show-script')
@endsection



