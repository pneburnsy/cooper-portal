<?php if (doif_coopereditoronly_query()) { ?>
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#contacts_add" aria-controls="offcanvasRight">Add New Contact +</button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="contacts_add" aria-labelledby="offcanvasRightLabel">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Add New Contact</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="add_accounts" method="post">
                <div class="modal-top">

                    <div class="form-6 mb-2">
                        <label for="contacts_first_name" class="modal_label">First Name *</label>
                        <input name="contacts_first_name" type="text" class="modal_input" id="contacts_first_name" placeholder="Natasha" autocomplete="off" required>
                    </div>

                    <div class="form-6 lastchild mb-2">
                        <label for="contacts_last_name" class="modal_label">Last Name *</label>
                        <input name="contacts_last_name" type="text" class="modal_input" id="contacts_last_name" placeholder="Barnes" autocomplete="off" required>
                    </div>

                    <div class="form-12 mb-2">
                        <label for="contacts_title" class="modal_label">Title</label>
                        <input name="contacts_title" type="text" class="modal_input" id="contacts_title" placeholder="Director" autocomplete="off">
                    </div>

                    <div class="form-12 mb-2">
                        <label for="contacts_email" class="modal_label">Email *</label>
                        <input name="contacts_email" type="email" class="modal_input" id="contacts_email" placeholder="natasha@cooperhandling.com" autocomplete="off" required>
                    </div>

                    <div class="form-6 mb-2">
                        <label for="contacts_office_phone" class="modal_label">Office Phone</label>
                        <input name="contacts_office_phone" type="number" class="modal_input" id="contacts_office_phone">
                    </div>

                    <div class="form-6 lastchild mb-2">
                        <label for="contacts_mobile_phone" class="modal_label">Mobile Phone</label>
                        <input name="contacts_mobile_phone" type="number" class="modal_input" id="contacts_mobile_phone">
                    </div>

                    <div class="modal-card">
                        <div class="modal-card-header">
                            <h6>Contact Address</h6>
                        </div>
                        <div class="form-12 mb-2">
                            <label for="address_street" class="modal_label">Street</label>
                            <input name="address_street" type="text" class="modal_input" maxlength="160" id="address_street">
                        </div>

                        <div class="form-6 mb-2">
                            <label for="address_city" class="modal_label">City</label>
                            <input name="address_city" type="text" class="modal_input" maxlength="160" id="address_city">
                        </div>

                        <div class="form-6 lastchild mb-2">
                            <label for="address_postcode" class="modal_label">Postcode</label>
                            <input name="address_postcode" type="text" class="modal_input" maxlength="20" id="address_postcode">
                        </div>
                    </div>

                    <div class="modal-card">
                        <div class="modal-card-header">
                            <h6>Contact Account</h6>
                        </div>
                        <div class="form-12">
                            <select name="contacts_account" class="form-control modal_input" data-trigger id="contacts_account">
                                <option value="" selected>Select Account...</option>
                                <?php for ($i = 0; $i < count($accounts_team_distinct); $i++) {
                                    ?><option value="<?= $accounts_team_distinct[$i]->displayid; ?>"><?= $accounts_team_distinct[$i]->accountname; ?></option><?php
                                } ?>
                            </select>
                        </div>
                    </div>

                    <div class="modal-card">
                        <div class="modal-card-header">
                            <h6>Contact Responsibility</h6>
                            <div class="form-12">
                                <select name="contacts_region" class="form-control modal_input" data-trigger id="contacts_region">
                                    <?php include'dropdowns/regions.php'; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-card">
                        <div class="modal-card-header">
                            <h6>Portal Access</h6>
                        </div>
                        <p>If you want to give this contact access to the portal, please select a user role and password. This can be changed at a later date.</p>
                        <div class="form-12 mb-3">
                            <label class="modal_label">User Role</label>
                            <select name="contacts_role" class="form-control modal_input" data-trigger id="contacts_role">
                                <option value="0" selected>Users Role...</option>
                                <?php include'dropdowns/user_roles.php'; ?>
                            </select>
                            <label for="contacts_password" class="modal_label">Password</label>
                            <input name="contacts_password" type="password" class="modal_input" id="contacts_password" placeholder="**************" min="10" autocomplete="off">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="offcanvas">Cancel</button>
                    <button type="submit" name="contacts_add" class="btn btn-primary waves-effect waves-light">Add Contact</button>
                </div>
            </form>
        </div>
    </div>
<?php } ?>