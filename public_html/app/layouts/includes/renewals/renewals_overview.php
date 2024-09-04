<div id="overview" class="card dashboard tab-pane <?php if (!$_GET['tab']) { echo 'active'; } ?>" role="tabpanel">

    <div class="row">
        <div class="col-12 col-md-12 col-xl-12">
            <div class="card-body" style="background:#fff;border-radius:10px;padding:0;">

                <div class="form-highlight">
                    <div class="row">
                        <h4 class="col-12 mb-4">Renewal Overview</h4>

                        <div class="col-12 mb-4 renewal_stats">
                            <div class="renewals_column">
                                <strong>Hour Reading: </strong>
                                <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $exam_view[0]->hour_reading; ?></span>
                            </div>
                            <div class="renewals_column">
                                <strong>Record Number: </strong>
                                <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $exam_view[0]->record_number; ?></span>
                            </div>
                            <div class="renewals_column">
                                <strong>Issuing Company: </strong>
                                <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $exam_view[0]->issuing_company; ?></span>
                            </div>
                            <div class="renewals_column">
                                <strong>Issue Date: </strong>
                                <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= formatted_date($exam_view[0]->issue_date); ?></span>
                            </div>
                            <div class="renewals_column">
                                <strong>Expiry Date: </strong>
                                <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= formatted_date($exam_view[0]->expiry_date); ?></span>
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <div class="progress_container progress_<?= $duestatus ?>">
                                <span class="overview_duedate">
                                    <?php
                                    $dayssince = daydiff($exam_view[0]->creation_date, get_date_time(strtotime("today")) );
                                    $daysend = daydiff($exam_view[0]->creation_date, $exam_view[0]->renewal_date);
                                    $daysleft = $dayssince - $daysend;
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
                                <span class="progress_renewalcreated"><strong>Date Created:</strong> <span><?= formatted_date($exam_view[0]->creation_date); ?></span></span>
                                <span class="progress_renewaldate"><strong>Renewal Date:</strong> <span><?= formatted_date($exam_view[0]->renewal_date); ?></span></span>
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
                                <a href="/app/page_renewals_view?tab=renewal_settings&displayid=<?= $exam_view[0]->displayid ?>" class="note_button btn btn-primary waves-effect waves-light">Edit Note</a>
                            </h4>
                        </div>
                        <div class="col-12">
                            <p class="notes_area mb-0">
                                <?php if ($exam_view[0]->renewalnotes) {
                                    echo $exam_view[0]->renewalnotes;
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