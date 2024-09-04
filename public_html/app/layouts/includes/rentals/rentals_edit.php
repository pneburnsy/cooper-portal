<div id="renewal_settings" class="card tab-pane <?php if ($_GET['tab'] == 'renewal_settings') { echo 'active'; } ?>" role="tabpanel">
    <div class="card-body p-0" style="background:#fff;border-radius:10px;padding:0;">
        <div class="row bs-0">
            <div class="col-md-6 p-0">
                <div class="form-highlight">
                    <h4>Contract Settings</h4>
                    <p class="mb-4">Update this current contracts details below. If this contract has ended or needs to be reset - click one of the options below.</p>
                    <form class="edit_renewals" method="post">
                        <div class="modal-top">

                            <div class="modal-card">
                                <div class="modal-card-header">
                                    <h6>Client Account</h6>
                                </div>
                                <div class="form-12 mb-3">
                                    <select name="your-company" class="form-control modal_input" data-trigger id="your-company">
                                        <?php if ($rentals_view[0]->clientaccount) { ?>
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

                            <div class="modal-card">

                                <div class="form-12 mb-3">
                                    <label for="hire_start" class="modal_label">Hire Start Date *</label>
                                    <input name="hire_start" type="date" class="modal_input" id="hire_start" value="<?= $rentals_view[0]->hire_start ?>" required>
                                </div>

                                <div class="form-12 mb-3">
                                    <label for="hire_end" class="modal_label">Hire End Date</label>
                                    <input name="hire_end" type="date" class="modal_input" id="hire_end" value="<?= $rentals_view[0]->hire_end ?>">
                                </div>

                            </div>

                            <?php
                            $selectedRegionValue = isset($rentals_view[0]->region) ? $rentals_view[0]->region : '';
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

                            <div class="form-6">
                                <label for="contract_reference" class="modal_label mt-2">Contract Reference *</label>
                                <input name="contract_reference" maxlength="40" type="text" class="modal_input last-list" id="contract_reference" placeholder="Exp. 283" value="<?= $rentals_view[0]->contract_reference ?>" required>
                            </div>

                            <div class="form-6 lastchild">
                                <label for="contracted_hours" class="modal_label mb-2">Contracted Hours *</label>
                                <input name="contracted_hours" max="999999.5" step="0.5" type="number" class="modal_input" id="contracted_hours" placeholder="Exp. 40" value="<?= $rentals_view[0]->contracted_hours ?>" required>
                            </div>

                            <?php if ( current_user_can('administrator') ) { ?>

                                <div class="form-12">
                                    <label for="rent_rate" class="modal_label">Rent Rate (Weekly) *</label>
                                    <input name="rent_rate" step=".01" max="999999.99" type="number" class="modal_input" id="rent_rate" placeholder="Exp. 1500" value="<?= $rentals_view[0]->rent_rate ?>" required>
                                </div>

                                <div class="form-6">
                                    <label for="excess_rate" class="modal_label">Excess Rate (Hrs) *</label>
                                    <input name="excess_rate" step=".01" max="999999.99" type="number" class="modal_input" id="excess_rate" placeholder="Exp. 127.00" value="<?= $rentals_view[0]->excess_rate ?>" required>
                                </div>

                                <div class="form-6 lastchild mb-1">
                                    <label for="excess_rate_min" class="modal_label">Excess Min Charge *</label>
                                    <input name="excess_rate_min" step=".01" max="999999.99" type="number" class="modal_input" id="excess_rate_min" placeholder="Exp. 14.99" value="<?= $rentals_view[0]->excess_rate_min ?>" required>
                                </div>

                            <?php } ?>

                            <div class="form-12 lastchild mb-4">
                                <label for="notes" class="modal_label">Notes</label>
                                <textarea name="notes" maxlength="500"  class="modal_input" id="notes" placeholder="Enter any notes here..."><?= $rentals_view[0]->notes ?></textarea>
                            </div>

                        </div>
                        <button type="submit" name="rentals_edit" class="btn btn-primary waves-effect waves-light">Update Contract</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>