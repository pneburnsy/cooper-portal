<div id="renewal_settings" class="card tab-pane <?php if ($_GET['tab'] == 'renewal_settings') { echo 'active'; } ?>" role="tabpanel">
    <div class="card-body p-0" style="background:#fff;border-radius:10px;padding:0;">
        <div class="row bs-0">
            <div class="col-md-6 p-0">
                <div class="form-highlight">
                    <h4>Renewal Settings</h4>
                    <p class="mb-4">Update this renewal details below.</p>
                    <form class="edit_renewals" method="post">
                        <div class="modal-top">

                            <div class="form-12 mb-3">
                                <label for="make" class="modal_label">Make *</label>
                                <select name="make" class="form-control modal_input" data-trigger id="make">
                                    <?php if ($exam_view[0]->make) { ?>
                                        <option value="<?= $exam_view[0]->make ?>">Current: <?= $exam_view[0]->make ?></option>
                                    <?php } ?>
                                    <?php include 'dropdowns/manufacturers.php'; ?>
                                </select>
                            </div>

                            <?php
                            $selectedRegionValue = isset($exam_view[0]->region) ? $exam_view[0]->region : '';
                            ?>

                            <div class="form-12 mb-3">
                                <label for="region" class="modal_label">Region *</label>
                                <select name="region" class="form-control modal_input" data-trigger id="region">
                                    <?php if ($selectedRegionValue !== '') { ?>
                                        <option value="<?= $selectedRegionValue ?>">
                                            Selected: <?php
                                            switch($selectedRegionValue) {
                                                case '0':
                                                    echo "Mainland UK";
                                                    break;
                                                case '1':
                                                    echo "Ireland";
                                                    break;
                                                default:
                                                    echo "Unknown Region"; }
                                            ?></option>
                                    <?php } ?>
                                    <?php include 'dropdowns/regions.php'; ?>
                                </select>
                            </div>

                            <label for="model" class="modal_label mb-2">Model *</label>
                            <input name="model" maxlength="80" type="text" class="modal_input" id="model" placeholder="Exp. SRSC4531G" value="<?= $exam_view[0]->model ?>" required>

                            <div class="modal-card">
                                <div class="modal-card-header">
                                    <h6>Client Account</h6>
                                </div>
                                <div class="form-12 mb-3">
                                    <select name="your-company" class="form-control modal_input" data-trigger id="your-company">
                                        <?php if ($exam_view[0]->clientaccount) { ?>
                                            <option value="<?= $accounts_team_single[0]->displayid; ?>" selected>Current: <?= $accounts_team_single[0]->accountname; ?></option>
                                        <?php } else { ?>
                                            <option value="" selected>Select Account...</option>
                                        <?php } ?>
                                        <?php for ($i = 0; $i < count($accounts_team_distinct); $i++) {
                                            ?><option value="<?= $accounts_team_distinct[$i]->displayid; ?>"><?= $accounts_team_distinct[$i]->accountname; ?></option><?php
                                        } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-6">
                                <label for="fleet_no" class="modal_label">Fleet Number *</label>
                                <input name="fleet_no" maxlength="32" type="text" class="modal_input" id="fleet_no" placeholder="Exp. MH86530" value="<?= $exam_view[0]->fleet_no ?>" required>
                            </div>

                            <div class="form-6 lastchild">
                                <label for="serial_no" class="modal_label">Serial Number *</label>
                                <input name="serial_no" maxlength="32" type="text" class="modal_input" id="serial_no" placeholder="Exp. 45310033" value="<?= $exam_view[0]->serial_no ?>" required>
                            </div>

                            <div class="form-6">
                                <label for="year_of_man" class="modal_label mt-2">Year of Manufacturer *</label>
                                <input name="year_of_man" type="number" maxlength="4" class="modal_input last-list" id="year_of_man" placeholder="Exp. 2023" value="<?= $exam_view[0]->year_of_man ?>" required>
                            </div>

                            <div class="form-6 lastchild">
                                <label for="hour_reading" class="modal_label mt-2">Hour Reading *</label>
                                <input name="hour_reading" maxlength="11" type="number" class="modal_input last-list" id="hour_reading" placeholder="Exp. 10,000" value="<?= $exam_view[0]->hour_reading ?>" required>
                            </div>

                            <div class="modal-card">

                                <div class="form-12 mb-3">
                                    <label for="renewal_date" class="modal_label">Renewal Date *</label>
                                    <input name="renewal_date" type="date" class="modal_input" id="renewal_date" value="<?= $exam_view[0]->renewal_date ?>" required>
                                </div>

                                <div class="form-12 mb-3">
                                    <label for="issue_date" class="modal_label">Issue Date *</label>
                                    <input name="issue_date" type="date" class="modal_input" id="issue_date" value="<?= $exam_view[0]->issue_date ?>" required>
                                </div>

                                <div class="form-12 mb-3">
                                    <label for="expiry_date" class="modal_label">Expiry Date *</label>
                                    <input name="expiry_date" type="date" class="modal_input" id="expiry_date" value="<?= $exam_view[0]->expiry_date ?>" required>
                                </div>

                            </div>

                            <div class="form-6">
                                <label for="record_number" class="modal_label mb-2">Record Number *</label>
                                <input name="record_number" maxlength="11" type="text" class="modal_input" id="record_number" placeholder="Exp. 0753502" value="<?= $exam_view[0]->record_number ?>" required>
                            </div>

                            <div class="form-6 lastchild">
                                <label for="issuing_company" class="modal_label">Issuing Company *</label>
                                <input name="issuing_company" maxlength="80" type="text" class="modal_input" id="issuing_company" placeholder="Exp. Fork East Ltd" value="<?= $exam_view[0]->issuing_company ?>" required>
                            </div>

                        </div>
                        <button type="submit" name="exam_edit" class="btn btn-primary waves-effect waves-light">Update Renewal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>