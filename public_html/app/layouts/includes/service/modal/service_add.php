<?php if (doif_coopereditoronly_query()) { ?>
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#service_add" aria-controls="offcanvasRight">Add New Service Contract +</button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="service_add" aria-labelledby="offcanvasRightLabel">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Add New Service Contract</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="add_accounts" id="services_add" method="post">
                <div class="modal-top">

                    <div class="form-12 mb-3">
                        <label for="make" class="modal_label">Make *</label>
                        <select name="make" class="form-control modal_input" data-trigger id="make">
                            <?php include 'dropdowns/manufacturers.php'; ?>
                        </select>
                    </div>

                    <div class="form-12 mb-3">
                        <label for="region" class="modal_label">Region *</label>
                        <select name="region" class="form-control modal_input" data-trigger id="region">
                            <?php include 'dropdowns/regions.php'; ?>
                        </select>
                    </div>

                    <label for="model" class="modal_label mb-2">Model *</label>
                    <input name="model" maxlength="100" type="text" class="modal_input" id="model" placeholder="Exp. SRSC4531G" required>

                    <div class="form-12">
                        <label for="fleet_no" class="modal_label">Fleet Number *</label>
                        <input name="fleet_no" maxlength="32" type="text" class="modal_input" id="fleet_no" placeholder="Exp. MH86530" required>
                    </div>

                    <div class="form-6">
                        <label for="man_serial_no" class="modal_label">Serial Number *</label>
                        <input name="man_serial_no" maxlength="32" type="text" class="modal_input" id="man_serial_no" placeholder="Exp. 45310033" required>
                    </div>

                    <div class="form-6 lastchild">
                        <label for="eng_serial_no" class="modal_label">Engine Serial Number *</label>
                        <input name="eng_serial_no" maxlength="32" type="text" class="modal_input" id="eng_serial_no" placeholder="Exp. 34262347" required>
                    </div>

                    <div class="form-12 mb-3">
                        <label for="postcode" class="modal_label">Equipment Location (Postcode Only) *</label>
                        <input name="postcode" maxlength="20" type="text" class="modal_input" id="postcode" placeholder="Exp. CV8 1NP" required>
                    </div>

                    <div class="modal-card">
                        <div class="modal-card-header">
                            <h6>Equipment Details</h6>
                        </div>

                        <div class="form-12 mb-3">
                            <p>These details should be what they are at the start of an agreement/when last serviced. <strong>If the agreement is being added part way through, please fill in the 'Latest Equipment Details' too.</strong></p>
                            <div class="form-6">
                                <label for="last_odo_hours" class="modal_label">Last Service ODO Reading (Hrs) *</label>
                                <input name="last_odo_hours" min="0" maxlength="11" type="number" class="modal_input" id="last_odo_hours" placeholder="Exp. 1000" required>
                            </div>

                            <div class="form-6 lastchild">
                                <label for="last_odo_date" class="modal_label">Last Service Date *</label>
                                <input name="last_odo_date" type="date" class="modal_input" id="last_odo_date" required>
                                <p id="error_message_last_date" style="color: red;"></p>
                            </div>
                        </div>

                        <div class="form-12 mb-3">
                            <label for="serviceduein" class="modal_label">Service Due In (Hrs) *</label>
                            <select name="serviceduein" class="form-control modal_input" data-trigger id="serviceduein">
                                <?php include 'dropdowns/service_hours.php'; ?>
                            </select>
                        </div>

                        <div class="form-12">
                            <label for="due_odo_date" class="modal_label">Service Due By *</label>
                            <p>This timeframe will be added onto your Starting Date to give you your Due date.</p>
                            <select name="due_odo_date" class="form-control modal_input" data-trigger id="due_odo_date">
                                <?php include 'dropdowns/service_due_dates.php'; ?>
                            </select>
                        </div>

                    </div>

                    <div class="modal-card">
                        <div class="modal-card-header">
                            <h6>Latest Equipment Details</h6>
                        </div>
                        <p>If you're adding an agreement part way through, enter the last ODO reading hours and date. <strong>If you are adding this service at the start of an agreement/it has no previous service, leave this blank.</strong></p>
                        <div class="form-12 mb-3">
                            <div class="form-6">
                                <label for="lastest_odo_hours" class="modal_label">Latest ODO Reading (Hrs)</label>
                                <input name="lastest_odo_hours" min="0" maxlength="11" type="number" class="modal_input" id="lastest_odo_hours" placeholder="Exp. 1000">
                                <p id="error_message_hours" style="color: red;"></p>
                            </div>


                            <div class="form-6 lastchild">
                                <label for="lastest_odo_date" class="modal_label">Latest ODO Date</label>
                                <input name="lastest_odo_date" type="date" class="modal_input" max="<?php echo date('Y-m-d'); ?>" id="lastest_odo_date">
                                <p id="error_message_latest_date" style="color: red;"></p>
                            </div>
                        </div>

                    </div>

                    <div class="modal-card">
                        <div class="modal-card-header">
                            <h6>Client Account</h6>
                        </div>
                        <div class="form-12 mb-3">
                            <select name="your-company" class="form-control modal_input" data-trigger id="your-company">
                                <option value="" selected>Select Account...</option>
                                <?php for ($i = 0; $i < count($accounts_team_distinct); $i++) {
                                    ?><option value="<?= $accounts_team_distinct[$i]->displayid; ?>"><?= $accounts_team_distinct[$i]->accountname; ?></option><?php
                                } ?>
                            </select>
                        </div>
                    </div>

                    <p id="error_message_latest_mismatch" style="color: red;text-align:right"></p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="offcanvas">Cancel</button>
                    <button type="submit" id="service_add_submit" name="service_add" class="btn btn-primary waves-effect waves-light">Add Service Contract</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const lastOdoHoursInput = document.getElementById('last_odo_hours');
        const latestOdoHoursInput = document.getElementById('lastest_odo_hours');
        const lastOdoDateInput = document.getElementById('last_odo_date');
        const latestOdoDateInput = document.getElementById('lastest_odo_date');
        const hoursErrorMessage = document.getElementById('error_message_hours');
        const lastOdoDateErrorMessage = document.getElementById('error_message_last_date');
        const latestOdoDateErrorMessage = document.getElementById('error_message_latest_date');
        const latestOdoMismatchErrorMessage = document.getElementById('error_message_latest_mismatch'); // New error message
        const submitButton = document.getElementById('service_add_submit');

        lastOdoHoursInput.addEventListener('input', checkHours);
        latestOdoHoursInput.addEventListener('input', checkHours);
        lastOdoDateInput.addEventListener('input', checkLastOdoDate);
        latestOdoDateInput.addEventListener('input', checkLatestOdoDate);

        function checkHours() {
            const lastOdoHours = parseInt(lastOdoHoursInput.value, 10);
            const latestOdoHours = parseInt(latestOdoHoursInput.value, 10);

            if (!isNaN(lastOdoHours) && !isNaN(latestOdoHours)) {
                if (latestOdoHours < lastOdoHours) {
                    hoursErrorMessage.textContent = "Latest ODO hours cannot be less than the last service.";
                } else {
                    hoursErrorMessage.textContent = "";
                }
            } else {
                hoursErrorMessage.textContent = "";
            }

            // Enable or disable the button based on errors
            updateSubmitButtonState();
        }

        function checkLastOdoDate() {
            const today = new Date();
            const lastOdoDate = new Date(lastOdoDateInput.value);

            if (!isNaN(lastOdoDate.getTime())) {
                if (lastOdoDate > today) {
                    lastOdoDateErrorMessage.textContent = "Last ODO date cannot be in the future.";
                } else {
                    lastOdoDateErrorMessage.textContent = "";
                }
            } else {
                lastOdoDateErrorMessage.textContent = "";
            }

            // Enable or disable the button based on errors
            updateSubmitButtonState();
        }

        function checkLatestOdoDate() {
            const today = new Date();
            const latestOdoDate = new Date(latestOdoDateInput.value);

            if (!isNaN(latestOdoDate.getTime())) {
                if (latestOdoDate > today) {
                    latestOdoDateErrorMessage.textContent = "Latest ODO date cannot be in the future.";
                } else {
                    latestOdoDateErrorMessage.textContent = "";
                }
            } else {
                latestOdoDateErrorMessage.textContent = "";
            }

            // Enable or disable the button based on errors
            updateSubmitButtonState();
        }

        function updateSubmitButtonState() {
            if (
                (latestOdoHoursInput.value !== '' && latestOdoDateInput.value === '') ||
                (latestOdoHoursInput.value === '' && latestOdoDateInput.value !== '')
            ) {
                latestOdoMismatchErrorMessage.textContent = "Either both or none of the fields from 'Latest Equipment Details' must be filled in.";
                submitButton.disabled = true;
            } else {
                latestOdoMismatchErrorMessage.textContent = "";
                submitButton.disabled = hoursErrorMessage.textContent !== "" || lastOdoDateErrorMessage.textContent !== "" || latestOdoDateErrorMessage.textContent !== "";
            }
        }

    </script>
<?php } ?>