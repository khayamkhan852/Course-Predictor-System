<div class="current">
    <div class="w-100">
        <div class="pb-10 pb-lg-15">
            <h2 class="fw-bold d-flex align-items-center text-dark">Vehicle Facilities
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Vehicle Facilities"></i>
            </h2>
        </div>
        <div class="fv-row">
            @foreach($vehicle->vehicleFacilities as $vehicleFacility)
                <div class="badge badge-primary badge-outline badge-lg fw-bold mt-3">{{ $vehicleFacility->facility }}</div>
            @endforeach
        </div>
    </div>
</div>










