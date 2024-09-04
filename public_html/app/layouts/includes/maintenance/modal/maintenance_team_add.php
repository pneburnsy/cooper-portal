<?php if (doif_coopereditoronly_query()) { ?>
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#main_add" aria-controls="offcanvasRight">Add New Renewal +</button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="main_add" aria-labelledby="offcanvasRightLabel">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Add New Maintenance Contract</h5>
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
                        <label for="region" class="model_label">Region *</label>
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

                    <div class="form-12">
                        <label for="year_of_man" class="modal_label mt-2">Year of Manufacturer *</label>
                        <input name="year_of_man" type="number" maxlength="4" class="modal_input last-list" id="year_of_man" placeholder="Exp. 2023" required>
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

                        <div class="form-6 mb-3">
                            <label for="contractid" class="modal_label mb-2">Contract ID *</label>
                            <input name="contractid" maxlength="40" type="text" class="modal_input" id="contractid" placeholder="Exp. M12" required>
                        </div>

                        <div class="form-6 lastchild mb-3">
                            <label for="hours_per_annum" class="modal_label mb-2">Per Annum (Hrs) *</label>
                            <input name="hours_per_annum" maxlength="11" type="number" class="modal_input" id="hours_per_annum" placeholder="Exp. 2000" required>
                        </div>

                        <div class="form-12 mb-3">
                            <label for="start_date" class="modal_label">Start Date *</label>
                            <input name="start_date" type="date" class="modal_input" id="start_date" required>
                        </div>

                        <div class="form-12 mb-3">
                            <label for="end_date" class="modal_label">End Date *</label>
                            <input name="end_date" type="date" class="modal_input" id="end_date" required>
                        </div>

                        <div class="form-12 mb-3">
                            <label for="contract_review" class="modal_label">Contract Review *</label>
                            <input name="contract_review" type="date" class="modal_input" id="contract_review" required>
                        </div>

                    </div>

                    <div class="modal-card">

                        <div class="form-6">
                            <label for="main_cost" class="modal_label">Cost (Monthly) *</label>
                            <input name="main_cost" maxlength="80" type="number" step="0.01" class="modal_input" id="main_cost" placeholder="Exp. 1200.00" required>
                        </div>

                        <div class="form-6 lastchild">
                            <label for="main_hourly" class="modal_label">Cost (Hourly)</label>
                            <input name="main_hourly" maxlength="80" type="number" step="0.01" class="modal_input" id="main_hourly" placeholder="Exp. 12.00">
                        </div>

                        <div class="form-12">
                            <label for="main_excess" class="modal_label">Excess Rate (Hrs)</label>
                            <input name="main_excess" maxlength="80" type="number" step="0.01" class="modal_input" id="main_excess" placeholder="Exp. 22.20">
                        </div>

                        <div class="form-6">
                            <label for="only_500" class="modal_label">500 Hours</label>
                            <input name="only_500" maxlength="80" type="number" step="0.01" class="modal_input" id="only_500" placeholder="Exp. 100.99">
                        </div>

                        <div class="form-6 lastchild">
                            <label for="only_1000" class="modal_label">1000 Hours</label>
                            <input name="only_1000" maxlength="80" type="number" step="0.01" class="modal_input" id="only_1000" placeholder="Exp. 120.99">
                        </div>

                        <div class="form-6">
                            <label for="only_2000" class="modal_label">2000 Hours</label>
                            <input name="only_2000" maxlength="80" type="number" step="0.01" class="modal_input" id="only_2000" placeholder="Exp. 140.99">
                        </div>

                        <div class="form-6 lastchild">
                            <label for="only_3000" class="modal_label">3000 Hours</label>
                            <input name="only_3000" maxlength="80" type="number" step="0.01" class="modal_input" id="only_3000" placeholder="Exp. 160.99">
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="offcanvas">Cancel</button>
                    <button type="submit" name="maintenance_add" class="btn btn-primary waves-effect waves-light">Add Renewal</button>
                </div>
            </form>
        </div>
    </div>
<?php } ?>