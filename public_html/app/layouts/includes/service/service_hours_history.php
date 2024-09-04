<div id="service_hours_history" class="card tab-pane <?php if ($_GET['tab'] == 'service_hours_history') { echo 'active'; } ?>" role="tabpanel">
    <div id="service_hours_history" class="card tab-pane <?php if ($_GET['tab'] == 'service_hours_history') { echo 'active'; } ?>" role="tabpanel">
        <div class="row align-items-center table-header-block section-block mb-4">
            <div class="col-md-6">
                <div>
                    <h5 class="card-title">ODO History</h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="button-group-mobile d-flex flex-wrap align-items-center justify-content-end gap-2">
                    <?php form_clear_storage(); ?>
                </div>
            </div>
        </div>
        <?php
        service_team_table_hours(false);
        service_table_hours($service_team_table_hours);
        ?>
    </div>
</div>