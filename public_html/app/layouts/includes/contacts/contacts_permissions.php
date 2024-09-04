<div id="contacts_permissions" class="card tab-pane <?php if ($_GET['tab'] == 'contacts_permissions') { echo 'active'; } ?>" role="tabpanel">
    <div class="card-body p-0 mb-4" style="background:#fff;border-radius:10px;padding:0;">
        <div class="row bs-0">
            <div class="col-md-6 p-0">
                <div class="form-highlight">
                    <h4 class="mb-4">Region Visibility</h4>
                    <p>When accessing records across the portal what regions should this user have access to? If no regions are selected, it will default to the region the user is allocated to under 'Contacts Settings'.</p>
                    <form class="edit_accounts" method="post">
                        <div class="d-block">
                            <div class="table-responsive table_permissions">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="text-dark"></th>
                                        <th class="text-dark">Mainland (UK)</th>
                                        <th class="text-dark">Ireland</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <?php $region_data = isset($permissions_regions_all[0]) ? $permissions_regions_all[0] : null; ?>
                                        <td class="text-dark fw-bold">Region</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="region_mainland" id="region_mainland"
                                                    <?php if (isset($region_data) && $region_data->mainland == 1) echo 'checked'; ?>>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="region_ireland" id="region_ireland"
                                                    <?php if (isset($region_data) && $region_data->ireland == 1) echo 'checked'; ?>>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button type="submit" name="permission_regions_edit" class=" mt-4 btn btn-primary waves-effect waves-light">Update Region Permissions</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php if (other_convert_displayid($contacts_view['user_meta']['displayid'][0]) != get_current_user_id() && !is_email_super_admin($contacts_view['user_meta']['displayid'][0]) ) { ?>
        <div class="card-body p-0 mb-4" style="background:#fff;border-radius:10px;padding:0;">
            <div class="row bs-0">
                <div class="col-md-6 p-0">
                    <div class="form-highlight">
                        <h4 class="mb-4">Section Visibility</h4>
                        <p>Control which areas of the portal this user has access to. Whatever options you select here superseed the user role standard setups. Please note, this only effects read capabilities, all edit & delete capabilities default to this users user role.</p>
                        <form class="edit_accounts" method="post">
                            <div class="d-block">
                                <div class="table-responsive table_permissions">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="text-dark"></th>
                                                <th class="text-dark">User Role (Default)</th>
                                                <th class="text-dark">Access Granted</th>
                                                <th class="text-dark">Access Blocked</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $permission_types = [
                                                'contacts' => 'Contacts',
                                                'contacts_travel' => 'Contacts Map',
                                                'accounts' => 'Accounts',
                                                'surveys' => 'Surveys',
                                                'maintenance' => 'Maintenance',
                                                'rental' => 'Rental',
                                                'examinations' => 'Thorough Examinations',
                                                'service' => 'Service Planner',
                                            ];
                                            foreach ($permission_types as $type => $label) {
                                                $value = 'default';
                                                foreach ($permissions_all as $permission) {
                                                    if ($permission->type === $type) {
                                                        $value = $permission->value;
                                                        break;
                                                    }
                                                }
                                                ?>
                                                <tr>
                                                    <td class="text-dark fw-bold"><?php echo $label; ?></td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="permission_<?php echo $type; ?>" value="default" id="permission_<?php echo $type; ?>_default" <?php echo ($value == 'default') ? 'checked' : ''; ?>>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="permission_<?php echo $type; ?>" value="granted" id="permission_<?php echo $type; ?>_granted" <?php echo ($value == 'granted') ? 'checked' : ''; ?>>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="permission_<?php echo $type; ?>" value="blocked" id="permission_<?php echo $type; ?>_blocked" <?php echo ($value == 'blocked') ? 'checked' : ''; ?>>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <button type="submit" name="permission_edit" class="mt-4 btn btn-primary waves-effect waves-light">Update Section Permissions</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>