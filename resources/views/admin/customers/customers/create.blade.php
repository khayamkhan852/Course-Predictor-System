@extends('admin.layouts.app')
@section('title', 'Create Customer')

@section('content')
    <x-breadcrum name="Customers" parent="0" page-name="New Customer" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15" style="background-color:#F5F6FA;">
                    <div class="pb-10">
                        <form class="form w-100" action="{{ route('admin.customers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-5">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 text-center">
                                    <x-image-preloaded name="profile_image" />
                                    @error('profile_image')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6">
                                    <x-label for="customer_code">Customer Code</x-label>
                                    <x-input class="{{ $errors -> has('code') ? 'is-invalid' : '' }}"
                                             id="code" name="customer_code" value="{{ old('customer_code') }}" placeholder="Leave Empty To Auto Generate"/>
                                    @error('customer_code')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6">
                                    <x-label for="first_name" class="required">First Name</x-label>
                                    <x-input class="{{ $errors -> has('first_name') ? 'is-invalid' : '' }}"
                                             id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" autofocus required />
                                    @error('first_name')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6">
                                    <x-label for="last_name" class="required">Last Name</x-label>
                                    <x-input class="{{ $errors -> has('last_name') ? 'is-invalid' : '' }}"
                                             id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" autofocus required />
                                    @error('last_name')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6">
                                    <x-label for="email" class="required">Email</x-label>
                                    <x-input class="{{ $errors -> has('email') ? 'is-invalid' : '' }}"
                                             id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="Email" />
                                    @error('email')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6">
                                    <x-label for="phone">Phone</x-label>
                                    <x-input class="{{ $errors -> has('phone') ? 'is-invalid' : '' }}" id="phone"
                                             name="phone" value="{{ old('phone') }}" placeholder="Phone" />
                                    @error('phone')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6">
                                    <x-label for="dob" class="required">Date Of Birth</x-label>
                                    <x-input  type="date" class="{{ $errors -> has('dob') ? 'is-invalid' : '' }}" id="dob"
                                             name="dob" value="{{ old('dob') }}" placeholder="dob" />
                                    @error('dob')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6">
                                    <x-label for="customer_type" class="required">Customer Type</x-label>
                                    <x-select-two name="customer_type" id="customer_type">
                                        <option value="">Select Customer Type</option>
                                        @foreach($customer_types as $customer_type)
                                            <option value="{{ $customer_type->id }}">{{ $customer_type->type }}</option>
                                        @endforeach
                                    </x-select-two>
                                    @error('customer_type')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6">
                                    <x-label for="customer_status" class="required">Customer Status</x-label>
                                    <x-select-two name="customer_status" id="customer_status">
                                        <option value="">Select Customer Status</option>
                                        @foreach($customer_statuses as $customer_status)
                                            <option value="{{ $customer_status->id }}">{{ $customer_status->status }}</option>
                                        @endforeach
                                    </x-select-two>
                                    @error('customer_status')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6">
                                    <x-label for="country">Country</x-label>
                                    <x-input class="{{ $errors -> has('country') ? 'is-invalid' : '' }}" id="country"
                                             name="country" value="{{ old('country') }}" placeholder="Country" />
                                    @error('country')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6">
                                    <x-label for="state">State</x-label>
                                    <x-input class="{{ $errors -> has('state') ? 'is-invalid' : '' }}" id="state"
                                             name="state" value="{{ old('state') }}" placeholder="State" />
                                    @error('state')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6">
                                    <x-label for="city">City</x-label>
                                    <x-input class="{{ $errors -> has('city') ? 'is-invalid' : '' }}" id="city"
                                             name="city" value="{{ old('city') }}" placeholder="City" />
                                    @error('city')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6">
                                    <x-label for="zip_code">Zip Code</x-label>
                                    <x-input class="{{ $errors -> has('zip_code') ? 'is-invalid' : '' }}" id="zip_code"
                                             name="zip_code" value="{{ old('zip_code') }}" placeholder="Zip Code" />
                                    @error('zip_code')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6">
                                    <x-label for="address">Address</x-label>
                                    <x-input class="{{ $errors -> has('address') ? 'is-invalid' : '' }}" id="address"
                                             name="address" value="{{ old('address') }}" placeholder="Address" />
                                    @error('address')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-12">
                                    <x-label for="remarks" class="required">Remarks</x-label>
                                    <x-text-area rows="4" name="remarks" id="remarks" required>{{ old('remarks') }}</x-text-area>
                                    @error('remarks')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <!--begin::Underline-->
                                    <span class="d-inline-block position-relative ms-2">
                                        <!--begin::Label-->
                                        <span class="d-inline-block mb-2 fs-tx fw-bold">
                                            Customer Documents Information
                                        </span>
                                        <!--end::Label-->

                                        <!--begin::Line-->
                                        <span class="d-inline-block position-absolute h-4px bottom-0 end-0 start-0 bg-success translate rounded"></span>
                                        <!--end::Line-->
                                    </span>
                                    <!--end::Underline-->
                                </div>
                            </div>
                            
                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table" id="dynamic_field">
                                            <tr>
                                                <td class="min-w-250px">
                                                    <label for="document_type" class="required">Document Type</label>
                                                    <select class = "form-select" data-control="select2" data-placeholder="Select an option" name="document_type[]" required>
                                                        <option value="National Indentity Card">National Identity Card</option>
                                                        <option value="Driving License">Driver License</option>
                                                        <option value="Passport">Passport</option>
                                                        <option value="Tax Indentification Number">Tax Identification Number</option>
                                                    </select>
                                                    <br>
                                                    <label for="document_image1" class="required">Front Image</label>
                                                    <input type="file" name="document_image1[]" required><br>
                                                    <label for="document_image2" class="required">Back Image</label>                                                        
                                                    <input type="file" name="document_image2[]" required>
                                                </td>
                                                
                                                <td class="min-w-250px">
                                                    <label for="document_number" class="required">Document Number:</label>
                                                    <input class="form-control" name="document_number[]" value="{{ old('document_number') }}" placeholder="document Number" required />
                                                </td>
                                                <td class="min-w-250px">
                                                    <label for="document_issue_date" class="required">Issue Date</label>
                                                    <input  type="date" class="form-control" name="document_issue_date[]" value="{{ old('document_issue_date') }}" required />
                                                </td>
                                                <td class="min-w-250px">
                                                    <label for="document_expiry_date" class="required">Expiry Date</label>
                                                    <input  type="date" class="form-control" id="document_expiry_date" name="document_expiry_date[]" value="{{ old('document_expiry_date') }}" required />
                                                </td>
                                                <td class="min-w-250px">
                                                    <label for="document_notes" class="required">Notes</label>
                                                    <textarea cols="10" class="form-control" name="document_notes" required></textarea>
                                                </td>
                                                <td class="min-w-200px">
                                                   
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-5">
                                    <a href="javascript:;" class="btn btn-sm btn-primary mt-3 mt-md-9" id="add_row">
                                        <i class="la la-plus fs-3"></i>Add Row
                                    </a>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12 mb-5">
                                    <x-button class="btn btn-success" style="float: right">Save Customer</x-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        var i=1;
        $('#add_row').click(function(){
            i++;
            var html = '<tr id="row'+i+'">';
                html += '<td><label for="document_type" class="required">Document Type</label><select class="form-select" data-kt-repeater="select2" data-control="select2" data-placeholder="Select an option" name="document_type[]" required><option value="National Identity Card">National Identity Card</option><option value="Driving License">Driver License</option><option value="Passport">Passport</option><option value="Tax Indentification Number">Tax Identification Number</option></select><br><label for="document_image1" class="required">Front Image</label><input type="file" name="document_image1[]" required><br><label for="document_image2" class="required">Back Image</label> <input type="file" name="document_image2[]" required></td>';
                html += '<td><label for="document_number" class="required">Document Number:</label> <input class="form-control" name="document_number[]" value="{{ old('document_number') }}" placeholder="document Number" required /></td>';
                html += '<td><label for="document_issue_date" class="required">Issue Date</label> <input  type="date" class="form-control" name="document_issue_date[]" value="{{ old('document_issue_date') }}" required /></td>';
                html += '<td><label for="document_expiry_date" class="required">Expiry Date</label> <input  type="date" class="form-control" id="document_expiry_date" name="document_expiry_date[]" value="{{ old('document_expiry_date') }}" required /></td>';
                html += '<td><label for="document_notes" class="required">Notes</label><textarea cols="10" class="form-control" name="document_notes" required></textarea></td>';
                html += '<td><a href="javascript:;" class="btn btn-sm btn-danger mt-3 mt-md-9 btn_remove" id="'+i+'"><i class="la la-trash fs-3"></i> Delete</a></td>';
                html += '</tr>';

            $('#dynamic_field').append(html);
            $('[data-kt-repeater="select2"]').select2();
        });
        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });
    </script>

@endsection





