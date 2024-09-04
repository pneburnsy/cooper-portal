<div id="service_schedule" class="card tab-pane <?php if ($_GET['tab'] == 'service_schedule') { echo 'active'; } ?>" role="tabpanel">
    <div class="card-body p-0" style="background:#fff;border-radius:10px;padding:0;">
        <div class="row bs-0">
            <div class="col-md-6 p-0">
                <div class="form-highlight">
                    <h4>Schedule Service</h4>
                    <p class="mb-4">Use this to track when equipment has a service date booked in. <strong>Please Note: once serviced, you should mark this equipment as serviced manually via the 'Complete Service' tab.</strong></p>
                    <form class="add_accounts" method="post">

                        <div class="form-12 mb-4">
                            <label for="schedule_date" class="modal_label">Service Scheduled For *</label>
                            <input name="schedule_date" type="date" class="modal_input" <?php if ($service_view[0]->schedule_date) { ?> value="<?= date('Y-m-d', strtotime($service_view[0]->schedule_date)); ?>" <?php } ?> id="schedule_date" <?php if ($service_view[0]->schedule_date != '0000-00-00') { ?> data-bs-toggle="tooltip" data-bs-placement="top" title="Clear the scheduled service first before entering a new date." disabled <?php } ?>>
                        </div>

                        <?php if ($service_view[0]->schedule_date == '0000-00-00') { ?>
                            <button type="submit" name="service_schedule" class="btn btn-primary waves-effect waves-light">Schedule Service</button>
                        <?php } else { ?>
                            <button type="submit" name="service_schedule_delete" value="<?php if ($service_view[0]->schedule_date != '0000-00-00') { echo $service_view[0]->schedule_date; } ?>" class="btn btn-danger waves-effect waves-light">Clear Scheduled Service</button>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>