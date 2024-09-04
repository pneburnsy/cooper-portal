<?php
function service_table($variable) { ?>

    <?php
    $lastSixWeeks = array();
    $lastSixWeekNumbers = array();
    $currentDate = new DateTime();
    $currentWeek = $currentDate->format('W');
    $currentYear = $currentDate->format('Y');
    for ($i = 0; $i <= 5; $i++) {
        $weekNumber = $currentWeek - $i;
        $year = $currentYear;
        if ($weekNumber < 1) {
            $year--;
            $weekNumber = 52 + $weekNumber;
        }
        $lastSixWeeks[] = array(
            'week' => $weekNumber,
            'year' => $year,
        );
        $lastSixWeekNumbers[] = $weekNumber;
    }
    ?>

    <div class="table-responsive section-block">
        <table id="datatable-buttons-service" class="table align-middle datatable dt-responsive table-check nowrap display" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
            <thead>
                <tr>
                    <?php if ($_GET['page'] == 'completed') { ?>
                        <th scope="col">Completed Date</th>
                        <th scope="col">Completed By</th>
                    <?php } ?>
                    <th scope="col" class="hide-sorting th-align-col-right" data-bs-toggle="tooltip" data-bs-placement="top" title="This equipment should be serviced within this many operating hours (Minus means overdue).">Due In (Hrs)</th>
                    <th scope="col" class="form_name" data-bs-toggle="tooltip" data-bs-placement="top" title="This equipment should be serviced by this due date.">Due By (Date)</th>
                    <?php if($_GET['page'] != 'completed') { ?>
                        <th scope="col" class="form_name" data-bs-toggle="tooltip" data-bs-placement="top" title="This equipment has a service scheduled for this date.">Service Scheduled (Date)</th>
                    <?php } ?>
                    <th scope="col" class="form_name">Region</th>
                    <th>Account</th>
                    <th scope="col" class="form_name">Fleet Number</th>
                    <?php if($_GET['page'] != 'completed') { ?>
                        <th scope="col" class="form_name" data-bs-toggle="tooltip" data-bs-placement="top" title="Have ODO readings been submitted for the last 6 weeks?">Submissions (Wk)</th>
                    <?php } ?>
                    <?php if ($_GET['page'] == 'completed') { ?>
                        <th scope="col" class="form_name">Final ODO (Hrs/Date)</th>
                    <?php } else { ?>
                        <th scope="col" class="form_name" data-bs-toggle="tooltip" data-bs-placement="top" title="The latest ODO reading data received.">Latest ODO (Hrs/Date)</th>
                    <?php } ?>
                    <th scope="col" class="form_name" data-bs-toggle="tooltip" data-bs-placement="top" title="The ODO reading data when last serviced.">Last Service (Hrs/Date)</th>
                    <th scope="col" class="form_name">Service Within (Hrs/Date)</th>
                    <th scope="col" class="form_name">Make</th>
                    <th scope="col" class="form_name">Model</th>
                    <th scope="col" class="form_name">Serial Number</th>
                    <th scope="col" class="form_name">Engine Serial Number</th>
                    <th scope="col" class="form_name">Location</th>
                    <th scope="col" class="form_name">Creation Date</th>
                    <th class="hide-sorting form_actions">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($variable); $i++) { ?>

                <?php

                $current_hours = hours_until_service($variable[$i]->serviceduein, $variable[$i]->last_odo_hours, $variable[$i]->lastest_odo_hours);
                $last_service_date = $variable[$i]->due_odo_date;
                // GLOBAL
                global $service_status;
                global $renewal_date;
                // FUNCTIONS
                hours_due_in($current_hours, $last_service_date);
                // VARIABLES
                $duestatus = $service_status['class'];
                $duename = $service_status['name_service'];
                $dueorder = $service_status['sort'];
                $duedate = $renewal_date;

                global $accounts_team_single;
                accounts_team_single( $variable[$i]->clientaccount, false);

                ?>

                <tr class="<?php if (renewal_is_completed() == false && renewal_is_bin() == false ) { echo $variable[$i]->displayid . ' ' . $duestatus; } ?>" id="service_schedule_<?= $i ?>">

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

                    <td class="form_name align-col-right" data-sort="<?= $dueorder ?>">
                        <strong><?= $current_hours ?></strong>
                    </td>

                    <td class="renewal_date" data-sort="<?= $dueorder ?>">
                        <?php if (doif_cooperonly_query() && $_GET['page'] != 'completed') { ?><a href="page_service_contract_view.php?displayid=<?= $variable[$i]->displayid; ?>"><?php } ?>
                            <span class="value"><?= formatted_renewal_date($duedate); ?></span>
                            <?php if (renewal_is_uncompleted()) { ?>
                                <span class="<?= $duestatus ?>">
                                    <span class="renewal"><?= $duename ?></span>
                                </span>
                            <?php } ?>
                        <?php if (doif_cooperonly_query() && $_GET['page'] != 'completed') { ?></a><?php } ?>
                    </td>

                    <?php if($_GET['page'] != 'completed') { ?>
                    <td class="schedule_date" data-sort="<?= $variable[$i]->schedule_date ?>">
                        <a href="page_service_contract_view.php?displayid=<?= $variable[$i]->displayid; ?>&tab=service_schedule">
                            <?php
                            if ($variable[$i]->schedule_date == '0000-00-00' || !$variable[$i]->schedule_date) {
                                echo '<span class="schedule_container schedule_false"><span class="status_none"></span><span>Schedule Service +</span></span>';
                            } else {
                                ?>
                                <span class="schedule_container schedule_true">
                                    <span class="status_dot <? if ($variable[$i]->schedule_date > date('Y-m-d')) { echo 'status_green'; } elseif ($variable[$i]->schedule_date == date('Y-m-d')) { echo 'status_yellow'; } else { echo 'status_red'; }?> "></span>
                                    <?= formatted_renewal_date($variable[$i]->schedule_date) ?>
                                </span>
                                <?php
                            }
                            ?>
                        </a>
                    </td>
                    <?php } ?>

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
                            <a href="page_maintenance_view.php?displayid=<?= $variable[$i]->displayid; ?>&tab=service_settings"
                               class="placeholder">Add Account +</a>
                        <?php } ?>
                    </td>

                    <td class="form_name">
                        <?php
                        if ($variable[$i]->fleet_no && $variable[$i]->fleet_no != '0') {
                            echo $variable[$i]->fleet_no;
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>

                    <?php if($_GET['page'] != 'completed') { ?>
                        <td class="form_name schedule">
                            <?php
                            // CHECK WEEKS SINCE LAST SUBMISSION
                            $weekSinceNumbers = new DatePeriod(
                                new DateTime(date('Y-m-d', strtotime($variable[$i]->lastest_odo_date))),
                                new DateInterval('P1W'),
                                new DateTime(date('Y-m-d'))
                            );
                            $weekNumber = date("W", strtotime($variable[$i]->lastest_odo_date));
                            $alwaysgreen = 'false';
                            ?>
                            <div>
                                <?php for($x = 0; $x < count($lastSixWeeks); $x++) { ?>
                                <?php //echo $lastSixWeekNumbers[0] . ' - '; echo $weekNumber; ?>
                                    <?php if ($lastSixWeekNumbers[$x] != $weekNumber && $alwaysgreen == 'false') { ?>
                                        <span class="status_red"><?= $lastSixWeeks[$x]['week'] ?></span>
                                    <?php } else { ?>
                                        <span class="status_green" ><?= $lastSixWeeks[$x]['week'] ?></span>
                                        <?php $alwaysgreen = 'true'; ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($alwaysgreen == 'false') {
                                    ?><script>
                                        const thisItem<?= $i ?> = document.getElementById('service_schedule_<?= $i ?>');
                                        thisItem<?= $i ?>.classList.add('long_orderdue');
                                    </script><?php
                                } ?>
                            </div>
                        </td>
                    <?php } ?>

                    <td class="form_name">
                        <strong><?= $variable[$i]->lastest_odo_hours; ?></strong> <span class="tiny_date">(<?= formatted_renewal_date($variable[$i]->lastest_odo_date); ?>)</span>
                    </td>

                    <td class="form_name">
                        <strong><?= $variable[$i]->last_odo_hours; ?></strong> <span class="tiny_date">(<?= formatted_renewal_date($variable[$i]->last_odo_date); ?>)</span>
                    </td>

                    <td class="form_name">
                        <strong><?= $variable[$i]->serviceduein . '</strong> <span class="tiny_date">(' . formatted_renewal_date($variable[$i]->due_odo_date) . ')</span>'; ?>
                    </td>

                    <td class="form_name">
                        <?php
                        if ($variable[$i]->make && $variable[$i]->make != '0') {
                            echo $variable[$i]->make;
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>

                    <td class="form_name">
                        <?php
                        if ($variable[$i]->model && $variable[$i]->model != '0') {
                            echo $variable[$i]->model;
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>

                    <td class="form_name">
                        <?php
                        if ($variable[$i]->man_serial_no && $variable[$i]->man_serial_no != '0') {
                            echo $variable[$i]->man_serial_no;
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>

                    <td class="form_name">
                        <?php
                        if ($variable[$i]->eng_serial_no && $variable[$i]->eng_serial_no != '0') {
                            echo $variable[$i]->eng_serial_no;
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>

                    <td class="form_name">
                        <a target="_blank" href="https://www.google.com/maps/place/<?= $variable[$i]->postcode ?>">
                            <?php
                                echo '<strong>' . $variable[$i]->postcode . '</strong>';
                                if ($variable[$i]->location) {
                                    echo ' (' . $variable[$i]->location . ')';
                                }
                            ?>
                        </a>
                    </td>

                    <td class="form_name creation_date">
                        <span><?= formatted_date_time($variable[$i]->creation_date); ?></span>
                    </td>

                    <td class="form_actions" style="text-align: right;">
                        <?php if ($_GET['page'] == 'completed') {
                            // Complete
                            include 'layouts/includes/service/service_action_completed.php';
                        } else {
                            // Uncomplete
                            include 'layouts/includes/service/service_action_uncomplete.php';
                        } ?>
                    </td>

                </tr>

            <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- SCROLLING TABLE HEAD JS -->
    <script src="assets/js/pages/scrolling_thead.js"></script>
    <script>document.addEventListener('DOMContentLoaded', setupStickyHeader('datatable-buttons-service'));</script>
<?php } ?>


