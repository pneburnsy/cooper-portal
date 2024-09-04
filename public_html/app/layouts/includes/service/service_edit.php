<div id="service_settings" class="card tab-pane <?php if ($_GET['tab'] == 'service_settings') { echo 'active'; } ?>" role="tabpanel">
    <div class="card-body p-0" style="background:#fff;border-radius:10px;padding:0;">
        <div class="row bs-0">
            <div class="col-md-6 p-0">
                <div class="form-highlight">
                    <h4>General Settings</h4>
                    <p class="mb-4">Update this service contracts details below. If you want to update or log a service, please go to the service tab.</p>
                    <form class="add_accounts" method="post">

                        <div class="modal-top">

                            <div class="form-12 mb-3">
                                <label for="make" class="modal_label">Make *</label>
                                <select name="make" class="form-control modal_input" data-trigger id="make">
                                    <?php if ($service_view[0]->make) { ?>
                                        <option value="<?= $service_view[0]->make ?>">Current: <?= $service_view[0]->make ?></option>
                                    <?php } ?>
                                    <?php include 'dropdowns/manufacturers.php'; ?>
                                </select>
                            </div>

                            <?php
                            $selectedRegionValue = isset($service_view[0]->region) ? $service_view[0]->region : '';
                            ?>

                            <div class="form-12 mb-3">
                                <label for="region" class="modal_label">Region *</label>
                                <select name="region" class="form-control modal_input" data-trigger id="region">
                                    <?php if ($selectedRegionValue !== '') { ?>
                                        <option value="<?= $selectedRegionValue ?>">
                                            Selected: <?php
                                            switch($selectedRegionValue) {
                                                case '0':
                                                    echo 'Mainland UK';
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
                            <input name="model" maxlength="80" type="text" class="modal_input" id="model" placeholder="Exp. SRSC4531G" value="<?= $service_view[0]->model ?>" required>

                            <div class="form-12">
                                <label for="fleet_no" class="modal_label">Fleet Number *</label>
                                <input name="fleet_no" maxlength="32" type="text" class="modal_input" id="fleet_no" placeholder="Exp. MH86530" value="<?= $service_view[0]->fleet_no ?>" required>
                            </div>

                            <div class="form-6">
                                <label for="man_serial_no" class="modal_label">Serial Number *</label>
                                <input name="man_serial_no" maxlength="32" type="text" class="modal_input" id="man_serial_no" placeholder="Exp. 45310033" value="<?= $service_view[0]->man_serial_no ?>" required>
                            </div>

                            <div class="form-6 lastchild">
                                <label for="eng_serial_no" class="modal_label">Engine Serial Number *</label>
                                <input name="eng_serial_no" maxlength="32" type="text" class="modal_input" id="eng_serial_no" placeholder="Exp. 34262347" value="<?= $service_view[0]->eng_serial_no ?>" required>
                            </div>

                            <div class="form-12 mb-3">
                                <label for="postcode" class="modal_label">Equipment Location (Postcode Only) *</label>
                                <input name="postcode" maxlength="10" type="text" class="modal_input" id="postcode" placeholder="Exp. CV8 1NP" value="<?= $service_view[0]->postcode ?>" required>
                            </div>

                            <div class="modal-card">
                                <div class="modal-card-header">
                                    <h6>Client Account</h6>
                                </div>
                                <div class="form-12 mb-3">
                                    <select name="your-company" class="form-control modal_input" data-trigger id="your-company">
                                        <?php if ($service_view[0]->clientaccount) { ?>
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

                        </div>

                        <button type="submit" name="service_edit" class="btn btn-primary waves-effect waves-light">Update Service Contract</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>