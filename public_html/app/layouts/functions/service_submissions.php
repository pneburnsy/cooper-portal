<?php

function service_hour_submissions($enddate, $latesthours, $loopnumber = 'false', $thisdisplayid = 'false', $submit = 'false') {


    // LASTEST
    $timestamp = strtotime($enddate);
    $lastest_week_number = date("W", $timestamp);
    $lastest_year_number = date("Y", $timestamp);
    $lastest_formatted_date = "$lastest_week_number $lastest_year_number";
    // TODAY
    $timestamp_today = strtotime('today');
    $today_week_number = date("W", $timestamp_today);
    $today_year_number = date("Y", $timestamp_today);
    $today_formatted_date = "$today_week_number $today_year_number";

    if ($lastest_formatted_date != $today_formatted_date) {

        //print_r($latesthours);
        //echo '<p class="outstanding_weeks">This equipment hasn\'t had an ODO reading for <strong>' . count($weekNumberArray) .' week(s)</strong>.</p>';
        $current_week = date('W');
        $current_year = date('Y');
        //$current_week_year = $current_week . ' ' . $current_year;
        //$thisWeeksDates = getStartAndEndDateOfWeek($current_week_year);
        ?><div class="service_submission_block block_1">
            <label for="input_1" style="margin-bottom:5px !important; margin-top: 0 !important;" class="modal_label mb-2">Latest ODO Reading (Week <?= $current_week ?>)</label>
            <?php /* ?> <span class="disclaimer" style="text-align:left;margin-bottom:7px;margin-top:3px;display:block;">Week Beginning: <?= formatted_renewal_date_day($thisWeeksDates['start_date']) ?></span> <?php */ ?>
            <input id="myInput" name="input<?php if($loopnumber !== 'false') { echo '[' . $loopnumber . ']'; } ?>[0]" onchange="validateInput(this)" class="modal_input" type="number" min="<?= $latesthours ?>" data-start-value="<?= $latesthours ?>" placeholder="Min. <?= $latesthours ?> Hrs">
            <input name="input<?php if($loopnumber !== 'false') { echo '[' . $loopnumber . ']'; } ?>[1]" value="<?= $current_week ?>" style="visibility: hidden;width: 0px;padding: 0;border: 0;margin: 0;">
            <input name="input<?php if($loopnumber !== 'false') { echo '[' . $loopnumber . ']'; } ?>[2]" value="<?= $current_year ?>" style="visibility: hidden;width: 0px;padding: 0;border: 0;margin: 0;">
            <?php if($loopnumber !== 'false') { ?>
                <input name="input[<?= $loopnumber ?>][3]" value="<?= $thisdisplayid ?>" style="visibility: hidden;width: 0px;padding: 0;border: 0;margin: 0;">
            <?php } ?>
        </div><?php

        /*
        for ($i = 0; $i < 1; $i++) {
            $i = count($weekNumberArray) - 1;
            $thisWeeksDates = getStartAndEndDateOfWeek($weekNumberArray[$i]);
            $dateData = explode(" ",$weekNumberArray[$i]);
            ?><div class="service_submission_block block_<?= $i ?>">
                <label for="input<?= $i ?>" style="margin-bottom:0 !important;" class="modal_label mb-2">Week <?= $weekNumberArray[$i] ?>*</label>
                <span class="disclaimer" style="text-align:left;margin-bottom:7px;margin-top:3px;display:block;">Week Beginning: <?= formatted_renewal_date_day($thisWeeksDates['start_date']) ?></span>
                <input id="myInput" name="input<?php if($loopnumber !== 'false') { echo '[' . $loopnumber . ']'; } ?>[<?= $i ?>][0]" onchange="validateInput(this)" class="modal_input" type="number" min="<?= $latesthours ?>" data-start-value="<?= $latesthours ?>" <?php if ($i == 0) { ?>value="<?= $latesthours ?>"<?php }?> placeholder="Week <?= $weekNumberArray[$i] ?> (Hrs)" required>
                <input name="input<?php if($loopnumber !== 'false') { echo '[' . $loopnumber . ']'; } ?>[<?= $i ?>][1]" value="<?= $dateData[0] ?>" style="visibility: hidden;width: 0px;padding: 0;border: 0;margin: 0;">
                <input name="input<?php if($loopnumber !== 'false') { echo '[' . $loopnumber . ']'; } ?>[<?= $i ?>][2]" value="<?= $dateData[1] ?>" style="visibility: hidden;width: 0px;padding: 0;border: 0;margin: 0;">
                <?php if($loopnumber !== 'false') { ?>
                    <input name="input[<?= $loopnumber ?>][<?= $i ?>][3]" value="<?= $thisdisplayid ?>" style="visibility: hidden;width: 0px;padding: 0;border: 0;margin: 0;">
                <?php } ?>
            </div><?php
        }

        if (count($weekNumberArray) != 0 && $submit != 'true') { ?><button type="submit" name="service_hour_submission" class="btn btn-primary waves-effect waves-light" style="margin-top:20px;margin-bottom:10px;">Submit Hours</button><?php }
        */

    } else {
        echo '<p class="outstanding_weeks">This equipment is <strong> up-to-date.</strong></p>';
    }

    /* ?>
    <script>
        // Function to update the minimum value attribute of inputs in a group
        function updateMinAttributes(group) {
            let min = Number.NEGATIVE_INFINITY;
            const inputs = group.querySelectorAll('input[type="number"]');

            for (let i = 0; i < inputs.length; i++) {
                const input = inputs[i];
                const inputValue = parseFloat(input.value);

                if (!isNaN(inputValue) && inputValue >= min) {
                    input.min = inputValue;
                    min = inputValue;
                } else {
                    input.min = min;
                }
            }
        }
        // Function to update the value of inputs in a group based on the previous input
        function updateInputValues(input, group) {
            const inputs = group.querySelectorAll('input[type="number"]');
            const currentIndex = Array.from(inputs).indexOf(input);

            for (let i = currentIndex + 1; i < inputs.length; i++) {
                const nextInputValue = parseFloat(inputs[i].value);
                const currentInputValue = parseFloat(input.value);

                if (!isNaN(nextInputValue) && nextInputValue < currentInputValue) {
                    inputs[i].value = currentInputValue;
                    alert('Invalid: Usage hours cannot be less than the previous week.');
                }
            }
        }
        // Function to update the display of minimum values for a group
        function updateMinValueDisplay(group) {
            const inputs = group.querySelectorAll('input[type="number"]');
            const minValueSpans = group.querySelectorAll('.min-value');

            for (let i = 0; i < inputs.length; i++) {
                const input = inputs[i];
                const startingValue = parseFloat(input.getAttribute('data-start-value'));

                if (i === 0 || isNaN(startingValue)) {
                    // First input or missing starting value, display its current value
                    minValueSpans[i].textContent = `Minimum (Hrs): ${input.value}`;
                } else {
                    // Display the value of the input before it
                    const prevInputValue = parseFloat(inputs[i - 1].value);
                    minValueSpans[i].textContent = `Minimum (Hrs): ${prevInputValue}`;
                }
            }
        }
        // Function to validate an input in a group
        function validateInput(input) {
            const group = input.closest('.content_block');
            updateMinAttributes(group);

            const inputs = group.querySelectorAll('input[type="number"]');
            const minValueSpans = group.querySelectorAll('.min-value');
            const currentIndex = Array.from(inputs).indexOf(input);

            // Ensure the first input cannot go below its starting value
            const startingValue = parseFloat(inputs[0].getAttribute('data-start-value'));
            const currentInputValue = parseFloat(input.value);

            if (currentIndex === 0 && !isNaN(startingValue) && currentInputValue < startingValue) {
                alert('Invalid: The first input cannot go below its starting value.');
                input.value = startingValue;
                updateMinAttributes(group);
                updateInputValues(input, group);
                updateMinValueDisplay(group);
                return;
            }

            for (let i = currentIndex - 1; i >= 0; i--) {
                const previousInputValue = parseFloat(inputs[i].value);
                const currentInputValue = parseFloat(input.value);

                if (currentInputValue < previousInputValue) {
                    alert('Invalid: Usage hours cannot be less than the previous week.');
                    input.value = previousInputValue;
                    updateMinAttributes(group);
                    updateInputValues(input, group);
                    updateMinValueDisplay(group);
                    return;
                }
            }

            updateInputValues(input, group);
            updateMinValueDisplay(group);
        }
        // Set up event listeners for each input field in each group
        const inputs = document.querySelectorAll('.content_block input[type="number"]');
        inputs.forEach(input => {
            input.addEventListener('blur', () => {
                validateInput(input);
            });
            input.addEventListener('keypress', event => {
                if (event.key === 'Enter') {
                    validateInput(input);
                }
            });
        });
        // Initialize the minimum values and starting values for each group
        const groups = document.querySelectorAll('.content_block');
        groups.forEach(group => {
            const inputs = group.querySelectorAll('input[type="number"]');
            const startingValue = parseFloat(inputs[0].value);
            inputs[0].setAttribute('data-start-value', startingValue); // Add the attribute to the first input

            // Add the attribute to all other inputs in the group
            for (let i = 1; i < inputs.length; i++) {
                inputs[i].setAttribute('data-start-value', startingValue);
            }

            updateMinAttributes(group);
            updateMinValueDisplay(group);
        });
    </script>
    <?php */

}