<button class="btn btn-danger" type="button" data-bs-toggle="offcanvas" data-bs-target="#accounts_team_delete" aria-controls="offcanvasRight"><i class="mdi mdi-trash-can d-block font-size-14 mr-1"></i></button>
<div class="offcanvas offcanvas-end modal-content delete" tabindex="-1" id="accounts_team_delete" aria-labelledby="offcanvasRightLabel">
    <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Delete Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form class="delete_accounts" method="post">
            <div class="modal-top">
                <i class="mdi mdi-alert-outline d-block display-4 mt-2 mb-3 text-warning"></i>
                <h3 class="text-center">Confirmation Needed.</h3>
                <p class="text-center">Deleting this account will remove the account but it will not delete any items assigned to it, for example 'Surveys'. <strong>This cannot be undone, be absolutely sure you want to do this.</strong></p>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="offcanvas">Cancel</button>
                <button type="submit" name="accounts_team_delete" class="btn btn-danger waves-effect waves-light">Yes, I'm Absolutely Sure!</button>
            </div>
        </form>
    </div>
</div>