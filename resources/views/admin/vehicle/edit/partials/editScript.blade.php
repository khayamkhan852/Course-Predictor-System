<script>
    $(document).ready(function() {
        $('#step-2, #step-3, #step-4, #prev-btn, #submit-btn').hide();

        function setButtonState(buttonId, state) {
            $(buttonId).toggle(state === 'show');
        }

        function setActiveHeader(stepId) {
            $('.stepper-item').removeClass('current');
            $(`.stepper-item[id=${stepId}]`).addClass('current');
        }

        function setButtonStates(currentStep) {
            if (currentStep.is(':first-of-type')) {
                setButtonState('#prev-btn', 'hide');
            } else {
                setButtonState('#prev-btn', 'show');
            }
            if (currentStep.is(':last-of-type')) {
                setButtonState('#next-btn', 'hide');
                setButtonState('#submit-btn', 'show');
            } else {
                setButtonState('#next-btn', 'show');
                setButtonState('#submit-btn', 'hide');
            }
        }


        $('#next-btn').click(function() {
            let currentStep = $('.step:visible');
            let form = $('#add_vehicle_form')[0];
            let formData = new FormData(form);
            if (validateStep(currentStep, formData)) {
                currentStep.toggle();
                let nextStep = currentStep.next('.step');
                nextStep.toggle();
                setActiveHeader(nextStep.attr('data-for-header'));
                setButtonStates(nextStep);
            }
        });

        $('#prev-btn').click(function() {
            let currentStep = $('.step:visible');
            let prevStep = currentStep.prev('.step');
            currentStep.toggle();
            prevStep.toggle();
            setActiveHeader(prevStep.attr('data-for-header'));
            setButtonStates(prevStep);
        });

        function validateStep(step, formData) {
            let stepIndex = $('.step').index(step) + 1;
            switch(stepIndex) {
                case 1:
                    return validateFirstStep(formData);
                case 2:
                    return true;
                case 3:
                    return validateThirdStep(formData);
                default:
                    return false;
            }
        }

        function validateFirstStep(formData) {
            let vehicleId = $('#add_vehicle_form').data('vehicle_id');
            let url = '{{ route("admin.operations.vehicles.validate.step.one.edit", ":id") }}';
            url = url.replace(':id', vehicleId);

            let flag = false;
            $.ajax({
                url : url,
                type : 'POST',
                data : formData,
                async: false,
                contentType : false,
                processData : false,
                success : function(data){
                    refreshErrors();
                    flag = true;
                },
                error : function(reject) {
                    refreshErrors()
                    if(reject.status === 422) {
                        let errors = $.parseJSON(reject.responseText);
                        $.each(errors.errors, function(key, value){
                            $('#' + key + '_error').append(value[0]);
                        });
                    }
                }
            });
            return flag;
        }
        function validateThirdStep(formData) {
            let flag = false;
            $.ajax({
                url : '{{ route('admin.operations.vehicles.validate.step.three') }}',
                type : 'POST',
                data : formData,
                async: false,
                contentType : false,
                processData : false,
                success : function(data){
                    refreshErrors();
                    flag = true;
                },
                error : function(reject) {
                    refreshErrors()
                    if(reject.status === 422) {
                        let errors = $.parseJSON(reject.responseText);
                        $.each(errors.errors, function(key, value){
                            $('#' + key + '_error').append(value[0]);
                        });
                    }
                }
            });
            return flag;
        }
        $('#add_vehicle_form').on('submit', function (event) {
            event.preventDefault();

            let vehicleId = $(this).data('vehicle_id');
            let url = '{{ route("admin.operations.vehicles.update", ":id") }}';
            url = url.replace(':id', vehicleId);
            let form = $('#add_vehicle_form')[0];
            let formData = new FormData(form);
            $.ajax({
                url : url,
                type : 'POST',
                data : formData,
                contentType : false,
                processData : false,
                processing : true,
                async: false,
                success : function(data){
                    refreshErrors();
                    $("#add_vehicle_form").trigger("reset");
                    $(".form-select").val('').trigger('change');

                    Swal.fire({
                        icon: 'success',
                        text: 'Vehicle updated Successfully!',
                    }).then( () => {
                        window.location = "{{ route('admin.operations.vehicles.index') }}";
                    });

                },
                error : function(reject){
                    refreshErrors()
                    if(reject.status === 422) {
                        let errors = $.parseJSON(reject.responseText);
                        $.each(errors.errors, function(key, value){
                            $('#' + key + '_error').append(value[0]);
                        });
                    }
                    if (reject.status === 404) {
                        Swal.fire({
                            title: "Something Went Wrong",
                            icon: 'warning',
                            text: 'Please Try Again',
                        });
                    }
                }
            });
        })

        function refreshErrors() {
            $('.removeError').empty();
        }

        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        $('#select_owner').on('change', function () {
            refreshErrors();
            $('.owners').hide();
            if($(this).val() === 'partner') {
                $("#partner").show();
            } else if($(this).val() === 'company') {
                $("#company").show();
            } else {
                $('.owners').show();
            }
        });

        var uploadedDocumentMap = {};
        var myDropzone = new Dropzone("#vehicleDamagesDropZone", {
            init: function() {
                @foreach ($vehicle->vehicleDamage->getMedia('vehicleDamages') as $image)
                    var mockFile = {
                        name: "{{ $image->file_name }}",
                        size: {{ File::size($image->getPath()) }},
                        customFileName: "{{ $image->file_name }}",
                        id: {{ $image->id }}
                    };

                    this.emit("addedfile", mockFile);
                    this.emit("thumbnail", mockFile, "{{ $image->getUrl() }}");
                    this.emit("complete", mockFile);
                @endforeach
            },
            url: "{{ route('admin.temporary.file.upload.dropzone', 'vehicle') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            paramName: "file",
            maxFiles: 20,
            maxFilesize: 3, // MB
            addRemoveLinks: true,
            acceptedFiles: 'image/jpeg,image/png,image/jpg',
            accept: function(file, done) {
                done();
            },
            success: function (file, response) {
                $('#appendingDamageImages').append('<input type="hidden" name="damageImages[]" value="' + response.name + '">');
                uploadedDocumentMap[file.name] = response.name;
            },
            error: function(file, response) {
                Swal.fire({
                    title: "Something Went Wrong",
                    icon: 'warning',
                    text: 'Error with the Image! Try Again',
                });
            },
            removedfile: function (file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.customFileName !== 'undefined') {
                    name = file.customFileName;
                } else {
                    name = uploadedDocumentMap[file.name];
                }
                $('#appendingDamageImages').find('input[name="damageImages[]"][value="' + name + '"]').remove();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.dropzone.remove.image') }}",
                    data: {
                        'filename': name,
                        'id': file.id
                    },
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(data){
                    },
                    error : function(reject){
                        Swal.fire({
                            title: "Something Went Wrong",
                            icon: 'warning',
                            text: 'Please Try Again, Refresh the Form',
                        });
                    }
                });
            },
        });

    });


</script>
