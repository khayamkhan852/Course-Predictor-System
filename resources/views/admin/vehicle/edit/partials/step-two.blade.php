<div class="current">
    <div class="w-100">
        <div class="pb-10 pb-lg-15">
            <h2 class="fw-bold d-flex align-items-center text-dark">Vehicle Facilities
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Here You will Edit basic Vehicle Facilities if any"></i>
            </h2>
        </div>
        <div class="fv-row">
            <div class="row mb-5">
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" id="checkAll">Check All</x-checkbox>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Air Condition" is-checked="{{ in_array('Air Condition', $facilities, false) }}">Air Condition</x-checkbox>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Climate Control" is-checked="{{ in_array('Climate Control', $facilities, false) }}">Climate Control</x-checkbox>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Climate Control Two Zones" is-checked="{{ in_array('Climate Control Two Zones', $facilities, false) }}">Climate Control Two Zones</x-checkbox>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Luxury Climate Control" is-checked="{{ in_array('Luxury Climate Control', $facilities, false) }}">Luxury Climate Control</x-checkbox>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Sunroof" is-checked="{{ in_array('Sunroof', $facilities, false) }}">Sunroof</x-checkbox>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Panoramic Sunroof" is-checked="{{ in_array('Panoramic Sunroof', $facilities, false) }}">Panoramic Sunroof</x-checkbox>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Moon-roof" is-checked="{{ in_array('Moon-roof', $facilities, false) }}">Moon-roof</x-checkbox>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Push Button Start" is-checked="{{ in_array('Push Button Start', $facilities, false) }}">Push Button Start</x-checkbox>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Proximity Key Entry System" is-checked="{{ in_array('Proximity Key Entry System', $facilities, false) }}">Proximity Key Entry System</x-checkbox>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Rear Parking Sensors" is-checked="{{ in_array('Rear Parking Sensors', $facilities, false) }}">Rear Parking Sensors</x-checkbox>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Parking Sensors" is-checked="{{ in_array('Parking Sensors', $facilities, false) }}" >Parking Sensors</x-checkbox>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Built-in Sat Nav" is-checked="{{ in_array('Built-in Sat Nav', $facilities, false) }}">Built-in Sat Nav</x-checkbox>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Mobile Phone Technology" is-checked="{{ in_array('Mobile Phone Technology', $facilities, false) }}">Mobile Phone Technology</x-checkbox>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Bluetooth" is-checked="{{ in_array('Bluetooth', $facilities, false) }}">Bluetooth</x-checkbox>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="USB" is-checked="{{ in_array('USB', $facilities, false) }}">USB</x-checkbox>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Qi Wireless Charging" is-checked="{{ in_array('Qi Wireless Charging', $facilities, false) }}">Qi Wireless Charging</x-checkbox>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Audio/iPod" is-checked="{{ in_array('Audio/iPod', $facilities, false) }}">Audio/iPod</x-checkbox>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Cruise Control" is-checked="{{ in_array('Cruise Control', $facilities, false) }}">Cruise Control</x-checkbox>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Adaptive Cruise Control" is-checked="{{ in_array('Adaptive Cruise Control', $facilities, false) }}">Adaptive Cruise Control</x-checkbox>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Apple CarPlay" is-checked="{{ in_array('Apple CarPlay', $facilities, false) }}">Apple CarPlay</x-checkbox>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Android Auto" is-checked="{{ in_array('Android Auto', $facilities, false) }}">Android Auto</x-checkbox>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Forward Collision Warning" is-checked="{{ in_array('Forward Collision Warning', $facilities, false) }}">Forward Collision Warning</x-checkbox>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Lane Departure Warning" is-checked="{{ in_array('Lane Departure Warning', $facilities, false) }}">Lane Departure Warning</x-checkbox>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Automatic" is-checked="{{ in_array('Automatic', $facilities, false) }}">Automatic</x-checkbox>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Active Parking Assist" is-checked="{{ in_array('Active Parking Assist', $facilities, false) }}">Active Parking Assist</x-checkbox>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Automatic High" is-checked="{{ in_array('Automatic High', $facilities, false) }}">Automatic High</x-checkbox>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-3">
                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                        <x-checkbox class="h-30px w-30px" name="facilities[]" value="Adaptive Headlights" is-checked="{{ in_array('Adaptive Headlights', $facilities, false) }}">Adaptive Headlights</x-checkbox>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>










