<div id="exam" class="card tab-pane <?php if ($_GET['tab'] == 'account_exam') { echo 'active'; } ?>" role="tabpanel">
    <div id="accounts_exam" class="card tab-pane <?php if ($_GET['tab'] == 'accounts_exam') { echo 'active'; } ?>" role="tabpanel">
        <div class="row align-items-center table-header-block section-block mb-4">
            <div class="col-md-6">
                <div>
                    <h5 class="card-title">Account Thorough Examinations</h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="button-group-mobile d-flex flex-wrap align-items-center justify-content-end gap-2">
                    <?php form_clear_storage(); ?>
                </div>
            </div>
        </div>
        <?php
        accounts_team_exam(false);
        thorough_examinations_table($accounts_team_exam);
        ?>
    </div>
</div>