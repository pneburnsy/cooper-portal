<?php
function survey_table($variable) { ?>
    <div class="table-responsive section-block surveys">
        <table id="datatable-buttons-surveys" class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
            <thead>
            <tr>
                <th scope="col">Survey Sent</th>
                <th scope="col">Status</th>
                <th scope="col">Region</th>
                <th scope="col" class="form_name">Client Details</th>
<!--                <th scope="col" class="form_name">Account</th>-->
                <?php if ( current_user_can( 'administrator' ) ) { ?>
                    <th scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="Names Of The Engineers In Attendance">Engineers</th>
                <?php } ?>
                <th scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="Ease Of Contacting Us">Q1</th>
                <th scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="Customer Service Experience">Q2</th>
                <th scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="Response Time For Attendance">Q3</th>
                <th scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="Engineer Fully Aware Of Reason For Attendance">Q4</th>
                <th scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="Technical Knowledge & Capabilities Of Engineer Who Attended">Q5</th>
                <th scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="Quality Of Service Provided">Q6</th>
                <th scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="Accuracy Of Paperwork">Q7</th>
                <th scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="Lead Time For Parts">Q8</th>
                <th scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="Have We Identified Any Additional Follow Up Work Required?">Q9</th>
                <th scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="The Average From All Questions">Average</th>
                <th scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="Feedback Notes" class="adjust-sorting hide-column-title"></th>
                <th class="hide-sorting form_actions">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($variable); $i++) { ?>

                <?php
                $mediumvalue = array(
                    feedback_number($variable[$i]->q2),
                    feedback_number($variable[$i]->q3),
                    feedback_number($variable[$i]->q4),
                    feedback_number($variable[$i]->q5),
                    feedback_number($variable[$i]->q6),
                    feedback_number($variable[$i]->q7),
                    feedback_number($variable[$i]->q8),
                    feedback_number($variable[$i]->q9)
                );
                //print_r($mediumvalue);
                $mediumresult = round(array_sum($mediumvalue)/count($mediumvalue));
                ?>

                <tr class="<?= $variable[$i]->displayid; ?>">

                    <td class="archived_date">
                        <div><?= formatted_renewal_date($variable[$i]->created); ?></div>
                    </td>

                    <td>
                        <?php if ($variable[$i]->q1) { ?>
                            <span class="submitted">Submitted</span>
                        <?php } else { ?>
                            <span class="not_submitted">Not Submitted</span>
                        <?php } ?>
                    </td>

                    <td class="form_name" data-sort=" <?= $variable[$i]->region; ?>">
                        <?= get_region_flag($variable[$i]->region); ?>
                    </td>

                    <td class="form_name">
                        <span>
                            <a href="mailto:<?= $variable[$i]->clientemail; ?>"><?= $variable[$i]->clientname . ' (' . $variable[$i]->clientemail . ')'; ?></a>
                        </span>
                    </td>

<!--                    <td class="form_name">-->
<!--                        <span>-->
<!--                            <a href="page_accounts_view?displayid=--><?php //= $variable[$i]->clientaccount; ?><!--">--><?php //= $variable[$i]->clientaccount; ?><!--</a>-->
<!--                        </span>-->
<!--                    </td>-->

                    <?php if ( current_user_can( 'administrator' ) ) { ?>
                        <td><?php
                            if ($variable[$i]->q1) {
                                echo str_replace(';', ', ', $variable[$i]->q1);
                            }
                        ?></td>
                    <?php } ?>

                    <td class="<?php feedback_class($variable[$i]->q2); ?>"><span data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $variable[$i]->q2; ?>"></span></td>

                    <td class="<?php feedback_class($variable[$i]->q3); ?>"><span data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $variable[$i]->q3; ?>"></span></td>

                    <td class="<?php feedback_class($variable[$i]->q4); ?>"><span data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $variable[$i]->q4; ?>"></span></td>

                    <td class="<?php feedback_class($variable[$i]->q5); ?>"><span data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $variable[$i]->q5; ?>"></span></td>

                    <td class="<?php feedback_class($variable[$i]->q6); ?>"><span data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $variable[$i]->q6; ?>"></span></td>

                    <td class="<?php feedback_class($variable[$i]->q7); ?>"><span data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $variable[$i]->q7; ?>"></span></td>

                    <td class="<?php feedback_class($variable[$i]->q8); ?>"><span data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $variable[$i]->q8; ?>"></span></td>

                    <td class="<?php feedback_class($variable[$i]->q9); ?>"><span data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $variable[$i]->q9; ?>"></span></td>

                    <td><span><?php echo $variable[$i]->q10; ?></span></td>

                    <td class="<?php feedback_class(feedback_text($mediumresult)); ?> average_feedback"><span><?php echo feedback_text($mediumresult); ?></span></td>

                    <td class="form_name">
                        <?php if (trim($variable[$i]->yourfeedback)) { ?>
                            <span class="notes full" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $variable[$i]->yourfeedback; ?>">
                                <span class="invoice-hide">1</span>i
                            </span>
                        <?php } else { ?>
                            <span class="notes">
                                <span class="invoice-hide">0</span>i
                            </span>
                        <?php } ?>
                    </td>

                    <td class="form_actions" style="text-align: right;">
                        <?php if (current_user_can('administrator')) { ?>
                            <form method="post" class="form-inline">
                                <?php
                                $current_date = formatted_renewal_date(date('Y/m/d'));
                                $current_resend_date = formatted_renewal_date($variable[$i]->resenddate);
                                ?>
                                <button class="btn btn-edit waves-effect waves-light" type="submit" name="resendsurvey" value="<?= $variable[$i]->displayid; ?>" <?php if ($variable[$i]->submitted || $current_date == $current_resend_date) { echo 'disabled'; } ?>>
                                    <i class="mdi mdi-email-sync d-block font-size-16" data-bs-toggle="tooltip" data-bs-placement="top" title="Resend Email"></i>
                                </button>
                            </form>
                        <?php } ?>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="View" class="text-light" href="page_accounts_view?displayid=<?= $variable[$i]->clientaccount; ?>">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">
                                <i class="mdi mdi-eye d-inline-block font-size-16" style="margin-right: 4px;"></i> View Account
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
    <script>document.addEventListener('DOMContentLoaded', setupStickyHeader('datatable-buttons-surveys'));</script>
<?php } ?>