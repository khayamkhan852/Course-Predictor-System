<div class="current" >
    <div class="w-100">x
        <div class="pb-10 pb-lg-15">
            <h2 class="fw-bold d-flex align-items-center text-dark">Vehicle Damages
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Vehicle Damages Information"></i>
            </h2>
        </div>
        <div class="fv-row">
            <div class="row mb-10">
                <div class="col-12">
                    <x-label for="damage_description" class="fw-bold">Damage Description</x-label>
                    <p>{{ $vehicle->vehicleDamage->damage_description }}</p>
                </div>
            </div>
            <div class="row gallery" style="margin: 10px 50px;">
                @foreach($vehicle->vehicleDamage->media as $image)
                    <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3">
                        <a href="{{ $image->getUrl() }}" data-lightbox="mygallery">
                            <img class="img-fluid imageGallery" src="{{ $image->getUrl('thumb-350') }}" alt="">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
