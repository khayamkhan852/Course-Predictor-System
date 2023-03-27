<div class="current">
    <div class="w-100">
        <div class="pb-10 pb-lg-15">
            <h2 class="fw-bold d-flex align-items-center text-dark">Vehicle Status
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Here You will add Vehicle Status"></i>
            </h2>
        </div>
        <div class="fv-row">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="branch_id" class="required">Branch</x-label>
                    <x-select-two class="form-select-solid" name="branch_id"  id="branch_id">
                        <option value=""></option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ $vehicle->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                        @endforeach
                    </x-select-two>
                    <div class="removeError text-danger" id="branch_id_error"></div>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="vehicle_status_id" class="required">Vehicle Status</x-label>
                    <x-select-two class="form-select-solid" name="vehicle_status_id"  id="vehicle_status_id">
                        <option value=""></option>
                        @foreach($vehicleStatuses as $vehicleStatus)
                            <option value="{{ $vehicleStatus->id }}" {{ $vehicle->vehicle_status_id == $vehicleStatus->id ? 'selected' : '' }}>{{ $vehicleStatus->status }}</option>
                        @endforeach
                    </x-select-two>
                    <div class="removeError text-danger" id="vehicle_status_id_error"></div>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="select_owner" class="required">Select Owner Type</x-label>
                    <x-select-two class="form-select-solid" name="select_owner"  id="select_owner">
                        <option value=""></option>
                        <option value="partner" {{ isset($vehicle->partner_id) ? 'selected' : '' }}>Partner</option>
                        <option value="company" {{ isset($vehicle->business_setting_id) ? 'selected' : '' }}>Company</option>
                        <option value="both" {{ isset($vehicle->partner_id, $vehicle->business_setting_id) ? 'selected' : '' }}>Both</option>
                    </x-select-two>
                    <div class="removeError text-danger" id="select_owner_error"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10 owners" id="partner" style="{{ ! isset($vehicle->partner_id) ? 'display: none;' : '' }}">
                    <x-label for="partner_id" class="required">Partner</x-label>
                    <x-select-two class="form-select-solid" name="partner_id"  id="partner_id">
                        <option value=""></option>
                        @foreach($partners as $partner)
                            <option value="{{ $partner->id }}" {{ $vehicle->partner_id == $partner->id ? 'selected' : '' }}>{{ $partner->name }}</option>
                        @endforeach
                    </x-select-two>
                    <div class="removeError text-danger" id="partner_id_error"></div>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10 owners" id="company"  style="{{ ! isset($vehicle->business_setting_id) ? 'display: none;' : '' }}">
                    <x-label for="business_setting_id" class="required">Company</x-label>
                    <x-select-two class="form-select-solid" name="business_setting_id"  id="business_setting_id">
                        <option value=""></option>
                        @foreach($businessSettings as $businessSetting)
                            <option value="{{ $businessSetting->id }}" {{ $vehicle->business_setting_id == $businessSetting->id ? 'selected' : '' }}>{{ $businessSetting->name }}</option>
                        @endforeach
                    </x-select-two>
                    <div class="removeError text-danger" id="business_setting_id_error"></div>
                </div>
            </div>
        </div>
    </div>
</div>
