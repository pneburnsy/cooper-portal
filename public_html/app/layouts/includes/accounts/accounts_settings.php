<div id="accounts_settings" class="card tab-pane <?php if ($_GET['tab'] == 'accounts_settings') { echo 'active'; } ?>" role="tabpanel">
    <div class="card-body p-0" style="background:#fff;border-radius:10px;padding:0;">
        <div class="row bs-0">
            <div class="col-md-6 p-0">
                <div class="form-highlight">
                    <h4>Account Settings</h4>
                    <p class="mb-4">You can update your account settings below.</p>
                    <form class="edit_accounts" method="post">
                        <div class="modal-top">

                            <label for="accountname" class="modal_label">Account Name *</label>
                            <input name="accountname" type="text" class="modal_input" id="accountname" placeholder="Account name..." value="<?= $accounts_team_view[0]->accountname; ?>" required>

                            <div class="form-6">
                                <label for="accountphone" class="modal_label">Primary Phone</label>
                                <input name="accountphone" type="number" class="modal_input" id="accountphone" placeholder="Primary phone..." <?php if ($accounts_team_view[0]->accountphone) { ?> value="<?= $accounts_team_view[0]->accountphone; ?>" <?php } ?>>
                            </div>

                            <div class="form-6 lastchild">
                                <label for="accountemail" class="modal_label">Primary Email</label>
                                <input name="accountemail" type="email" class="modal_input" id="accountemail" placeholder="Primary email..." value="<?= $accounts_team_view[0]->accountemail; ?>">
                            </div>

                            <label for="accountwebsite" class="modal_label mt-2">Website</label>
                            <input name="accountwebsite" type="text" class="modal_input last-list" id="accountwebsite" placeholder="cooperhandling.co.uk" value="<?= $accounts_team_view[0]->accountwebsite; ?>">

                            <div class="modal-card">
                                <div class="modal-card-header">
                                    <h6>Fleet Manager Contact</h6>
                                </div>
                                <div class="form-12 mb-3">
                                    <?php
                                    get_users_for_account($accounts_team_view[0]->displayid);
                                    global $current_account_users;
                                    ?>
                                    <label for="accountfleetmanager" class="modal_label">Select a fleet manager to grant access to the ODO Submissions area.</label>
                                    <select name="accountfleetmanager" class="form-control modal_input" data-trigger id="accountfleetmanager">
                                        <?php if ($accounts_team_view[0]->fleetmanager) { ?>
                                            <?= other_user_email(other_convert_displayid($accounts_team_single[0]->fleetmanager)); ?>
                                            <option value="<?= $accounts_team_view[0]->fleetmanager; ?>" selected>Current: <?= other_user_fullname(other_convert_displayid($accounts_team_view[0]->fleetmanager)) ?> (<?= other_user_email(other_convert_displayid($accounts_team_view[0]->fleetmanager)); ?>)</option>
                                        <?php } else { ?>
                                            <option value="" selected>Select User...</option>
                                        <?php } ?>
                                        <?php for ($i = 0; $i < count($current_account_users); $i++) {
                                            ?><option value="<?= other_user_displayid($current_account_users[$i]->ID); ?>"><?= $current_account_users[$i]->display_name; ?> (<?= $current_account_users[$i]->user_email; ?>)</option><?php
                                        } ?>
                                    </select>
                                    <p class="tiny-text"><strong>Can't see any users?</strong> To assign a fleet manager, you must create a user and add it to this account.</p>
                                </div>
                            </div>

                            <div class="modal-card">
                                <div class="modal-card-header">
                                    <h6>Additional Fleet Contact(s)</h6>
                                </div>
                                <div class="form-12 mb-3">
                                    <label for="accountfleetmanageradmin" class="modal_label mt-2">Input other email(s) to grant access to the ODO Submissions area (Separate with Commas).</label>
                                    <small class="mb-3 d-block"><strong>Please Note:</strong> Only emails of users who are associated with account can be added here.</small>
                                    <input name="accountfleetmanageradmin"  type="email" multiple class="modal_input last-list" id="accountfleetmanageradmin" placeholder="natasha@cooperhandling.co.uk, chris@cooperhandling.co.uk" value="<?= $accounts_team_view[0]->fleetmanageradmin; ?>">
                                </div>
                            </div>

                        </div>
                        <button type="submit" name="accounts_team_edit" class="btn btn-primary waves-effect waves-light">Update Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>