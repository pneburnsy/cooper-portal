<?php
function rentals_history_table($variable) { ?>
    <div class="table-responsive section-block">
        <table id="datatable-buttons-rentals" class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
            <thead>
            <tr>
                <th scope="col">Completed Date</th>
                <th scope="col">Completed By</th>
                <th scope="col">Hire Start</th>
                <th scope="col">Hire End</th>
                <th scope="col">Account</th>
                <th scope="col">Contract Reference</th>
                <th scope="col">Contract Hrs</th>
                <?php if ( current_user_can( 'administrator' ) ) { ?>
                    <th scope="col">Rent Rate (Weekly)</th>
                    <th scope="col">Excess Rate (Hrs)</th>
                    <th scope="col">Excess Min Charge</th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($variable); $i++) { ?>

                <?php
                global $accounts_team_single;
                accounts_team_single( $variable[$i]->clientaccount, false);
                if ($variable[$i]->hire_start) {
                    if ($variable[$i]->hire_start && $variable[$i]->hire_end) {
                        $duename = renewal_due_check($variable[$i]->hire_end)['name_rentals'];
                        $duestatus = renewal_due_check($variable[$i]->hire_end)['class'];
                        $duevalue = formatted_renewal_date($variable[$i]->hire_end);
                        $duesort = renewal_due_check($variable[$i]->hire_end)['sort'];
                    } else {
                        $duename = 'Attention';
                        $duestatus = 'duesoon';
                        $duevalue = 'Enter End Date';
                        $duesort = '3';
                    }
                } else {
                    $duename = 'Off-Hire';
                    $duestatus = 'available';
                    $duevalue = '-';
                    $duesort = '6';
                }
                ?>

                <tr>

                    <td class="archived_date" data-sort="<?= $variable[$i]->creation_date; ?>">
                        <div><?= formatted_renewal_date($variable[$i]->creation_date); ?></div>
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

                    <td data-sort="<?= $variable[$i]->hire_start; ?>">
                        <div><?= formatted_renewal_date($variable[$i]->hire_start); ?></div>
                    </td>

                    <td data-sort="<?= $variable[$i]->hire_end; ?>">
                        <div><?php if ($variable[$i]->hire_end == NULL) { echo formatted_renewal_date($variable[$i]->hire_end); } else { echo '-'; } ?></div>
                    </td>

                    <td class="form_name">
                        <?php if ($variable[$i]->clientaccount) { ?>
                            <a class="account_icon_full" style="background-color:rgba(<?= $accounts_team_single[0]->accountarray; ?>, 0.3)"
                               href="page_accounts_view.php?displayid=<?= $accounts_team_single[0]->displayid; ?>">
                                <?= $accounts_team_single[0]->accountname; ?>
                            </a>
                        <?php } else { ?>
                            <a href="page_rental_equipment_view.php?displayid=<?= $variable[$i]->displayid; ?>&tab=renewal_settings"
                               class="placeholder">Add Account +</a>
                        <?php } ?>
                    </td>

                    <td class="form_name">
                        <?php if ($variable[$i]->contract_reference) {
                            echo $variable[$i]->contract_reference;
                        } else {
                            echo '<span class="placeholder">-</span>';
                        } ?>
                    </td>

                    <td class="form_name">
                        <?php if ($variable[$i]->contracted_hours) {
                            echo $variable[$i]->contracted_hours;
                        } else {
                            echo '<span class="placeholder">-</span>';
                        } ?>
                    </td>

                    <?php if ( current_user_can( 'administrator' ) ) { ?>
                        <td class="form_name">
                            <?php if ($variable[$i]->rent_rate) { ?>
                                <span class="positive_number"><?= '£' . $variable[$i]->rent_rate; ?></span>
                            <?php } else {
                                echo '<span class="placeholder">-</span>';
                            } ?>
                        </td>

                        <td class="form_name">
                            <?php if ($variable[$i]->excess_rate) { ?>
                                <span class="positive_number"><?= '£' . $variable[$i]->excess_rate; ?></span>
                            <?php } else {
                                echo '<span class="placeholder">-</span>';
                            } ?>
                        </td>

                        <td class="form_name">
                            <?php if ($variable[$i]->excess_rate_min) { ?>
                                <span class="positive_number"><?= '£' . $variable[$i]->excess_rate_min;  ?></span>
                            <?php } else {
                                echo '<span class="placeholder">-</span>';
                            } ?>
                        </td>
                    <?php } ?>

                </tr>

            <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- SCROLLING TABLE HEAD JS -->
    <script src="assets/js/pages/scrolling_thead.js"></script>
    <script>document.addEventListener('DOMContentLoaded', setupStickyHeader('datatable-buttons-rentals'));</script>
<?php } ?>