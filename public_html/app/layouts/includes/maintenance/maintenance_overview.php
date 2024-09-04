<div id="overview" class="card dashboard tab-pane <?php if (!$_GET['tab']) { echo 'active'; } ?>" role="tabpanel">

    <div class="row">
        <div class="col-12 col-md-12 col-xl-12">
            <div class="card-body" style="background:#fff;border-radius:10px;padding:0;">

                <div class="form-highlight">
                    <div class="row">
                        <h4 class="col-12 mb-4">Renewal Overview</h4>

                        <div class="col-12 mb-4 renewal_stats">
                            <div class="renewals_column">
                                <strong>Contract ID: </strong>
                                <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $maintenance_view[0]->contract_id; ?></span>
                            </div>
                            <div class="renewals_column">
                                <strong>Per Annum (Hrs): </strong>
                                <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $maintenance_view[0]->hours_per_annum; ?></span>
                            </div>
                        </div>

                        <?php if ( current_user_can( 'administrator' ) ) { ?>

                            <h4 class="col-12 mb-4">Renewal Charges</h4>

                            <div class="col-12 mb-4 renewal_stats">

                                <div class="renewals_column">
                                    <strong>Cost (Monthly): </strong>
                                    <?php if ($maintenance_view[0]->main_cost && $maintenance_view[0]->main_cost != 0) { ?>
                                        <span class="positive_number"><?= '£' . $maintenance_view[0]->main_cost;  ?></span>
                                    <?php } else {
                                        echo '<span class="placeholder">-</span>';
                                    } ?>
                                </div>

                                <div class="renewals_column">
                                    <strong>Cost (Hourly): </strong>
                                    <?php if ($maintenance_view[0]->main_hourly && $maintenance_view[0]->main_hourly != 0) { ?>
                                        <span class="positive_number"><?= '£' . $maintenance_view[0]->main_hourly;  ?></span>
                                    <?php } else {
                                        echo '<span class="placeholder">-</span>';
                                    } ?>
                                </div>

                                <div class="renewals_column">
                                    <strong>Excess Rate (Hrs): </strong>
                                    <?php if ($maintenance_view[0]->excess_charge && $maintenance_view[0]->excess_charge != 0) { ?>
                                        <span class="positive_number"><?= '£' . $maintenance_view[0]->excess_charge;  ?></span>
                                    <?php } else {
                                        echo '<span class="placeholder">-</span>';
                                    } ?>
                                </div>

                                <div class="renewals_column">
                                    <strong>500 Only: </strong>
                                    <?php if ($maintenance_view[0]->only_500 && $maintenance_view[0]->only_500 != 0) { ?>
                                        <span class="positive_number"><?= '£' . $maintenance_view[0]->only_500;  ?></span>
                                    <?php } else {
                                        echo '<span class="placeholder">-</span>';
                                    } ?>
                                </div>

                                <div class="renewals_column">
                                    <strong>1000 Only: </strong>
                                    <?php if ($maintenance_view[0]->only_1000 && $maintenance_view[0]->only_1000 != 0) { ?>
                                        <span class="positive_number"><?= '£' . $maintenance_view[0]->only_1000;  ?></span>
                                    <?php } else {
                                        echo '<span class="placeholder">-</span>';
                                    } ?>
                                </div>

                                <div class="renewals_column">
                                    <strong>2000 Only: </strong>
                                    <?php if ($maintenance_view[0]->only_2000 && $maintenance_view[0]->only_2000 != 0) { ?>
                                        <span class="positive_number"><?= '£' . $maintenance_view[0]->only_2000;  ?></span>
                                    <?php } else {
                                        echo '<span class="placeholder">-</span>';
                                    } ?>
                                </div>

                                <div class="renewals_column">
                                    <strong>3000 Only: </strong>
                                    <?php if ($maintenance_view[0]->only_3000 && $maintenance_view[0]->only_3000 != 0) { ?>
                                        <span class="positive_number"><?= '£' . $maintenance_view[0]->only_3000;  ?></span>
                                    <?php } else {
                                        echo '<span class="placeholder">-</span>';
                                    } ?>
                                </div>

                            </div>

                        <?php } ?>

                        <div class="col-12 mb-4">
                            <div class="progress_container progress_<?= $duestatus ?>">
                                <span class="overview_duedate">
                                    <?php
                                    $dayssince = daydiff($maintenance_view[0]->main_start, get_date_time(strtotime("today")) );
                                    $daysend = daydiff($maintenance_view[0]->main_start, $maintenance_view[0]->main_end);
                                    $daysleft = $daysend - $dayssince;
                                    ?>
                                    <span class="mb-2 d-block">
                                        <h5 class="d-inline-block">Due Date</h5>
                                        <span class="d-inline-block ml-3" style="margin-left: 5px;">
                                            <?php if ($duestatus != 'overdue') { echo abs($daysleft) . ' Day(s) Until Renewal: '; }
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
                                <span class="progress_renewalcreated"><strong>Start Date:</strong> <span><?= formatted_date($maintenance_view[0]->main_start); ?></span></span>
                                <span class="progress_renewaldate"><strong>End Date:</strong> <span><?= formatted_date($maintenance_view[0]->main_end); ?></span></span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php /* ?>
        <div class="col-12 col-md-12 col-xl-4">
            <div class="card-body" style="background:#fff;border-radius:10px;padding:0;">
                <div class="form-highlight">
                    <div class="row">
                        <div>
                            <h4 class="col-12">
                                Notes
                                <a href="/app/page_renewals_view?tab=renewal_settings&displayid=<?= $maintenance_view[0]->displayid ?>" class="note_button btn btn-primary waves-effect waves-light">Edit Note</a>
                            </h4>
                        </div>
                        <div class="col-12">
                            <p class="notes_area mb-0">
                                <?php if ($maintenance_view[0]->renewalnotes) {
                                    echo $maintenance_view[0]->renewalnotes;
                                } else {
                                    echo '<span class="text-light">Add notes... </span>';
                                } ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php */ ?>
    </div>

</div>