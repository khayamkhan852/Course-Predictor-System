<div class="current" >
    <div class="w-100">
        <div class="pb-10 pb-lg-15">
            <h2 class="fw-bold d-flex align-items-center text-dark">Vehicle Damages
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Here You will add Vehicle Damages"></i>
            </h2>
        </div>
        <div class="fv-row">
            <div class="row mb-10">
                <div class="col-12">
                    <x-label for="damage_description">Damage Description</x-label>
                    <x-text-area rows="4" name="damage_description" id="damage_description"></x-text-area>
                    <div class="removeError text-danger" id="damage_description"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="dropzone" id="vehicleDamagesDropZone">
                        <div class="dz-message needsclick">
                            <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                            <div class="ms-4">
                                <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                <span class="fs-7 fw-semibold text-gray-400">Upload up to 20 images</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="appendingDamageImages"></div>
        </div>
    </div>
</div>
