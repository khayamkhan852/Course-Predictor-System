<div class="current">
    <div class="w-100">
        <div class="pb-10 pb-lg-15">
            <h2 class="fw-bold d-flex align-items-center text-dark">Vehicle Information
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Basic Vehicle Information"></i>
            </h2>
        </div>
        <div class="fv-row">
            <div class="row mb-10">
                <x-label for="vehicle_image" class="fw-bold">Vehicle Standard Image</x-label>
                <div class="col-12">
                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{ asset('theme/assets/media/svg/avatars/blank.svg') }})">
                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ $vehicle->getFirstMediaUrl('vehicles') ?: asset('pictures/car.jpg') }})"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-10">
                    <x-label for="vehicle_type" class="fw-bold">Type</x-label>
                    <p>{{ $vehicle->type }}</p>
                </div>

                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-10">
                    <x-label for="engine_type" class="fw-bold">Engine Type</x-label>
                    <p>{{ $vehicle->engine_type }}</p>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-10">
                    <x-label for="vin" class="fw-bold">VIN</x-label>
                    <p>{{ $vehicle->vin }}</p>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-10">
                    <x-label for="color" class="fw-bold">Vehicle Color</x-label>
                    <p>{{ $vehicle->color }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-10">
                    <x-label for="model" class="fw-bold">Vehicle Model / Year</x-label>
                    <p>{{ $vehicle->model }}</p>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-10">
                    <x-label for="brand" class="fw-bold">Vehicle Make / Brand</x-label>
                    <p>{{ $vehicle->brand }}</p>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-10">
                    <x-label for="model" class="fw-bold">Fuel Tank Capacity</x-label>
                    <p>{{ $vehicle->fuel_capacity }}</p>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-10">
                    <x-label for="fuel_consumption" class="fw-bold">Average Fuel Consumption (per KM)</x-label>
                    <p>{{ $vehicle->fuel_consumption }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-10">
                    <x-label for="doors" class="fw-bold">Number of Doors</x-label>
                    <p>{{ $vehicle->doors }}</p>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-10">
                    <x-label for="seats" class="fw-bold">Seating Capacity</x-label>
                    <p>{{ $vehicle->seats }}</p>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-10">
                    <x-label for="large_bags" class="fw-bold">Number of Large Bags</x-label>
                    <p>{{ $vehicle->large_bags }}</p>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-10">
                    <x-label for="small_bags" class="fw-bold">Number of Small Bags</x-label>
                    <p>{{ $vehicle->small_bags }}</p>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-10">
                    <x-label for="flevel_id" class="fw-bold">Current Fuel Level (%)</x-label>
                    <p>{{ $vehicle->flevel->level ?? '--' }}</p>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-10">
                    <x-label for="imei" class="fw-bold">Tracker IMEI</x-label>
                    <p>{{ $vehicle->imei }}</p>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                    <x-label for="vgroup_id" class="fw-bold">Vehicle Groups</x-label><br>
                    @foreach($vehicle->groups as $group)
                        <div class="badge badge-primary badge-outline fw-bold mt-2">{{ $group->group_name }}</div>
                    @endforeach
                </div>

            </div>
            <div class="row">
                <div class="col-12 mb-10">
                    <x-label for="vdrive_id" class="fw-bold">Vehicle Drive</x-label> <br>
                    @foreach($vehicle->vehicleDrives as $vehicleDrive)
                        <div class="badge badge-primary badge-outline fw-bold mt-2">{{ $vehicleDrive->vehicle_drive }}</div>
                    @endforeach
                </div>

            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                    <x-label for="fueltype_id" class="fw-bold">Fuel Type</x-label><br>
                    @foreach($vehicle->vehicleFuels as $vehicleFuel)
                        <div class="badge badge-primary badge-outline fw-bold mt-2">{{ $vehicleFuel->fuel_type }}</div>
                    @endforeach
                </div>
                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                    <x-label for="vbody_id" class="fw-bold">Body Type</x-label><br>
                    @foreach($vehicle->vehicleBodyTypes as $vehicleBodyType)
                        <div class="badge badge-primary badge-outline fw-bold mt-2">{{ $vehicleBodyType->body_type }}</div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-10">
                    <x-label for="vtransmission_id" class="fw-bold">Vehicle Transmissions</x-label><br>
                    @foreach($vehicle->vehicleTransmissions as $vehicleTransmission)
                        <div class="badge badge-primary badge-outline badge-lg fw-bold mt-2">{{ $vehicleTransmission->v_transmission }}</div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
