<div class="post d-flex flex-column-fluid">
    <div class="container-xxl">
        <div class="card">
            <div class="card-body">
                <div class="stepper stepper-links d-flex flex-column">
                    <div class="stepper-nav">
                        <div class="stepper-item current" id="header1">
                            <h3 class="stepper-title">Vehicle Information</h3>
                        </div>
                        <div class="stepper-item" id="header2">
                            <h3 class="stepper-title">Facilities</h3>
                        </div>
                        <div class="stepper-item" id="header3">
                            <h3 class="stepper-title">Damages</h3>
                        </div>
                        <div class="stepper-item" id="header4">
                            <h3 class="stepper-title">Status</h3>
                        </div>
                    </div>
                    <div class="form-steps">
                        <div id="step-1" class="step" data-for-header="header1">
                            @include('admin.vehicle.show.partials.step-one')
                        </div>
                        <div id="step-2" class="step" data-for-header="header2" style="display: none;">
                            @include('admin.vehicle.show.partials.step-two')
                        </div>
                        <div id="step-3" class="step" data-for-header="header3" style="display: none;">
                            @include('admin.vehicle.show.partials.step-three')
                        </div>
                        <div id="step-4" class="step" data-for-header="header4" style="display: none;">
                            @include('admin.vehicle.show.partials.step-four')
                        </div>
                    </div>
                    <div class="d-flex flex-stack pt-15">
                        <div class="mr-2">
                            <button type="button" class="btn btn-lg btn-light-primary me-3" id="prev-btn">
                                <span class="svg-icon svg-icon-4 me-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="currentColor" />
                                        <path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="currentColor" />
                                    </svg>
                                </span>
                                Back
                            </button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-lg btn-primary" id="next-btn">Next
                                <span class="svg-icon svg-icon-4 ms-1 me-0">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor" />
                                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>










