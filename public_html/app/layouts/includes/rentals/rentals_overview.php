<div id="overview" class="card dashboard tab-pane <?php if (!$_GET['tab']) { echo 'active'; } ?>" role="tabpanel">

    <div class="row">
        <div class="col-12 col-md-12 col-xl-12">
            <div class="card-body" style="background:#fff;border-radius:10px;padding:0;">

                <div class="form-highlight">
                    <div class="row">
                        <h4 class="col-12 mb-4">Rentals Overview</h4>

                        <?php if ( current_user_can( 'administrator' ) ) { ?>
                            <div class="col-12 mb-2 renewal_stats">
                                <h6 class="col-12 mb-4">Contract Finance</h6>
                                <div class="renewals_column">
                                    <strong>Contract Reference: </strong>
                                    <span class=" text-muted font-size-13" style="margin-left: 3px;"><?php if ($rentals_view[0]->contract_reference) { echo $rentals_view[0]->contract_reference; } else { echo '-'; } ?></span>
                                </div>
                                <div class="renewals_column">
                                    <strong>Contract Hours: </strong>
                                    <span class=" text-muted font-size-13" style="margin-left: 3px;"><?php if ($rentals_view[0]->contract_hours) { echo $rentals_view[0]->contract_hours; } else { echo '-'; } ?></span>
                                </div>
                                <div class="renewals_column">
                                    <strong>Rent Rate (Weekly): </strong>
                                    <span class=" text-muted font-size-13" style="margin-left: 3px;"><?php if ($rentals_view[0]->rent_rate) { echo '<span class="positive_number">£' . $rentals_view[0]->rent_rate . '</span>'; } else { echo '-'; } ?></span>
                                </div>
                                <div class="renewals_column">
                                    <strong>Excess Rate (Hrs): </strong>
                                    <span class=" text-muted font-size-13" style="margin-left: 3px;"><?php if ($rentals_view[0]->excess_rate) { echo '<span class="positive_number">£' . $rentals_view[0]->excess_rate . '</span>'; } else { echo '-'; } ?></span>
                                </div>
                                <div class="renewals_column">
                                    <strong>Excess Min Charge: </strong>
                                    <span class=" text-muted font-size-13" style="margin-left: 3px;"><?php if ($rentals_view[0]->excess_rate_min) { echo '<span class="positive_number">£' . $rentals_view[0]->excess_rate_min . '</span>'; } else { echo '-'; } ?></span>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="col-12 mb-4 renewal_stats">
                            <div class="renewals_column_notes">
                                <strong class="mb-2 d-block">Notes: </strong>
                                <span class="text-muted font-size-13 d-block"><?php if ($rentals_view[0]->notes) { echo $rentals_view[0]->notes; } else { echo '<span class="placeholder">No comments.</span>'; } ?></span>
                            </div>
                        </div>

                        <?php if ($rentals_view[0]->hire_start || $rentals_view[0]->hire_end) { ?>
                            <div class="col-12 mb-4">
                                <div class="progress_container progress_<?= $duestatus ?>">
                                    <span class="overview_duedate">
                                        <?php
                                        $dayssince = daydiff($rentals_view[0]->hire_start, get_date_time(strtotime("today")) );
                                        $daysend = daydiff($rentals_view[0]->hire_start, $rentals_view[0]->hire_end);
                                        $daysleft = $daysend - $dayssince;
                                        ?>
                                        <span class="mb-2 d-block">
                                            <h5 class="d-inline-block">Due Date</h5>
                                            <span class="d-inline-block ml-3" style="margin-left: 5px;">
                                                <?php if ($rentals_view[0]->hire_start && $rentals_view[0]->hire_end) { ?>
                                                    <?php if ($duestatus != 'overdue') { echo abs($daysleft) . ' Day(s) Until Renewal: '; }
                                                    else { echo abs($daysleft) . ' Day(s) Overdue'; }?>
                                                <?php } ?>
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
                                                 style="width: <?php if ($duestatus != 'overdue' && $rentals_view[0]->hire_start && $rentals_view[0]->hire_end) { echo $dayssince / $daysend * 100; } else { echo '100'; } ?>%;">
                                            </div>
                                        </div>
                                    </div>
                                    <span class="progress_renewalcreated"><strong>Hire Started:</strong> <span><?php if ($rentals_view[0]->hire_start) { echo formatted_date($rentals_view[0]->hire_start); } else { echo 'No Start Date'; } ?></span></span>
                                    <span class="progress_renewaldate"><strong>Hire Ended:</strong> <span><?php if ($rentals_view[0]->hire_end) { echo formatted_date($rentals_view[0]->hire_end); } else { echo 'No End Date'; } ?></span></span>
                                </div>
                            </div>
                        <?php } ?>

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
                                <a href="/app/page_renewals_view?tab=renewal_settings&displayid=<?= $rentals_view[0]->displayid ?>" class="note_button btn btn-primary waves-effect waves-light">Edit Note</a>
                            </h4>
                        </div>
                        <div class="col-12">
                            <p class="notes_area mb-0">
                                <?php if ($rentals_view[0]->renewalnotes) {
                                    echo $rentals_view[0]->renewalnotes;
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