<div>
    <div id="profilePasswordReset_<?php echo $x; ?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="password_reset" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Login Recovery</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>Password Reset</h5>
                        <p>You are updating the password for <?php echo $current_team_member[$x]->display_name . ' (' . $current_team_member[$x]->user_email . ')'; ?>.</p>
                        <div class="form-title">
                            <label class="modal_label">Enter New Password *</label>
                            <input type="password" name="team_newpassword" class="modal_input" placeholder="New Password *" required>
                        </div>
                        <div class="form-title">
                            <label class="modal_label">Email New Password</label>
                            <p class="account-note mb-0">Should we email this new password to <?php echo $current_team_member[$x]->display_name . ' (' . $current_team_member[$x]->user_email . ')?'; ?> <strong>Please note:</strong> This password will be sent in plain text.</p>
                            <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                <input type="checkbox" name="team_emailcheck" class="form-check-input" id="customSwitchsizelg" value="checked" checked>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancel</button>
                        <input type="hidden" name="redirect" class="modal_input" value="teamsettings">
                        <button type="submit" name="team_passwordreset" value="<?php echo $current_team_member[$x]->displayid ?>" class="btn btn-primary waves-effect waves-light">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
