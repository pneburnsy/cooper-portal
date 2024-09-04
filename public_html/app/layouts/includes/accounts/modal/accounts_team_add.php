<?php if (doif_coopereditoronly_query()) { ?>
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#accounts_team_add" aria-controls="offcanvasRight">Add New Account +</button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="accounts_team_add" aria-labelledby="offcanvasRightLabel">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Add New Account</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="add_accounts" method="post">
                <div class="modal-top">

                    <label for="accountname" class="modal_label">Account Name *</label>
                    <input name="accountname" type="text" class="modal_input" id="accountname" placeholder="Account name..." required>

                    <div class="form-6">
                        <label for="accountphone" class="modal_label">Primary Phone</label>
                        <input name="accountphone" type="number" class="modal_input" id="accountphone" placeholder="Primary phone...">
                    </div>

                    <div class="form-6 lastchild">
                        <label for="accountemail" class="modal_label">Primary Email</label>
                        <input name="accountemail" type="email" class="modal_input" id="accountemail" placeholder="Primary email...">
                    </div>

                    <label for="accountwebsite" class="modal_label mt-2">Website</label>
                    <input name="accountwebsite" type="text" class="modal_input last-list" id="accountwebsite" placeholder="cooperhandling.co.uk">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="offcanvas">Cancel</button>
                    <button type="submit" name="accounts_team_add" class="btn btn-primary waves-effect waves-light">Add Account</button>
                </div>
            </form>
        </div>
    </div>
<?php } ?>