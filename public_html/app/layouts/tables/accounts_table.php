<?php
function accounts_table($variable) { ?>
    <div class="table-responsive section-block">
        <table id="datatable-buttons-accounts" class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
            <thead>
            <tr>
                <th scope="col" class="form_name">Account Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Fleet Manager</th>
                <th scope="col">Website</th>
                <th scope="col set-width">Contacts</th>
                <th scope="col set-width">Surveys</th>
                <th scope="col set-width">Maintenance</th>
                <th scope="col set-width">Rental</th>
                <th scope="col set-width">Examinations</th>
                <?php if ( current_user_can( 'administrator' ) ) { ?>
                    <th scope="col set-width">Service Planner</th>
                <?php } ?>
                <th scope="col">Creation Date</th>
                <th class="hide-sorting form_actions">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($variable); $i++) { ?>

                <tr class="<?= $variable[$i]->displayid; ?>">

                    <td class="form_name">
                        <span class="account_icon" style="background-color:rgba( <?= $variable[$i]->accountarray; ?> , 0.5)"></span>
                        <a href="page_accounts_view.php?displayid=<?= $variable[$i]->displayid; ?>"><?= $variable[$i]->accountname; ?></a>
                    </td>

                    <td>
                        <?php if ($variable[$i]->accountphone) { ?>
                            <a href="tel:<?= $variable[$i]->accountphone; ?>"><?= $variable[$i]->accountphone; ?></a>
                        <?php } else { ?>
                            <a href="page_accounts_view.php?tab=accounts_settings&displayid=<?= $variable[$i]->displayid; ?>" class="placeholder">Add Phone +</a>
                        <?php } ?>
                    </td>

                    <td>
                        <?php if ($variable[$i]->accountemail) { ?>
                            <a href="mailto:<?= $variable[$i]->accountemail; ?>"><?= $variable[$i]->accountemail; ?></a>
                        <?php } else { ?>
                            <a href="page_accounts_view.php?tab=accounts_settings&displayid=<?= $variable[$i]->displayid; ?>" class="placeholder">Add Email +</a>
                        <?php } ?>
                    </td>

                    <td>
                        <?php if ($variable[$i]->fleetmanager) { ?>
                            <a href="mailto:<?= other_user_email(other_convert_displayid($variable[$i]->fleetmanager)); ?>"><?= other_user_email(other_convert_displayid($variable[$i]->fleetmanager)) . ' (' . other_user_fullname(other_convert_displayid($variable[$i]->fleetmanager)) . ')' ?></a>
                        <?php } else { ?>
                            <a href="page_accounts_view.php?tab=accounts_settings&displayid=<?= $variable[$i]->displayid; ?>" class="placeholder">Add Fleet Manager +</a>
                        <?php } ?>
                    </td>

                    <td>
                        <?php if ($variable[$i]->accountwebsite) { ?>
                            <a target="_blank" href="<?php if ($variable[$i]->accountwebsite) { ?>http://www.<?= $variable[$i]->accountwebsite; }?>">
                                <?php if ($variable[$i]->accountwebsite) { echo 'www.' . $variable[$i]->accountwebsite; } ?>
                            </a>
                        <?php } else { ?>
                            <a href="page_accounts_view.php?tab=accounts_settings&displayid=<?= $variable[$i]->displayid; ?>" class="placeholder">Add Website +</a>
                        <?php } ?>
                    </td>


                    <td>
                        <span class="<?php if (accounts_team_users_count($variable[$i]->displayid) == 0) { echo 'no_'; } ?>contacts">
                            <?php echo accounts_team_users_count($variable[$i]->displayid); ?>
                        </span>
                    </td>

                    <td>
                        <span class="<?php if (accounts_team_survey_count($variable[$i]->displayid, false) == 0) { echo 'no_'; } ?>contacts">
                            <?php echo accounts_team_survey_count($variable[$i]->displayid, false); ?>
                        </span>
                    </td>

                    <td>
                        <span class="<?php if (accounts_team_maintenance_count($variable[$i]->displayid, false) == 0) { echo 'no_'; } ?>contacts">
                            <?php echo accounts_team_maintenance_count($variable[$i]->displayid, false); ?>
                        </span>
                    </td>

                    <td>
                        <span class="<?php if (accounts_team_rentals_count($variable[$i]->displayid, false) == 0) { echo 'no_'; } ?>contacts">
                            <?php echo accounts_team_rentals_count($variable[$i]->displayid, false); ?>
                        </span>
                    </td>

                    <td>
                        <span class="<?php if (accounts_team_exam_count($variable[$i]->displayid, false) == 0) { echo 'no_'; } ?>contacts">
                            <?php echo accounts_team_exam_count($variable[$i]->displayid, false); ?>
                        </span>
                    </td>

                    <?php if ( current_user_can( 'administrator' ) ) { ?>
                        <td>
                            <span class="<?php if (accounts_team_service_contracts_count($variable[$i]->displayid, false) == 0) { echo 'no_'; } ?>contacts">
                                <?php echo accounts_team_service_contracts_count($variable[$i]->displayid, false); ?>
                            </span>
                        </td>
                    <?php } ?>

                    <td class="form_name creation_date">
                        <span><?= formatted_date_time($variable[$i]->accountcreated); ?></span>
                    </td>

                    <td class="form_actions" style="text-align: right;">
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="View" class="text-light" href="page_accounts_view.php?displayid=<?= $variable[$i]->displayid; ?>">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">
                                <i style="height:16px;top:-1px;position:relative;" data-feather="user"></i> View Account
                            </button>
                        </a>
                    </td>

                </tr>

            <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- SCROLLING TABLE HEAD JS -->
    <script src="assets/js/pages/scrolling_thead.js"></script>
    <script>document.addEventListener('DOMContentLoaded', setupStickyHeader('datatable-buttons-accounts'));</script>
<?php } ?>