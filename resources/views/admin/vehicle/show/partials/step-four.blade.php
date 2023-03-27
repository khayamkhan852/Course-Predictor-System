<div class="current">
    <div class="w-100">
        <div class="pb-10 pb-lg-15">
            <h2 class="fw-bold d-flex align-items-center text-dark">Vehicle Status
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Here is the Vehicle Status"></i>
            </h2>
        </div>
        <div class="fv-row">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="branch_id" class="fw-bold">Branch</x-label>
                    <p>{{ $vehicle->branch->name ?? '--' }}</p>

                </div>
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="vehicle_status_id" class="fw-bold">Vehicle Status</x-label>
                    <p>{{ $vehicle->vehicle_status->status ?? '--' }}</p>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="select_owner" class="fw-bold">Select Owner Type</x-label>
                    @if(isset($vehicle->partner, $vehicle->company))
                        <p>both</p>
                    @elseif(isset($vehicle->partner))
                        <p>Partner</p>
                    @else
                        <p>Company</p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="partner_id" class="fw-bold">Partner</x-label>
                    <p>{{ $vehicle->partner->name ?? '--' }}</p>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                    <x-label for="business_setting_id" class="fw-bold">Company</x-label>
                    <p>{{ $vehicle->company->name ?? '--' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
