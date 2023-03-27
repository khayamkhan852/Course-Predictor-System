<script>
    $(document).ready(function() {
        $('#step-2, #step-3, #step-4, #prev-btn').hide();

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
            } else {
                setButtonState('#next-btn', 'show');
            }
        }


        $('#next-btn').click(function() {
            let currentStep = $('.step:visible');
            currentStep.toggle();
            let nextStep = currentStep.next('.step');
            nextStep.toggle();
            setActiveHeader(nextStep.attr('data-for-header'));
            setButtonStates(nextStep);
        });

        $('#prev-btn').click(function() {
            let currentStep = $('.step:visible');
            let prevStep = currentStep.prev('.step');
            currentStep.toggle();
            prevStep.toggle();
            setActiveHeader(prevStep.attr('data-for-header'));
            setButtonStates(prevStep);
        });
    });
</script>
