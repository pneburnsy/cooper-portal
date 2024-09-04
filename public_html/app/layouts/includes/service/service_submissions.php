<div id="service_submissions" class="card tab-pane <?php if ($_GET['tab'] == 'service_submissions') { echo 'active'; } ?>" role="tabpanel">
    <div class="card-body p-0" style="background:#fff;border-radius:10px;padding:0;">
        <div class="row bs-0">
            <div class="col-md-6 p-0">
                <div class="form-highlight">
                    <h4>Complete Service</h4>
                    <p class="mb-5">Log a service for this equipment and enter the next service date and hours. <strong>Use this to log a service only - to edit the current service please go to the 'Service Settings' tab.</strong></p>
                    
                    <form class="add_accounts" method="post">

                        <h5 class="mb-2">Completed Service Details</h5>
                        <div class="form-4 mb-4 vertical-top">
                            <label for="submitted_last_odo_date" class="modal_label">Date When Serviced *</label>
                            <input name="submitted_last_odo_date" type="date" min="<?= date('Y-m-d', strtotime($service_view[0]->last_odo_date)); ?>" max="<?= date('Y-m-d') ?>" class="modal_input" id="last_odo_date" required>
                            <span class="small-warning-text">Latest ODO Submission (Date): <?= formatted_renewal_date($service_view[0]->lastest_odo_date) ?></span>
                        </div>
                        <div class="form-4 mb-4 vertical-top">
                            <label for="submitted_last_odo_hours" class="modal_label">ODO Reading When Serviced *</label>
                            <input name="submitted_last_odo_hours" type="number" class="modal_input" min="<?= $service_view[0]->last_odo_hours ?>" id="last_odo_hours" required>
                            <span class="small-warning-text">Latest ODO Submission (Hrs): <?= $service_view[0]->lastest_odo_hours ?></span>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {

                                    //Variables to store hours and math calculations.
                                    var currentOdoHourInput = document.querySelector('input[name="submitted_last_odo_hours"]');
                                    var latestOdoSubmission = <?= $service_view[0]->lastest_odo_hours ?>;
                                    var maxValue = latestOdoSubmission + 500; 

                                    // var warningContainer = document.createElement("div");
                                    // document.body.appendChild(warningContainer);

                                    //Variables to store the id's for targetted styling.
                                    var classElement = document.getElementById("last_odo_hours");
                                    var warningMessage = document.getElementById("warning_message_id");
                                    // var errorButtonSpan = document.getElementById("warning_button");

                                    currentOdoHourInput.addEventListener("input", function() {

                                        var currentOdoInput = parseFloat(currentOdoHourInput.value);

                                        //If statement to check user input vs value limit
                                        if (currentOdoInput > maxValue) {
                                            classElement.classList.add("odo_hours_error");

                                            //Warning Message
                                            warningMessage.innerText = "Warning: Your service input hours are greater than 500, is this correct?";
                                            document.getElementById("warning_message_id").appendChild(warningMessage);

                                            // var odo_error_button = document.createElement("button");
                                            // odo_error_button.innerText = "Yes, I am Sure";
                                            // odo_error_button.addEventListener("click", function() {
                                            //     warningMessage.innerHTML = "";
                                            //     classElement.classList.remove("odo_hours_error");
                                            //     document.getElementById("warning_message_id").removeChild(odo_error_button);
                                            // });
                                            // errorButtonSpan.innerHTML = "";
                                            // errorButtonSpan.appendChild(odo_error_button);

                                            //else if (currentOdoInput < latestOdoSubmission ) {
                                            //    warningMessage.innerText = "Warning: Your service input hours are less than the previous ODO submission, is this correct?";
                                            //    document.getElementById("warning_message_id").appendChild(warningMessage);
                                            //}

                                        } else {

                                            //Remove the error notifications from the page.
                                            classElement.classList.remove("odo_hours_error");   
                                            document.getElementById("warning_message_id").innerHTML = "";

                                        }

                                    });
                                });
                            </script>

                            <?php
                            //function check_odo_value ($last_odo_value, $current_odo_value) {
                            //    if ($last_odo_value > ($current_odo_value + 500)) {
                            //        echo "Your latest input for service hours are over 500, is this correct?";
                            //    }
                            //}
                            //if ($_SERVER["REQUEST_METHOD"] === "POST") {
                            //    $last_odo_value = $_POST['last_odo_hours'];
                            //
                            //    $current_odo_value = $service_view[0]->lastest_odo_hours;
                            //
                            //    echo "Latest ODO Value: $current_odo_value";
                            //    check_odo_value($last_odo_value, $current_odo_value);
                            //}
                            ?>

                        </div>
                        <div class="form-4 lastchild mb-4 vertical-top">
                            <label for="typedata" class="modal_label">Service Type *</label>
                            <select name="typedata" class="form-control modal_input" data-trigger id="typedata">
                                <?php include 'dropdowns/service_hours.php'; ?>
                            </select>
                        </div>

                        <h5 class="mb-2">Next Service Details</h5>
                        <div class="form-6 mb-4">
                            <label for="serviceduein" class="modal_label">Next Service Due In (Hrs) *</label>
                            <select name="serviceduein" class="form-control modal_input" data-trigger id="serviceduein">
                                <?php include 'dropdowns/service_hours.php'; ?>
                            </select>
                        </div>
                        <div class="form-6 lastchild mb-5">
                            <label for="due_odo_date" class="modal_label">Next Service Due By *</label>
                            <select name="due_odo_date" class="form-control modal_input" data-trigger id="due_odo_date">
                                <?php include 'dropdowns/service_due_dates.php'; ?>
                            </select>
                        </div>

                        <input name="submitted_lastest_odo_hours" style="display:none !important;" id="submitted_lastest_odo_hours" value="<?= $service_view[0]->lastest_odo_hours ?>" required>

                        <input type="hidden" name="submission_servicebydate" value="<?= $service_view[0]->due_odo_date ?>">

                        <span id="warning_message_id"></span>
<!--                        <button id="warning_button"></button>-->
                        <button type="submit" name="service_submission_page" value="<?= $service_view[0]->displayid ?>" class="btn btn-primary waves-effect waves-light">Submit Service Details</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>