<?php
function rentals_table($variable) { ?>
    <div class="table-responsive section-block">
        <table id="datatable-buttons-rentals" class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
            <thead>
            <tr>
                <th scope="col">Hire End</th>
                <th scope="col">Hire Start</th>
                <th scope="col">Region</th>
                <th scope="col">Account</th>
                <th scope="col">Contract Reference</th>
                <th scope="col" class="form_name">Make</th>
                <th scope="col">Model</th>
                <th scope="col">Serial Number</th>
                <th scope="col">Year</th>
                <th scope="col">Finance Company</th>
                <th scope="col">Agreement Number</th>
                <th scope="col">Contract Hrs</th>
                <?php if ( current_user_can( 'administrator' ) ) { ?>
                    <th scope="col">Rent Rate (Weekly)</th>
                    <th scope="col">Excess Rate (Hrs)</th>
                    <th scope="col">Excess Min Charge</th>
                <?php } ?>
                <th scope="col">Creation Date</th>
                <th class="hide-sorting form_actions">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($variable); $i++) { ?>

                <?php
                global $accounts_team_single;
                accounts_team_single( $variable[$i]->clientaccount, false);
                if ($variable[$i]->hire_start) {
                    $duename = renewal_due_check_advanced($variable[$i]->hire_start, $variable[$i]->hire_end)['name_rentals'];
                    $duestatus = renewal_due_check_advanced($variable[$i]->hire_start, $variable[$i]->hire_end)['class'];
                    if ($variable[$i]->hire_end) { $duevalue = formatted_renewal_date($variable[$i]->hire_end); } else { $duevalue = 'No End Date'; }
                    $duesort = renewal_due_check_advanced($variable[$i]->hire_start, $variable[$i]->hire_end)['sort'];
                } else {
                    $duename = 'Off-Hire';
                    $duestatus = 'available';
                    $duevalue = '-';
                    $duesort = '6';
                }
                ?>

                <tr class="<?php if (renewal_is_completed() == false || renewal_is_bin() == false ) { echo $variable[$i]->displayid . ' ' . $duestatus; } ?>">


                    <td class="renewal_date" data-sort="<?= $duesort; ?>">
                        <?php if (doif_cooperonly_query()) { ?> <a href="page_rental_equipment_view.php?displayid=<?= $variable[$i]->displayid; ?>"> <?php } ?>
                            <span class="value"><?= $duevalue ?></span>
                            <span class="<?= $duestatus ?>">
                                <span class="renewal"><?= $duename ?></span>
                            </span>
                        <?php if (doif_cooperonly_query()) { ?> </a> <?php } ?>
                    </td>

                    <td data-sort="<?= $duesort; ?>">
                        <?php if (doif_cooperonly_query()) { ?> <a href="page_rental_equipment_view.php?displayid=<?= $variable[$i]->displayid; ?>"> <?php } ?>
                            <?php if ($variable[$i]->hire_start) { ?>
                                <div><?= formatted_renewal_date($variable[$i]->hire_start); ?></div>
                            <?php } else { ?>
                                <div class="<?= $duestatus ?>">-</div>
                            <?php } ?>
                        <?php if (doif_cooperonly_query()) { ?> </a> <?php } ?>
                    </td>

                    <td class="form_name" data-sort=" <?= $variable[$i]->region; ?>">
                        <?= get_region_flag($variable[$i]->region); ?>
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
                        <?= $variable[$i]->make; ?>
                    </td>

                    <td class="form_name">
                        <?php if ($variable[$i]->model) {
                            echo $variable[$i]->model;
                        } else {
                            echo '<span class="placeholder">-</span>';
                        } ?>
                    </td>

                    <td class="form_name">
                        <?= $variable[$i]->serial_no; ?>
                    </td>

                    <td class="form_name">
                        <?= $variable[$i]->year_of_man; ?>
                    </td>

                    <td class="form_name">
                        <?= $variable[$i]->finance_company; ?>
                    </td>

                    <td class="form_name">
                        <?php if ($variable[$i]->agreement_number) {
                            echo $variable[$i]->agreement_number;
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
                            <?php if ($variable[$i]->rent_rate && $variable[$i]->rent_rate != 0) { ?>
                                <span class="positive_number"><?= '£' . $variable[$i]->rent_rate; ?></span>
                            <?php } else {
                                echo '<span class="placeholder">-</span>';
                            } ?>
                        </td>

                        <td class="form_name">
                            <?php if ($variable[$i]->excess_rate && $variable[$i]->excess_rate != 0) { ?>
                                <span class="positive_number"><?= '£' . $variable[$i]->excess_rate; ?></span>
                            <?php } else {
                                echo '<span class="placeholder">-</span>';
                            } ?>
                        </td>

                        <td class="form_name">
                            <?php if ($variable[$i]->excess_rate_min && $variable[$i]->excess_rate_min != 0) { ?>
                                <span class="positive_number"><?= '£' . $variable[$i]->excess_rate_min;  ?></span>
                            <?php } else {
                                echo '<span class="placeholder">-</span>';
                            } ?>
                        </td>
                    <?php } ?>

                    <td class="form_name creation_date">
                        <span><?= formatted_date_time($variable[$i]->creation_date); ?></span>
                    </td>

                    <td class="form_actions" style="text-align: right;">
                        <?php if (doif_cooperonly_query()) { ?>
                            <a  class="text-light" href="page_rental_equipment_view?displayid=<?= $variable[$i]->displayid; ?>">
                                <button data-bs-toggle="tooltip" data-bs-placement="top" title="View" class="btn btn-primary waves-effect waves-light" type="submit">
                                    <i class="mdi mdi-eye d-inline-block font-size-16"></i>
                                </button>
                            </a>
                        <?php } ?>
                        <?php if (doif_coopereditoronly_query()) { ?>
                            <a class="text-light" href="page_rental_equipment_view?tab=renewal_settings&displayid=<?= $variable[$i]->displayid; ?>">
                                <button data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="btn btn-edit waves-effect waves-light" type="submit">
                                    <i class="mdi mdi-pencil d-block font-size-16"></i>
                                </button>
                            </a>
                        <?php } ?>
                    </td>

                </tr>

            <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- SCROLLING TABLE HEAD JS -->
    <script src="assets/js/pages/scrolling_thead.js"></script>
    <script>document.addEventListener('DOMContentLoaded', setupStickyHeader('datatable-buttons-rentals'));</script>
<?php } ?>