<div class="current">
    <div class="w-100">
        <div class="pb-10 pb-lg-15">
            <h2 class="fw-bold d-flex align-items-center text-dark">Vehicle Information
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Here You will edit basic Vehicle Information"></i>
            </h2>
        </div>
        <div class="fv-row">
            <div class="row mb-10">
                <x-label for="vehicle_image">Vehicle Standard Image</x-label>
                <br>
                <div class="col-12">
                    <x-image-preloaded name="vehicle_image" url="{{ $vehicle->getFirstMediaUrl('vehicles') ?: asset('pictures/car.jpg') }}" />
                </div> <br>
                <div class="removeError text-danger" id="vehicle_image_error"></div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="vehicle_type" class="required">Type</x-label>
                    <x-input class="form-control-solid" id="vehicle_type" name="vehicle_type" value="{{ $vehicle->type }}"
                             placeholder="Vehicle Type" autofocus />
                    <div class="removeError text-danger" id="vehicle_type_error"></div>
                </div>

                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="engine_type" class="required">Engine Type</x-label>
                    <x-input class="form-control-solid" id="engine_type" name="engine_type" value="{{ $vehicle->engine_type }}"
                             placeholder="Engine Type (cm3)" />
                    <div class="removeError text-danger" id="engine_type_error"></div>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="vin" class="required">VIN</x-label>
                    <x-input class="form-control-solid" id="vin" name="vin" value="{{ $vehicle->vin }}"
                             placeholder="Vehicle Identification Number" />
                    <div class="removeError text-danger" id="vin_error"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="color" class="required">Vehicle Color</x-label>
                    <x-input class="form-control-solid" id="color" name="color" value="{{ $vehicle->color }}" placeholder="Vehicle Color" />
                    <div class="removeError text-danger" id="color_error"></div>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="model" class="required">Vehicle Model / Year</x-label>
                    <x-input class="form-control-solid" id="model" value="{{ $vehicle->model }}" name="model" placeholder="Vehicle Model / Year" />
                    <div class="removeError text-danger" id="model_error"></div>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="brand" class="required">Vehicle Make / Brand</x-label>
                    <x-input class="form-control-solid" id="brand" value="{{ $vehicle->brand }}" name="brand" placeholder="Vehicle Brand / Make" />
                    <div class="removeError text-danger" id="brand_error"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="model" class="required">Fuel Tank Capacity</x-label>
                    <x-input class="form-control-solid" id="fuel_capacity" name="fuel_capacity" value="{{ $vehicle->fuel_capacity }}"
                             placeholder="Fuel Tank Capacity" />
                    <div class="removeError text-danger" id="fuel_capacity_error"></div>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="fuel_consumption" class="required">Average Fuel Consumption (per KM)</x-label>
                    <x-input class="form-control-solid" id="fuel_consumption" value="{{ $vehicle->fuel_consumption }}" name="fuel_consumption"
                             placeholder="Average Fuel Consumption (per KM)" />
                    <div class="removeError text-danger" id="fuel_consumption_error"></div>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="doors" class="required">Number of Doors</x-label>
                    <x-input type="number" min="0" max="6" class="form-control-solid"  id="doors" name="doors" value="{{ $vehicle->doors }}"
                             placeholder="Number of Doors" />
                    <div class="removeError text-danger" id="doors_error"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="seats" class="required">Seating Capacity</x-label>
                    <x-input type="number" min="0" class="form-control-solid" id="seats" name="seats" value="{{ $vehicle->seats }}"
                             placeholder="Seating Capacity" />
                    <div class="removeError text-danger" id="seats_error"></div>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="large_bags" class="required">Number of Large Bags</x-label>
                    <x-input type="number" min="0" class="form-control-solid" id="large_bags" name="large_bags" value="{{ $vehicle->large_bags }}"
                             placeholder="Number of Large Bags" />
                    <div class="removeError text-danger" id="large_bags_error"></div>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="small_bags" class="required">Number of Small Bags</x-label>
                    <x-input type="number" min="0" class="form-control-solid" id="small_bags" name="small_bags" value="{{ $vehicle->small_bags }}"
                             placeholder="Number of Small Bags" />
                    <div class="removeError text-danger" id="small_bags_error"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="vgroup_id" class="required">Vehicle Groups</x-label>
                    <x-select-two class="form-select-solid" name="vgroup_id[]"  id="vgroup_id" multiple>
                        <option value=""></option>
                        @foreach($vehicleGroups as $key => $vehicleGroup)
                            <option value="{{ $vehicleGroup->id }}" {{ in_array($vehicleGroup->id, $vehicle->groups->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $vehicleGroup->group_name }}
                            </option>
                        @endforeach
                    </x-select-two>
                    <div class="removeError text-danger" id="vgroup_id_error"></div>
                </div>

                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="vdrive_id" class="required">Vehicle Drive</x-label>
                    <x-select-two class="form-select-solid" name="vdrive_id[]"  id="vdrive_id" multiple>
                        <option value=""></option>
                        @foreach($vehicleDrives as $vehicleDrive)
                            <option value="{{ $vehicleDrive->id }}" {{ in_array($vehicleDrive->id, $vehicle->vehicleDrives->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $vehicleDrive->vehicle_drive }}</option>
                        @endforeach
                    </x-select-two>
                    <div class="removeError text-danger" id="vdrive_id_error"></div>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="fueltype_id" class="required">Fuel Type</x-label>
                    <x-select-two class="form-select-solid" name="fueltype_id[]"  id="fueltype_id" multiple>
                        <option value=""></option>
                        @foreach($fuelTypes as $fuelType)
                            <option value="{{ $fuelType->id }}" {{ in_array($fuelType->id, $vehicle->vehicleFuels->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $fuelType->fuel_type }}</option>
                        @endforeach
                    </x-select-two>
                    <div class="removeError text-danger" id="fueltype_id_error"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="vbody_id" class="required">Body Type</x-label>
                    <x-select-two class="form-select-solid" name="vbody_id[]"  id="vbody_id" multiple>
                        <option value=""></option>
                        @foreach($bodyTypes as $bodyType)
                            <option value="{{ $bodyType->id }}" {{ in_array($bodyType->id, $vehicle->vehicleBodyTypes->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $bodyType->body_type }}</option>
                        @endforeach
                    </x-select-two>
                    <div class="removeError text-danger" id="vbody_id_error"></div>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="imei">Tracker IMEI</x-label>
                    <x-input class="form-control-solid" id="imei" value="{{ $vehicle->imei }}"
                             name="imei" placeholder="Tracker IMEI" />
                    <div class="removeError text-danger" id="imei_error"></div>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="flevel_id" class="required">Current Fuel Level (%)</x-label>
                    <x-select-two class="form-select-solid" name="flevel_id"  id="flevel_id">
                        <option value=""></option>
                        @foreach($fuelLevels as $fuelLevel)
                            <option value="{{ $fuelLevel->id }}" {{ $vehicle->flevel_id == $fuelLevel->id ? 'selected' : '' }}>{{ $fuelLevel->level }}</option>
                        @endforeach
                    </x-select-two>
                    <div class="removeError text-danger" id="flevel_id_error"></div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                    <x-label for="vtransmission_id" class="required">Vehicle Transmissions</x-label>
                    <x-select-two class="form-select-solid" name="vtransmission_id[]"  id="vtransmission_id" multiple>
                        <option value=""></option>
                        @foreach($vehicleTransmissions as $vehicleTransmission)
                            <option value="{{ $vehicleTransmission->id }}" {{ in_array($vehicleTransmission->id, $vehicle->vehicleTransmissions->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $vehicleTransmission->v_transmission }}</option>
                        @endforeach
                    </x-select-two>
                    <div class="removeError text-danger" id="vtransmission_id_error"></div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">

                </div>
            </div>
        </div>

    </div>
</div>
