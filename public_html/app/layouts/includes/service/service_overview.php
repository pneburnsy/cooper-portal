<div id="overview" class="card dashboard tab-pane <?php if (!$_GET['tab']) { echo 'active'; } ?>" role="tabpanel">

    <div class="row">
        <div class="col-12 col-md-12 col-xl-12">
            <div class="card-body" style="background:#fff;border-radius:10px;padding:0;">

                <div class="form-highlight">
                    <div class="row">

                        <div class="col-lg-6 col-sm-12 mb-4 renewal_stats">
                            <h4 class="col-12 mb-4">Latest ODO Data</h4>
                            <div class="renewals_column">
                                <strong>Latest ODO (Hrs): </strong>
                                <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $service_view[0]->lastest_odo_hours; ?></span>
                            </div>
                            <div class="renewals_column">
                                <strong>Latest ODO Date: </strong>
                                <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= formatted_renewal_date($service_view[0]->lastest_odo_date); ?></span>
                            </div>
                            <div class="renewals_column">
                                <strong>Due In (Hrs): </strong>
                                <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $service_view[0]->serviceduein; ?></span>
                            </div>
                            <div class="renewals_column">
                                <strong>Due By (Date): </strong>
                                <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= formatted_renewal_date($service_view[0]->due_odo_date); ?></span>
                            </div>
                        </div>

                        <?php if ( current_user_can( 'administrator' ) ) { ?>

                            <div class="col-lg-6 col-sm-12 mb-4 renewal_stats">
                                <h4 class="col-12 mb-4">Last Service</h4>
                                <div class="renewals_column">
                                    <strong>Last Service ODO (Hrs): </strong>
                                    <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $service_view[0]->last_odo_hours; ?></span>
                                </div>
                                <div class="renewals_column">
                                    <strong>Last Service Date: </strong>
                                    <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= formatted_renewal_date($service_view[0]->last_odo_date); ?></span>
                                </div>

                            </div>

                        <?php } ?>

                        <h4 class="col-12 mb-4">Service Contract Status</h4>
                        <div class="col-lg-6 col-sm-12 mb-4">
                            <?php
                            $hourstart = $service_view[0]->last_odo_hours;
                            $hourmax = $service_view[0]->last_odo_hours + $service_view[0]->serviceduein;
                            $hourcurrent = $service_view[0]->lastest_odo_hours;
                            $hoursleft = $hourmax - $hourcurrent;
                            $hourstotal = $hourmax - $hourstart;
                            $hoursused = $hourstotal - $hoursleft;
                            // STATUS
                            $percentage_hours = $hoursused / $hourstotal * 100;
                            if ($percentage_hours >= 100) {
                                $duestatus = 'overdue';
                                $duename = 'Service Overdue';
                            } elseif ($percentage_hours >= 90) {
                                $duestatus = 'duesoon';
                                $duename = 'Due Soon';
                            } else {
                                $duestatus = 'notdue';
                                $duename = 'Not Due';
                            }
                            ?>
                            <div class="progress_container progress_<?= $duestatus ?>">
                                <span class="overview_duedate">
                                    <span class="mb-2 d-block">
                                        <h5 class="d-inline-block">Due In</h5>
                                        <span class="d-inline-block ml-3" style="margin-left: 5px;">
                                            <?php if ($duestatus != 'overdue') { echo abs($hoursleft) . ' Hours(s)'; }
                                            else { echo abs($hoursleft) . ' Hours(s) Overdue'; }?>
                                        </span>
                                    </span>
                                    <?php if (renewal_is_uncompleted()) { ?>
                                        <span class="<?= $duestatus ?>">
                                            <span class="renewal"><?= $duename ?></span>
                                        </span>
                                    <?php } ?>
                                </span>
                                <div>
                                    <div class="progress animated-progess mb-3">
                                        <div class="progress-bar bg-info" role="progressbar"
                                             aria-valuenow="<?= $hoursused ?>"
                                             aria-valuemin="<?= $hourstart ?>"
                                             aria-valuemax="<?= $hourstotal ?>>"
                                             style="width: <?php if ($duestatus != 'overdue') { echo $hoursused / $hourstotal * 100; } else { echo '100'; } ?>%;">
                                        </div>
                                    </div>
                                </div>
                                <span class="progress_renewalcreated"><strong>Start (Hrs):</strong> <span><?= $hourstart; ?></span></span>
                                <span class="progress_renewaldate"><strong>End (Hrs):</strong> <span><?= $hourmax; ?></span></span>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12 mb-4">
                            <?php
                            $service_view_end = date('Y-m-d', strtotime($service_view[0]->due_odo_date));
                            $dayssince = daydiff($service_view[0]->last_odo_date, get_date_time(strtotime("today")) );
                            $daysend = daydiff($service_view[0]->last_odo_date, $service_view_end);
                            $daysleft = $daysend - $dayssince;
                            // STATUS
                            $percentage_days = $dayssince / $daysend * 100;
                            if ($percentage_days >= 100) {
                                $duestatus = 'overdue';
                                $duename = 'Service Overdue';
                            } elseif ($percentage_days >= 90) {
                                $duestatus = 'duesoon';
                                $duename = 'Due Soon';
                            } else {
                                $duestatus = 'notdue';
                                $duename = 'Not Due';
                            }
                            ?>
                            <div class="progress_container progress_<?= $duestatus ?>">
                                <span class="overview_duedate">
                                    <span class="mb-2 d-block">
                                        <h5 class="d-inline-block">Due In</h5>
                                        <span class="d-inline-block ml-3" style="margin-left: 5px;">
                                            <?php if ($duestatus != 'overdue') { echo abs($daysleft) . ' Day(s)'; }
                                            else { echo abs($daysleft) . ' Day(s) Overdue'; }?>
                                        </span>
                                    </span>
                                    <?php if (renewal_is_uncompleted()) { ?>
                                        <span class="<?= $duestatus ?>">
                                            <span class="renewal"><?= $duename ?></span>
                                        </span>
                                    <?php } ?>
                                </span>
                                <div>
                                    <div class="progress animated-progess mb-3">
                                        <div class="progress-bar bg-info" role="progressbar"
                                             aria-valuenow="<?= $dayssince ?>"
                                             aria-valuemin="0"
                                             aria-valuemax="<?= $daysend ?>>"
                                             style="width: <?php if ($duestatus != 'overdue') { echo $dayssince / $daysend * 100; } else { echo '100'; } ?>%;">
                                        </div>
                                    </div>
                                </div>
                                <span class="progress_renewalcreated"><strong>Start Date:</strong> <span><?= formatted_date($service_view[0]->last_odo_date); ?></span></span>
                                <span class="progress_renewaldate"><strong>End Date:</strong> <span><?= formatted_date($service_view_end); ?></span></span>
                            </div>
                        </div>

                        <h4 class="col-12 mb-4">Equipment Location</h4>
                        <div style="border-radius: 10px;overflow: hidden;border: 0;">
                            <iframe src="https://maps.google.co.uk/maps?&q=<?php echo $service_view[0]->postcode;?>&aq=&g=<?php echo $service_view[0]->postcode;?>&ie=UTF8&hq=&hnear=<?php echo $service_view[0]->postcode;?>&z=13&output=embed" width="100%" height="600" style="border-radius:10px;overflow:hidden;border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>