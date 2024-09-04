<div id="service" class="card tab-pane <?php if ($_GET['tab'] == 'account_service') { echo 'active'; } ?>" role="tabpanel">
    <div id="accounts_service" class="card tab-pane <?php if ($_GET['tab'] == 'accounts_service') { echo 'active'; } ?>" role="tabpanel">
        <div class="row align-items-center table-header-block section-block mb-4">
            <div class="col-md-6">
                <div>
                    <h5 class="card-title">Service Contracts</h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="button-group-mobile d-flex flex-wrap align-items-center justify-content-end gap-2">
                    <?php form_clear_storage(); ?>
                </div>
            </div>
        </div>
        <?php
        accounts_team_service_contracts(false);
        service_table($accounts_team_service_contracts);
        ?>
    </div>
</div>
