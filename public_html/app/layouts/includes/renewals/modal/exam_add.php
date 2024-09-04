<?php if (doif_coopereditoronly_query()) { ?>
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#exam_add" aria-controls="offcanvasRight">Add New Renewal +</button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="exam_add" aria-labelledby="offcanvasRightLabel">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Add New Thorough Examination</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="add_accounts" method="post">
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
                    <input name="model" maxlength="80" type="text" class="modal_input" id="model" placeholder="Exp. SRSC4531G" required>

                    <div class="form-6">
                        <label for="fleet_no" class="modal_label">Fleet Number *</label>
                        <input name="fleet_no" maxlength="32" type="text" class="modal_input" id="fleet_no" placeholder="Exp. MH86530" required>
                    </div>

                    <div class="form-6 lastchild">
                        <label for="serial_no" class="modal_label">Serial Number *</label>
                        <input name="serial_no" maxlength="32" type="text" class="modal_input" id="serial_no" placeholder="Exp. 45310033" required>
                    </div>

                    <div class="form-6">
                        <label for="year_of_man" class="modal_label mt-2">Year of Manufacturer *</label>
                        <input name="year_of_man" type="number" maxlength="4" class="modal_input last-list" id="year_of_man" placeholder="Exp. 2023" required>
                    </div>

                    <div class="form-6 lastchild">
                        <label for="hour_reading" class="modal_label mt-2">Hour Reading *</label>
                        <input name="hour_reading" maxlength="11" type="number" class="modal_input last-list" id="hour_reading" placeholder="Exp. 10,000" required>
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

                    <div class="modal-card">

                        <div class="form-12 mb-3">
                            <label for="renewal_date" class="modal_label">Renewal Date *</label>
                            <input name="renewal_date" type="date" class="modal_input" id="renewal_date" required>
                        </div>

                        <div class="form-12 mb-3">
                            <label for="issue_date" class="modal_label">Issue Date *</label>
                            <input name="issue_date" type="date" class="modal_input" id="issue_date" required>
                        </div>

                        <div class="form-12 mb-3">
                            <label for="expiry_date" class="modal_label">Expiry Date *</label>
                            <input name="expiry_date" type="date" class="modal_input" id="expiry_date" required>
                        </div>

                    </div>

                    <div class="modal-card">

                        <div class="form-6">
                            <label for="record_number" class="modal_label mb-2">Record Number *</label>
                            <input name="record_number" maxlength="11" type="text" class="modal_input" id="record_number" placeholder="Exp. 0753502" required>
                        </div>

                        <div class="form-6 lastchild">
                            <label for="issuing_company" class="modal_label">Issuing Company *</label>
                            <input name="issuing_company" maxlength="80" type="text" class="modal_input" id="issuing_company" placeholder="Exp. Fork East Ltd" required>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="offcanvas">Cancel</button>
                    <button type="submit" name="exam_add" class="btn btn-primary waves-effect waves-light">Add Renewal</button>
                </div>
            </form>
        </div>
    </div>
<?php } ?>