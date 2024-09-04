<div id="contacts_settings" class="card tab-pane <?php if ($_GET['tab'] == 'contacts_settings') { echo 'active'; } ?>" role="tabpanel">
    <div class="card-body p-0" style="background:#fff;border-radius:10px;padding:0;">
        <div class="row bs-0">
            <div class="col-md-6 p-0">
                <div class="form-highlight">
                    <h4>Contact Settings</h4>
                    <p class="mb-4">You can update this contacts settings below.</p>
                    <form class="edit_accounts" method="post">
                        <div class="modal-top">

                            <div class="form-6 mb-2">
                                <label for="contacts_first_name" class="modal_label">First Name *</label>
                                <input name="contacts_first_name" value="<?= $contacts_view['user_meta']['first_name'][0] ?>" type="text" class="modal_input" id="contacts_first_name" placeholder="Natasha" autocomplete="off" required>
                            </div>

                            <div class="form-6 lastchild mb-2">
                                <label for="contacts_last_name" class="modal_label">Last Name *</label>
                                <input name="contacts_last_name" value="<?= $contacts_view['user_meta']['last_name'][0] ?>" type="text" class="modal_input" id="contacts_last_name" placeholder="Barnes" autocomplete="off" required>
                            </div>

                            <div class="form-12 mb-2">
                                <label for="contacts_title" class="modal_label">Title</label>
                                <input name="contacts_title" value="<?= $contacts_view['user_meta']['title'][0] ?>" type="text" class="modal_input" id="contacts_title" placeholder="Director" autocomplete="off">
                            </div>

                            <div class="form-6 mb-2">
                                <label for="contacts_office_phone" class="modal_label">Office Phone</label>
                                <input name="contacts_office_phone" value="<?= $contacts_view['user_meta']['office_phone'][0] ?>" type="number" class="modal_input" id="contacts_office_phone">
                            </div>

                            <div class="form-6 lastchild mb-2">
                                <label for="contacts_mobile_phone" class="modal_label">Mobile Phone</label>
                                <input name="contacts_mobile_phone" value="<?= $contacts_view['user_meta']['mobile_phone'][0] ?>" type="number" class="modal_input" id="contacts_mobile_phone">
                            </div>

                            <div class="modal-card">
                                <div class="modal-card-header">
                                    <h6>Contact Address</h6>
                                </div>
                                <div class="form-12 mt-4">
                                    <div class="form-12 mb-2">
                                        <label for="address_street" class="modal_label">Street Name</label>
                                        <input name="address_street" value="<?= $contacts_view['user_meta']['address_street'][0] ?>" type="text" maxlength="160" class="modal_input" id="address_street">
                                    </div>

                                    <div class="form-6 mb-2">
                                        <label for="address_city" class="modal_label">City</label>
                                        <input name="address_city" value="<?= $contacts_view['user_meta']['address_city'][0] ?>" type="text" maxlength="160" class="modal_input" id="address_city">
                                    </div>

                                    <div class="form-6 lastchild mb-2">
                                        <label for="address_postcode" class="modal_label">Postcode</label>
                                        <input name="address_postcode" value="<?= $contacts_view['user_meta']['address_postcode'][0] ?>" type="text" maxlength="20" class="modal_input" id="address_postcode">
                                    </div>
                                </div>
                            </div>


                            <div class="modal-card">
                                <div class="modal-card-header">
                                    <h6>Contact Account</h6>
                                </div>
                                <div class="form-12 mt-4">
                                    <select name="contacts_account" class="form-control modal_input" data-trigger id="contacts_account">
                                        <?php if ($contacts_view['user_meta']['account'][0]) { ?>
                                            <option value="<?= $accounts_team_single[0]->displayid; ?>" selected>Current: <?= $accounts_team_single[0]->accountname; ?></option>
                                        <?php } else { ?>
                                            <option value="" selected>Select Account...</option>
                                        <?php } ?>
                                        <?php for ($i = 0; $i < count($accounts_team_distinct); $i++) {
                                            ?><option value="<?= $accounts_team_distinct[$i]->displayid; ?>"><?= $accounts_team_distinct[$i]->accountname; ?></option><?php
                                        } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-card">
                                <div class="modal-card-header">
                                    <h6>Contact Region</h6>
                                </div>
                                <div class="form-12 mt-4">
                                    <select name="contacts_region" class="form-control modal_input" data-trigger id="contacts_region">
                                        <?php if ($contacts_view['user_meta']['region'][0] !== '') { ?>
                                            <option value="<?= $contacts_view['user_meta']['region'][0] ?>">
                                                Current: <?php
                                                switch($contacts_view['user_meta']['region'][0]) {
                                                    case '0':
                                                        echo 'Mainland UK';
                                                        break;
                                                    case '1':
                                                        echo "Ireland";
                                                        break;
                                                    default:
                                                        echo "Unknown Region"; }
                                                ?></option>
                                        <?php } ?>
                                        <?php include 'dropdowns/regions.php'; ?>
                                    </select>
                                </div>
                            </div>

                            <?php if (current_user_can('administrator') && other_convert_displayid($contacts_view['user_meta']['displayid'][0]) != get_current_user_id()) { ?>
                                <div class="modal-card">
                                    <div class="modal-card-header">
                                        <h6>Portal Access</h6>
                                    </div>
                                    <div class="form-12 mb-3">

                                        <div class="d-inline-block mt-2" style="margin-right: 12px;">
                                            <strong>Current Status: </strong>
                                            <?php if ( $contacts_view['user_meta']['user_active'][0] == 1) { ?>
                                                <span class="notdue">
                                                <span class="renewal">Active</span>
                                            </span>
                                            <?php } else { ?>
                                                <span class="overdue">
                                                <span class="renewal">Not Active</span>
                                            </span>
                                            <?php } ?>
                                        </div>
                                        <?php if ( $contacts_view['user_meta']['user_active'][0] == 0 ) { ?>
                                            <div class="mt-2">
                                                <p>To make this user active, please set the current status to active, select a user role and enter a password below.</p>
                                            </div>
                                        <?php } ?>

                                        <label class="modal_label">User Status</label>
                                        <select name="contacts_status" class="form-control modal_input" data-trigger id="contacts_status">
                                            <?php if ($contacts_view['user_meta']['user_active'][0] == 0) {
                                                echo '<option value="' . $contacts_view['user_meta']['user_active'][0] . '">Currently: Not Active</option>';
                                            } else {
                                                echo '<option value="' . $contacts_view['user_meta']['user_active'][0] . '">Currently: Active</option>';
                                            } ?>
                                            <?php include 'dropdowns/user_status.php'; ?>
                                        </select>

                                        <?php
                                        $current_roles_serialized = $contacts_view['user_meta']['ae_capabilities'][0];
                                        $current_roles = unserialize($current_roles_serialized);
                                        $current_role = key($current_roles);

                                        $role_hierarchy = array(
                                            'administrator' => 4,
                                            'employee_editor' => 3,
                                            'employee' => 2,
                                            'customer' => 1,
                                        );

                                        $most_senior_role = 'customer'; // Default role
                                        foreach ($current_roles as $role => $enabled) {
                                            if ($enabled && $role_hierarchy[$role] > $role_hierarchy[$most_senior_role]) {
                                                $most_senior_role = $role;
                                            }
                                        }
                                        ?>

                                        <?php if (!is_email_super_admin($contacts_view['user_meta']['displayid'][0])) { ?>
                                            <label class="modal_label">User Role</label>
                                            <select name="contacts_role" class="form-control modal_input" data-trigger id="contacts_role">
                                                <option value="<?= esc_attr($most_senior_role); ?>">
                                                    Current: <?php
                                                    switch($most_senior_role) {
                                                        case 'administrator':
                                                            echo "Admin";
                                                            break;
                                                        case 'employee_editor':
                                                            echo "Staff Editor";
                                                            break;
                                                        case 'employee':
                                                            echo 'Staff Member';
                                                            break;
                                                        case 'customer':
                                                            echo 'Customer';
                                                            break;
                                                        default:
                                                            echo "Unknown Role";
                                                    } ?>
                                                </option>
                                                <?php include 'dropdowns/user_roles.php'; ?>
                                            </select>
                                        <?php } else { ?>
                                            <input type="text" style="display:none !important;" value="administrator" name="contacts_role">
                                        <?php } ?>

                                        <div class="form-6 mb-2">
                                            <label for="contacts_email" class="modal_label">Email (Username) *</label>
                                            <input name="contacts_email" value="<?= $contacts_view['user_email'] ?>" type="email" class="modal_input" id="contacts_email" placeholder="natasha@cooperhandling.com" autocomplete="off" required>
                                        </div>

                                        <div class="form-6 lastchild mb-2">
                                            <label class="modal_label">Set Password (Minimum 8 Characters)</label>
                                            <input name="contacts_p" type="password" class="modal_input" id="contacts_p" placeholder="**************" min="8" autocomplete="new-password">
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                        <button type="submit" name="contacts_edit" value="<?= $contacts_view['user_meta']['displayid'][0] ?>" class="btn btn-primary waves-effect waves-light">Update Contact</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>