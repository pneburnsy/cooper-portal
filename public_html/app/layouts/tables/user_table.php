<?php
function user_table($variable, $all = false) { ?>
    <div class="table-responsive section-block surveys">
        <table id="datatable-buttons-contacts" class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
            <thead>
                <tr>
                    <th scope="col">Portal Login</th>
                    <th scope="col">Region</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Title</th>
                    <?php if ($all) { ?><th scope="col">Account</th><?php } ?>
                    <th scope="col">Email</th>
                    <th scope="col">Office</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Address</th>
                    <th scope="col">Portal Activity</th>
                    <th scope="col">Portal User Role</th>
                    <?php if ( current_user_can( 'administrator' ) ) { ?>
                        <th scope="col">Region Permissions</th>
                        <th scope="col">Sector Permissions</th>
                    <?php } ?>
                    <th scope="col">Contact Created</th>
                    <?php if ( current_user_can( 'administrator' ) ) { ?>
                        <th class="hide-sorting form_actions">Actions</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($variable); $i++) { ?>

                <tr class="<?= $variable[$i]->id;  ?>">

                    <?php if ( $variable[$i]->user_active == 1 ) { ?>
                        <td class="contacts_status">
                            <span class="notdue">
                                <span class="renewal">Active</span>
                            </span>
                        </td>
                    <?php } else { ?>
                        <td class="contacts_status">
                            <span class="overdue">
                                <span class="renewal">Not Active</span>
                            </span>
                        </td>
                    <?php } ?>

                    <td class="form_name" data-sort="<?= $variable[$i]->region; ?>">
                        <?= get_region_flag($variable[$i]->region); ?>
                    </td>

                    <td>
                        <a href="/app/page_view_users_view.php?displayid=<?= $variable[$i]->displayid ?>">
                            <span><?= $variable[$i]->display_name;  ?></span>
                        </a>
                    </td>

                    <td>
                        <?php

                        if ($variable[$i]->title) {
                            echo $variable[$i]->title;
                        } else {
                            echo '-';
                        }

                        ?>
                    </td>

                    <?php if ($all) { ?>
                        <?php
                        global $accounts_team_single;
                        accounts_team_single( $variable[$i]->account, false);
                        ?>
                        <td class="form_name">
                            <?php if ($variable[$i]->account) { ?>
                                <a class="account_icon_full" style="background-color:rgba(<?= $accounts_team_single[0]->accountarray; ?>, 0.3)"
                                   href="page_accounts_view.php?displayid=<?= $accounts_team_single[0]->displayid; ?>">
                                    <?= $accounts_team_single[0]->accountname; ?>
                                </a>
                            <?php } else { ?>
                                <span>-</span>
                            <?php } ?>
                        </td>
                    <?php } ?>

                    <td>
                        <a href="mailto:<?= $variable[$i]->user_email; ?>"><?= $variable[$i]->user_email; ?></a>
                    </td>

                    <td>
                        <a href="tel:<?= $variable[$i]->office_phone; ?>"><?php if ( $variable[$i]->office_phone ) { echo $variable[$i]->office_phone; } else { echo '<span>-</span>'; } ?></a>
                    </td>

                    <td>
                        <a href="tel:<?= $variable[$i]->mobile_phone; ?>"><?php if ( $variable[$i]->mobile_phone ) { echo $variable[$i]->mobile_phone; } else { echo '<span>-</span>'; } ?></a>
                    </td>

                    <td>
                        <?
                        $street = $variable[$i]->address_street ?? '';
                        $city = $variable[$i]->address_city ?? '';
                        $postcode = $variable[$i]->address_postcode ?? '';

                        $address_parts = array_filter([$street, $city, $postcode]);
                        $full_address = implode(', ', $address_parts);
                        if (!empty($full_address)) {
                            $maps_url = "https://www.google.com/maps/search/$street,+$city,+$postcode/";
                            echo "<a href='{$maps_url}' target='_blank'>{$full_address}</a>";
                        } else {
                            echo '<span>-</span>';
                        }
                        ?>
                    </td>

                    <?php $current_status = online_status_true($variable[$i]->ID); ?>

                    <?php if ( $variable[$i]->user_active == 1 ) { ?>
                        <td class="archived_date online-column" class="table-image">
                            <div class="user-list" data-bs-toggle="tooltip" data-bs-placement="top" title="Currently: <?= $current_status[1] ?>"><?= online_status_date($variable[$i]->ID); ?></div>
                            <span class="online_status <?php if ( $current_status[0] == 2 ) { echo 'online'; } elseif ( $current_status[0] == 1 ) { echo 'away'; } else { echo 'offline'; } ?>"></span>
                        </td>
                    <?php } else { ?>
                        <td class="archived_date online-column" class="table-image">
                            <span>-</span>
                        </td>
                    <?php } ?>

                    <?php if ( $variable[$i]->user_active == 1 ) { ?>
                        <td><span style="text-transform:capitalize"><?= str_replace("_"," ",$variable[$i]->roles[0]);  ?></span></td>
                    <?php } else { ?>
                        <td><span style="text-transform:capitalize">-</span></td>
                    <?php } ?>

                    <?php if ( current_user_can( 'administrator' ) ) { ?>
                        <td>
                            <?php $regions = permissions_regions_single($variable[$i]->displayid, false);
                            if ($regions[0]->mainland == 1) {
                                ?><span class="regionFlag d-inline-block" style="margin-right:5px;background-image: url(/app/assets/images/uk.png)"></span><?php
                            }
                            if ($regions[0]->ireland == 1) {
                                ?><span class="regionFlag d-inline-block" style="margin-right:5px;background-image: url(/app/assets/images/ireland.png)"></span><?php
                            } ?>
                        </td>
                        <td>
                            <div class="permission">
                                <?php
                                $permissions = permissions_single($variable[$i]->displayid, false);
                                foreach ($permissions as $permission) {
                                    ?>
                                    <span class="<?php
                                    if ($permission->value == 'granted') {
                                        echo 'status_green';
                                    } elseif ($permission->value == 'blocked') {
                                        echo 'status_red';
                                    } else {
                                        echo 'status_none';
                                    }
                                    ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= ucwords($permission->type) ?>"></span>
                                    <?php
                                }
                                ?>
                            </div>
                        </td>
                    <?php } ?>

                    <td class="archived_date"><div><?= formatted_renewal_date($variable[$i]->user_registered);  ?></div></td>

                    <?php if ( current_user_can( 'administrator' ) ) { ?>
                        <td class="form_actions" style="text-align: right;">
                            <a class="text-light" href="/app/page_view_users_view.php?displayid=<?= $variable[$i]->displayid ?>">
                                <button class="btn btn-primary waves-effect waves-light" type="submit">
                                    <i class="mdi mdi-eye d-inline-block font-size-16"></i>
                                </button>
                            </a>
                            <a class="text-light" href="page_view_users_view?tab=contacts_permissions&displayid=<?= $variable[$i]->displayid; ?>">
                                <button data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="btn btn-edit waves-effect waves-light" type="submit">
                                    <i class="mdi mdi-security d-block font-size-16"></i>
                                </button>
                            </a>
                            <a class="text-light" href="page_view_users_view?tab=contacts_settings&displayid=<?= $variable[$i]->displayid; ?>">
                                <button data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="btn btn-edit waves-effect waves-light" type="submit">
                                    <i class="mdi mdi-pencil d-block font-size-16"></i>
                                </button>
                            </a>
                            <form method="post" class="form-inline">
                                <button <?php if (is_email_super_admin($variable[$i]->displayid)) { echo 'disabled'; } ?> data-bs-toggle="tooltip" data-bs-placement="top" title="<?php if ($variable[$i]->user_active == 0) { echo 'Enable'; } else { echo 'Disable'; } ?>" class="btn <?php if ($variable[$i]->user_active == 1) { echo 'btn-danger'; } else { echo 'btn-success'; } ?> waves-effect waves-light" type="submit" name="contacts_status" value="<?= $variable[$i]->displayid; ?>">
                                    <?php if ($variable[$i]->user_active == 0) {
                                        echo '<i class="mdi mdi-account-check d-block font-size-16"></i>';
                                    } else {
                                        echo '<i class="mdi mdi-account-cancel d-block font-size-16"></i>';
                                    } ?>
                                </button>
                            </form>
                        </td>
                    <?php } ?>

                </tr>

            <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>
