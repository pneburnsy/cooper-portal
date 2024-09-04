
<div id="service_hours_submissions" class="card tab-pane <?php if ($_GET['tab'] == 'service_hours_submissions') { echo 'active'; } ?>" role="tabpanel">
    <div class="card-body p-0" style="background:#fff;border-radius:10px;padding:0;">
        <div class="row bs-0">
            <div class="col-md-6 p-0">
                <div class="form-highlight">
                    <h4>ODO Submissions</h4>
                    <p class="mb-2">Send a reminder email to the Fleet Manager to fill in the latest outstanding ODO Readings.</p>

                    <?php
                    $lastSixWeeks = array();
                    // Get the current week and year as a DateTime object
                    $currentDate = new DateTime();
                    $currentWeek = $currentDate->format('W');
                    $currentYear = $currentDate->format('Y');
                    // Loop through the last 6 weeks (excluding the current week)
                    for ($i = 1; $i <= 6; $i++) {
                        // Calculate the week number and year for the current iteration
                        $weekNumber = $currentWeek - $i;
                        $year = $currentYear;
                        // If the week number is less than 1, adjust the year and week number accordingly
                        if ($weekNumber < 1) {
                            $year--;
                            $weekNumber = 52 + $weekNumber;
                        }
                        // Add the week number and year to the result array
                        $lastSixWeeks[] = array(
                        'week' => $weekNumber,
                        'year' => $year,
                        );
                    }
                    ?>

                    <?php
                    // CHECK WEEKS SINCE LAST SUBMISSION
                    $weekSinceNumbers = new DatePeriod(
                        new DateTime(date('Y-m-d', strtotime($service_view[0]->lastest_odo_date))),
                        new DateInterval('P1W'),
                        new DateTime(date('Y-m-d'))
                    );
                    $weekSinceNumberArray = array();
                    foreach ($weekSinceNumbers as $week) {
                        $weekSinceNumberArray[] = $week->format('W Y');
                    }
                    ?>

                    <div class="form_name_view mb-4 mt-3">
                        <?php for($x = 0; $x < count($lastSixWeeks); $x++) { ?>
                            <?php if (!$weekSinceNumberArray[$x]) { ?>
                                <span class="status_green" ><?= $lastSixWeeks[$x]['week'] ?></span>
                            <?php } else {?>
                                <span class="status_red"><?= $lastSixWeeks[$x]['week'] ?></span>
                            <?php } ?>
                        <?php } ?>
                    </div>

                    <?php if ($accounts_team_single[0]->fleetmanager) {
                        $firstname = other_user_firstname(other_convert_displayid($accounts_team_single[0]->fleetmanager));
                        $lastname = other_user_lastname(other_convert_displayid($accounts_team_single[0]->fleetmanager));
                        $fleetemail = other_user_email(other_convert_displayid($accounts_team_single[0]->fleetmanager));
                        ?><span class="mb-4 outstanding_weeks"><strong>Fleet Manager: </strong><?= $firstname . ' ' . $lastname . ' (' . $fleetemail . ')'?></span><?php
                    } else {
                        ?><span class="mb-4 outstanding_weeks"><strong>Fleet Manager: </strong>
                            <a class="text-light account-add-details placeholder" href="/app/page_accounts_view.php?displayid=<?= $accounts_team_single[0]->displayid ?>&tab=accounts_settings">
                                <span style="font-weight:normal;font-size: 12px;padding: 0 0 0 10px;">Add Fleet Manager +</span>
                            </a>
                        </span><?php
                    } ?>

                    <div class="d-inline-block">
                        <a href="/app/page_service_account_submission?clientaccount=<?= $service_view[0]->clientaccount ?>" style="margin-bottom:10px;" class="d-inline-block btn btn-primary waves-effect waves-light">Submit Hours</a>
                        <?php if ($accounts_team_single[0]->fleetmanager) { ?>
                            <form method="post" class="d-inline-block">
                                <button type="submit" name="submitservice" class="btn btn-primary waves-effect waves-light d-inline-block" style="margin-bottom:10px;">Send Email Reminder</button>
                            </form>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>