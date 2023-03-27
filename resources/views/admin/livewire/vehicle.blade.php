<div class="post d-flex flex-column-fluid">
    <div class="container-xxl">
        <div class="card">
            <div class="card-body">
                <div class="stepper stepper-links d-flex flex-column pt-15">
                    <div class="stepper-nav mb-5">
                        <div class="stepper-item {{ $currentPage === 1 ? 'current' : '' }}">
                            <h3 class="stepper-title">Vehicle Information</h3>
                        </div>
                        <div class="stepper-item {{ $currentPage === 2 ? 'current' : '' }}">
                            <h3 class="stepper-title">Facilities</h3>
                        </div>
                        <div class="stepper-item {{ $currentPage === 3 ? 'current' : '' }}">
                            <h3 class="stepper-title">Damages</h3>
                        </div>
                        <div class="stepper-item {{ $currentPage === 4 ? 'current' : '' }}">
                            <h3 class="stepper-title">Status</h3>
                        </div>
                    </div>
                    <form class="mx-auto mw-900px w-100 pt-15 pb-10" wire:submit.prevent="submit">
                        @if($currentPage === 1)
                            <div class="current">
                                <div class="w-100">
                                    <div class="pb-10 pb-lg-15">
                                        <h2 class="fw-bold d-flex align-items-center text-dark">Vehicle Information
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Here You will add basic Vehicle Information"></i>
                                        </h2>
                                    </div>
                                    <div class="row mb-10">
                                        <div class="col-12">
                                            <x-image-preloaded name="vehicle_image" />
                                        </div>
                                    </div>
                                    @error('user_avatar')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror


                                    <div class="row" wire:key="123">
                                        <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                            <x-label for="type" class="required">Type</x-label>
                                            <x-input wire:model="type" class="{{ $errors -> has('type') ? 'is-invalid' : '' }}"
                                                     id="type" placeholder="Vehicle Type" autofocus required />
                                            @error('type')
                                                <x-error>{{ $message }}</x-error>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                            <x-label for="vehicle_groups" class="required">Vehicle Groups</x-label>
                                            <div>
                                                <x-select-two wire:model="vehicle_groups"
                                                              class="form-select-solid"  id="vehicle_groups" multiple>
                                                    <option value=""></option>
                                                    @foreach($vehicleGroups as $vehicleGroup)
                                                        <option value="{{ $vehicleGroup->id }}">{{ $vehicleGroup->group_name }}</option>
                                                    @endforeach
                                                </x-select-two>
                                            </div>
                                            @error('vehicle_groups')
                                                <x-error>{{ $message }}</x-error>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @elseif($currentPage === 2)
                            <div class="current">
                                <div class="w-100">
                                    <div class="pb-10 pb-lg-15">
                                        <h2 class="fw-bold d-flex align-items-center text-dark">Vehicle Facilities
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Here You will add basic Vehicle Facilities if any"></i>
                                        </h2>
                                    </div>
                                    <div class="fv-row">
                                        <div class="row">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($currentPage === 3)
                            <div class="current">
                                <div class="w-100">
                                    <div class="pb-10 pb-lg-15">
                                        <h2 class="fw-bold d-flex align-items-center text-dark">Vehicle Damages
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Here You will add Vehicle Damages"></i>
                                        </h2>
                                    </div>
                                    <div class="fv-row">
                                        <div class="row">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="current">
                                <div class="w-100">
                                    <div class="pb-10 pb-lg-15">
                                        <h2 class="fw-bold d-flex align-items-center text-dark">Vehicle Status
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Here You will add Vehicle Status"></i>
                                        </h2>
                                    </div>
                                    <div class="fv-row">
                                        <div class="row">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="d-flex flex-stack pt-15">
                            <div class="mr-2">
                                @if($currentPage !== 1)
                                    <button wire:click="gotToPreviousPage" type="button" class="btn btn-lg btn-light-primary me-3">
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="currentColor" />
                                            <path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                        Back
                                    </button>
                                @endif
                            </div>

                            <div>
                                @if($currentPage === 4)
                                    <button type="button" class="btn btn-lg btn-primary me-3">
                                        <span class="indicator-label">Submit
                                            <span class="svg-icon svg-icon-3 ms-2 me-0">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor" />
                                                    <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                        </span>
                                    </button>
                                @endif
                                @if($currentPage !== 4)
                                    <button wire:click="gotToNextPage" type="button" class="btn btn-lg btn-primary">Next
                                        <span class="svg-icon svg-icon-4 ms-1 me-0">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor" />
                                                <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        document.addEventListener("DOMContentLoaded", () => {

        //     // window.livewire.hook('afterDomUpdate', () => {
        //     //     alert('here');
        //     // });
        //     Livewire.hook('element.updated', (el, component) => {
        //         alert('here')
        //     });
        //     window.livewire.afterDomUpdate(() => {
        //         $('#vehicle_groups').select2();
        //
        //     });
        //
        // });
        // window.livewire.hook('afterDomUpdate', () => {
        //     $('#vehicle_groups').select2();
        // });
        // if (typeof window.livewire !== 'undefined') {
        //     window.livewire.on('mounted', () => {
        //         $('#vehicle_groups').select2();
        //     });
        // }
        // window.livewire.on('mounted', () => {
        //     $('#vehicle_groups').select2();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            window.addEventListener('contentChanged', (e) => {
                $('#vehicle_groups').select2();
            });
            // window.livewire.hook('afterDomUpdate', () => {
            //     alert('jhere');
            // });
            // window.livewire.afterDomUpdate(() => {
            //     alert('jhere');
            // });
            // window.livewire.hook('afterDomUpdate', () => {
            //     $('#vehicle_groups').select2();
            // });
            {{--$('#vehicle_groups').select2().on('change', function (e) {--}}
            {{--    var data = $('#vehicle_groups').select2("val");--}}
            {{--    @this.set('vehicle_groups', data);--}}
            {{--});--}}
        });
    </script>

    <script>

    </script>

</div>






