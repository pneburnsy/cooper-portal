<div id="pipeline_settings" class="card tab-pane <?php if ($_GET['tab'] == 'pipeline_settings') { echo 'active'; } ?>" role="tabpanel">
    <div class="card-body !p-0" style="background:#fff;border-radius:10px; padding:0;">
        <div class="row bs-0">
            <div class="col-md-12 p-0">
                <form class="add_accounts form-highlight" style="max-width:1000px;" method="post">
                    <h4>Your Settings</h4>
<!--                    --><?php
//                    print_r($pipeline_view);
//                    ?>
                    <p class="mb-4">Adjust your account settings here.</p>

                    <label for="name" class="modal_label mb-2">Name *</label>
                    <input name="name" maxlength="80" type="text" class="modal_input" value="<?= $pipeline_view[0]->name ?>" id="name" placeholder="Name Deal..." required>

                    <label for="desc" class="modal_label mb-2">Description</label>
                    <textarea name="desc" class="modal_input" id="desc" placeholder="More information on this deal..."><?= $pipeline_view[0]->desc ?></textarea>

                    <div class="form-12 mb-3">
                        <label for="assignee" class="modal_label">Assigned To *</label>
                        <select name="assignee" class="form-control modal_input" data-trigger id="assignee">
                            <?php if (isset($pipeline_view[0]->assignee)){ ?>
                                <option value="<?= $pipeline_view[0]->user_id ?>" selected>Current: <?= other_user_fullname($pipeline_view[0]->assignee) ?></option>
                                <?php foreach($all_cooper_users as $user) {
                                    ?><option value="<?= $user->ID ?>"><?= $user->display_name ?></option><?php
                                }
                            } else {?>
                                <option value="" selected disabled>Assign New User</option>
                                <?php foreach($all_cooper_users as $user) {
                                    ?><option value="<?= $user->ID ?>"><?= $user->display_name ?></option><?php
                                } ?>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-12 mb-3">
                        <label for="make" class="modal_label">Manufacturer</label>
                        <select name="make" class="form-control modal_input" data-trigger id="make">
                            <?php if ($pipeline_view[0]->make) { ?>
                                <option value="<?= $pipeline_view[0]->make ?>">Current: <?= $pipeline_view[0]->make ?></option>
                                <option value="">None</option>
                            <?php } else { ?>
                                <option value="">None</option>
                            <?php } ?>
                            <?php include 'dropdowns/manufacturers.php'; ?>
                        </select>
                    </div>

                    <?php
                    $selectedRegionValue = isset($pipeline_view[0]->region) ? $pipeline_view[0]->region : '';
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

                    <div class="modal-card">
                        <div class="modal-card-header">
                            <h6>Client Account</h6>
                        </div>
                        <div class="form-12 mb-3">
                            <select name="your-company" class="form-control modal_input" data-trigger id="your-company">
                                <?php if ($pipeline_view[0]->clientaccount) { ?>
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
                        <div class="form-6 mb-3">
                            <label for="priority" class="model_label">Priority</label>
                            <select name="priority" class="form-control modal_input" data-trigger id="priority">
                                <?if ($pipeline_view[0]->priority) { ?>
                                    <option value="<?= $pipeline_view[0]->priority ?>">
                                        <?php if ($pipeline_view[0]->priority == 4) {
                                            echo 'Current: Urgent';
                                        } elseif ($pipeline_view[0]->priority == 3) {
                                            echo 'Current: High';
                                        } elseif ($pipeline_view[0]->priority == 2) {
                                            echo 'Current: Medium';
                                        } elseif ($pipeline_view[0]->priority == 1) {
                                            echo 'Current: Low';
                                        } else {
                                            echo 'Current: None';
                                        } ?>
                                    </option>
                                <?php } ?>
                                <option value="0">None</option>
                                <option value="1">Low</option>
                                <option value="2">Medium</option>
                                <option value="3">High</option>
                                <option value="4">Urgent</option>
                            </select>
                        </div>
                        <div class="form-6 lastchild mb-3">
                            <label for="percentage" class="modal_label mb-2">Probability (%) *</label>
                            <input name="percentage" max="100" min="0" step="5" value="<?= $pipeline_view[0]->percentage ?>" type="number" class="modal_input" id="percentage" placeholder="50" required>
                        </div>
                    </div>

                    <div class="form-12 lastchild mb-3">
                        <label for="total_quote" class="modal_label mb-2">Total Quote *</label>
                        <input name="total_quote" min="0" step="0.01" type="number" class="modal_input" id="total_quote" value="<?= $pipeline_view[0]->total_quote ?>" placeholder="£1,000,000,00" required>
                    </div>

                    <div class="form-12 lastchild">
                        <label for="close_date" class="modal_label">Close Date *</label>
                        <input name="close_date" type="date" class="modal_input" id="close_date" value="<?= $pipeline_view[0]->close_date ?>" required>
                    </div>

                    <button type="submit" name="pipeline_edit" class="btn btn-primary waves-effect waves-light">Update Deal</button>
                </form>
            </div>
        </div>
    </div>
</div>