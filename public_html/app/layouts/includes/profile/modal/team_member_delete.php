<div class="offcanvas offcanvas-end modal-content delete" tabindex="-1" id="profileTeamDelete_<?php echo $x; ?>" aria-labelledby="offcanvasRightLabel">
    <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Delete Team Member</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form class="delete_accounts" method="post">
            <div class="modal-top">
                <i class="mdi mdi-alert-outline d-block display-4 mt-2 mb-3 text-warning"></i>
                <h3 class="text-center">Confirmation Needed.</h3>
                <p class="text-center">Anything created by <?php echo $current_team_member[$x]->display_name . ' (' . $current_team_member[$x]->user_email . ')'; ?> will remain but their logins will be removed. <strong>This cannot be undone, be absolutely sure you want to do this.</strong> <br><br> If this is temporary, why not disable the account instead? </p>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="offcanvas">Cancel</button>
                <input type="hidden" name="redirect" class="modal_input" value="teammembers">
                <button type="submit" name="team_delete" value="<?php echo $current_team_member[$x]->displayid; ?>" class="btn btn-danger waves-effect waves-light" type="submit">
                    Yes, I'm Absolutely Sure!
                </button>
            </div>
        </form>
    </div>
</div>