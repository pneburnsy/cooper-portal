<div id="service_status" class="card tab-pane <?php if ($_GET['tab'] == 'service_status') { echo 'active'; } ?>" role="tabpanel">
    <div class="card-body p-0" style="background:#fff;border-radius:10px;padding:0;">
        <div class="row bs-0">
            <div class="col-md-6 p-0">
                <div class="form-highlight">
                    <h4>Service Settings</h4>
                    <p class="mb-4">Edit the current service due date and/or hours. <strong>Use this to update the current service settings only. If you have completed a service, please go to the 'Complete Service' tab.</strong></p>
                    <form class="add_accounts" method="post">

                        <div class="form-12 mb-2">
                            <label for="serviceduein" class="modal_label">Service Due In (Hrs) *</label>
                            <select name="serviceduein" class="form-control modal_input" data-trigger id="serviceduein">
                                <?php if ($service_view[0]->serviceduein) { ?>
                                    <option value="<?= $service_view[0]->serviceduein ?>">Current: <?= $service_view[0]->serviceduein ?></option>
                                <?php } ?>
                                <?php include 'dropdowns/service_hours.php'; ?>
                            </select>
                        </div>
                        <div class="form-12 mb-4">
                            <label for="due_odo_date" class="modal_label">Service Due By *</label>
                            <input name="due_odo_date" type="date" class="modal_input" value="<?= date('Y-m-d', strtotime($service_view[0]->due_odo_date)); ?>" id="due_odo_date" required>
                        </div>

                        <button type="submit" name="service_settings_edit" class="btn btn-primary waves-effect waves-light">Update Service Details</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>