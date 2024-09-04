<div id="yourprofile" class="card tab-pane <?php if (!$_GET['tab']) { echo 'active'; } ?>" role="tabpanel">
    <div class="card-body p-0" style="background:#fff;border-radius:10px;padding:0;">
        <div class="row bs-0">
            <div class="col-md-12 p-0">
                <div class="form-highlight">
                    <h4>Your Profile</h4>
                    <p class="mb-4">Manage your account settings here.</p>
                    <form class="update_accounts" method="post">
                        <div class="form-block">
                            <h5 class="modal_label mb-4">Account Details</h5>
                            <div class="form-6">
                                <label class="modal_label">First Name *</label>
                                <input type="text" name="team_firstname" class="modal_input" placeholder="Your First Name... *" value="<?= current_user_firstname(); ?>" autocomplete="false" required>
                            </div>
                            <div class="form-6 lastchild">
                                <label class="modal_label">Last Name *</label>
                                <input type="text" name="team_lastname" class="modal_input" placeholder="Your Last Name... *" value="<?= current_user_lastname(); ?>" autocomplete="false" required>
                            </div>
                        </div>
                        <div class="form-block">
                            <h5 class="modal_label mb-4">Reset Password</h5>
                            <label class="modal_label">Current Password</label>
                            <input type="password" name="team_current_password" class="modal_input" placeholder="Current Password..." autocomplete="false">
                            <div class="form-6">
                                <label class="modal_label">New Password</label>
                                <input type="password" name="team_new_password" class="modal_input" placeholder="New Password..." autocomplete="false">
                            </div>
                            <div class="form-6 lastchild">
                                <label class="modal_label">Confirm New Password</label>
                                <input type="password" name="team_new_password_confirm" class="modal_input" placeholder="Confirm New Password..." autocomplete="false">
                            </div>
                        </div>
                        <button type="submit" name="team_profileupdate" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>