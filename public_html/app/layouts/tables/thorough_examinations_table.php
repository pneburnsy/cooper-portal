<?php
function thorough_examinations_table($variable) { ?>
    <div class="table-responsive section-block">
        <table id="datatable-buttons-exam" class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
            <thead>
            <tr>
                <?php if ($_GET['page'] == 'completed') { ?>
                    <th scope="col">Completed Date</th>
                    <th scope="col">Completed By</th>
                <?php } ?>
                <th scope="col">Renewal Date</th>
                <th scope="col">Account</th>
                <th scope="col">Region</th>
                <th scope="col" class="form_name">Make</th>
                <th scope="col">Model</th>
                <th scope="col">Fleet Number</th>
                <th scope="col">Serial Number</th>
                <th scope="col">Year</th>
                <th scope="col">Hour Reading</th>
                <th scope="col">Record Number</th>
                <th scope="col">Issuing Company</th>
                <th scope="col">Issue Date</th>
                <th scope="col">Expiry Date</th>
                <th scope="col">Creation Date</th>
                <th class="hide-sorting form_actions">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($variable); $i++) { ?>

                <?php
                global $accounts_team_single;
                accounts_team_single( $variable[$i]->clientaccount, false);
                $duename = renewal_due_check($variable[$i]->renewal_date)['name'];
                $duestatus = renewal_due_check($variable[$i]->renewal_date)['class'];
                ?>

                <tr class="<?php if (renewal_is_completed() == false && renewal_is_bin() == false ) { echo $variable[$i]->displayid . ' ' . $duestatus; } ?>">

                    <?php if ($_GET['page'] == 'completed') { ?>
                        <td class="archived_date" data-sort="<?= $variable[$i]->status_date; ?>">
                            <div><?= formatted_renewal_date($variable[$i]->status_date); ?></div>
                        </td>

                        <td class="table_profile">
                            <?php $online_date = online_status_true($variable[$i]->status_userid); ?>
                            <span class="table-image" data-bs-toggle="tooltip" data-bs-placement="top"
                                  title="<?= other_user_fullname($variable[$i]->status_userid) . ' (Currently: ' . $online_date[1] . ')'; ?>">
                            <?php if (other_user_profile_picture($variable[$i]->status_userid)) { ?>
                                <img height="22" width="22" class="profile-image-active-tiny"
                                     src="<?= other_user_profile_picture($variable[$i]->status_userid); ?>">
                            <?php } else {
                                ?><span class="table-name"><?php
                                echo other_user_firstname($variable[$i]->status_userid)[0] . other_user_lastname($variable[$i]->status_userid)[0];
                                ?></span><?php
                            } ?>
                            <span style="font-size:0px;visbility:hidden;"><?= other_user_fullname($variable[$i]->status_userid); ?></span>
                        </span>
                        </td>
                    <?php } ?>

                    <td class="renewal_date" data-sort="<?= $variable[$i]->renewal_date; ?>">
                        <?php if (doif_cooperonly_query() && $_GET['page'] != 'completed') { ?><a href="page_thorough_examinations_view.php?displayid=<?= $variable[$i]->displayid; ?>"><?php } ?>
                            <span class="value"><?= formatted_renewal_date($variable[$i]->renewal_date); ?></span>
                            <?php if (renewal_is_uncompleted()) { ?>
                                <span class="<?= $duestatus ?>">
                                    <span class="renewal"><?= $duename ?></span>
                                </span>
                            <?php } ?>
                        <?php if (doif_cooperonly_query() && $_GET['page'] != 'completed') { ?></a><?php } ?>
                    </td>

                    <td class="form_name" data-sort="<?= $variable[$i]->region; ?>">
                        <?= get_region_flag($variable[$i]->region); ?>
                    </td>

                    <td class="form_name">
                        <?php if ($variable[$i]->clientaccount) { ?>
                            <a class="account_icon_full" style="background-color:rgba(<?= $accounts_team_single[0]->accountarray; ?>, 0.3)"
                               href="page_accounts_view.php?displayid=<?= $accounts_team_single[0]->displayid; ?>">
                                <?= $accounts_team_single[0]->accountname; ?>
                            </a>
                        <?php } else { ?>
                            <a href="page_thorough_examinations_view.php?displayid=<?= $variable[$i]->displayid; ?>&tab=renewal_settings"
                               class="placeholder">Add Account +</a>
                        <?php } ?>
                    </td>

                    <td class="form_name">
                        <?= $variable[$i]->make; ?>
                    </td>

                    <td class="form_name">
                        <?= $variable[$i]->model; ?>
                    </td>

                    <td class="form_name">
                        <?= $variable[$i]->fleet_no; ?>
                    </td>

                    <td class="form_name">
                        <?= $variable[$i]->serial_no; ?>
                    </td>

                    <td class="form_name">
                        <?= $variable[$i]->year_of_man; ?>
                    </td>

                    <td class="form_name">
                        <?= $variable[$i]->hour_reading; ?>
                    </td>

                    <td class="form_name">
                        <?= $variable[$i]->record_number; ?>
                    </td>

                    <td class="form_name">
                        <?= $variable[$i]->issuing_company; ?>
                    </td>

                    <td class="form_name">
                        <?= formatted_renewal_date($variable[$i]->issue_date); ?>
                    </td>

                    <td class="form_name">
                        <?= formatted_renewal_date($variable[$i]->expiry_date); ?>
                    </td>

                    <td class="form_name creation_date">
                        <span><?= formatted_date_time($variable[$i]->creation_date); ?></span>
                    </td>

                    <td class="form_actions" style="text-align: right;">
                        <?php if ($_GET['page'] == 'completed') {
                            // Complete
                            include 'layouts/includes/renewals/renewals_action_completed.php';
                        } else {
                            // Uncomplete
                            include 'layouts/includes/renewals/renewals_action_uncomplete.php';
                        } ?>
                    </td>

                </tr>

            <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- SCROLLING TABLE HEAD JS -->
    <script src="assets/js/pages/scrolling_thead.js"></script>
    <script>document.addEventListener('DOMContentLoaded', setupStickyHeader('datatable-buttons-exam'));</script>
<?php } ?>