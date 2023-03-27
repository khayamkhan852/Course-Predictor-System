 <!--begin::Modal - Add task-->
 <div class="modal fade" id="add_vehicle_modal" tabindex="-1" aria-hidden="true" style="display: none;">
     <!--begin::Modal dialog-->
     <div class="modal-dialog modal-dialog-centered mw-650px">
         <!--begin::Modal content-->
         <div class="modal-content">
             <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_user_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">Add Vehicle Type</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                    rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
             <!--end::Modal header-->
             <!--begin::Modal body-->
             <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                 <!--begin::Form-->
                 <form id="add_vehicle_form" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll"
                         data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                         data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header"
                         data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px"
                         style="max-height: 357px;">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Vehicle Type</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="type" class="form-control form-control-solid mb-3 mb-lg-0"
                                    placeholder="Enter Type E.g Truck" value="{{ old('type') }}" id="type">
                                <!--end::Input-->
                                <div class="fv-plugins-message-container invalid-feedback" id="type_help"></div>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3"
                            data-bs-dismiss="modal">Discard</button>
                            <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                        <div></div>
                 </form>
                 <!--end::Form-->
             </div>
             <!--end::Modal body-->
         </div>
         <!--end::Modal content-->
     </div>
     <!--end::Modal dialog-->
 </div>
 <!--end::Modal - Add task-->


    <!-- Edit Modal -->
    <!--begin::Modal - Add task-->
    <div class="modal fade" id="edit_vehicle_modal" tabindex="-1" aria-hidden="true" style="display: none;">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_user_header">
                   <!--begin::Modal title-->
                   <h2 class="fw-bold">Update Vehicle Type</h2>
                   <!--end::Modal title-->
                   <!--begin::Close-->
                   <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                       <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                       <span class="svg-icon svg-icon-1">
                           <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                               xmlns="http://www.w3.org/2000/svg">
                               <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                   rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                               <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                   transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                           </svg>
                       </span>
                       <!--end::Svg Icon-->
                   </div>
                   <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="edit_vehicle_form" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                        <input type="hidden" value="" id="vehicle_type_id" name="vehicle_type_id">
                       <!--begin::Scroll-->
                       <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header"
                        data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px"
                        style="max-height: 357px;">
                           <!--begin::Input group-->
                           <div class="fv-row mb-7 fv-plugins-icon-container">
                               <!--begin::Label-->
                               <label class="required fw-semibold fs-6 mb-2">Vehicle Type</label>
                               <!--end::Label-->
                               <!--begin::Input-->
                               <input type="text" name="edit_type" class="form-control form-control-solid mb-3 mb-lg-0"
                                   placeholder="Enter Type E.g Truck" value="{{ old('edit_type') }}" id="edit_type">
                               <!--end::Input-->
                               <div class="fv-plugins-message-container invalid-feedback" id="edit_type_help"></div>
                           </div>
                           <!--end::Input group-->
                       </div>
                       <!--end::Scroll-->
                       <!--begin::Actions-->
                       <div class="text-center pt-15">
                           <button type="reset" class="btn btn-light me-3"
                           data-bs-dismiss="modal">Discard</button>
                           <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                               <span class="indicator-label">Update</span>
                               <span class="indicator-progress">Please wait...
                                   <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                           </button>
                       </div>
                       <!--end::Actions-->
                       <div></div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Add task-->