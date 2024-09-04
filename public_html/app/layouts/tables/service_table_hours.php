<?php
function service_table_hours($variable) { ?>

    <div class="table-responsive section-block">
        <table id="datatable-buttons-service-hours" class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
            <thead>
                <tr>
                    <th scope="col" class="hide-sorting">Completion Week</th>
                    <th scope="col" class="hide-sorting">Completion Date</th>
                    <th scope="col" class="hide-sorting">Submitted By (User)</th>
                    <th scope="col" class="hide-sorting">Previous ODO Reading (Hrs)</th>
                    <th scope="col" class="hide-sorting">New ODO Reading (Hrs)</th>
                    <th scope="col" class="hide-sorting">Usage (Hrs)</th>
                    <th scope="col" class="hide-sorting">Status</th>
                    <th scope="col" class="hide-sorting">Service Type (Hrs)</th>
                    <th scope="col" class="hide-sorting">Creation On (Date)</th>
                    <?php if (doif_coopereditoronly_query()) { ?>
                        <th class="hide-sorting form_actions">Actions</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($variable); $i++) { ?>

                <?php
                if ($i == 0)  {
                    global $service_view;
                    $previous_week = $service_view[0]->starting_hours;
                }
                ?>

                <tr class="<?= $variable[$i]->displayid; ?>" data-sort="<?= $i ?>">

                    <td class="form_name" data-sort="<?= $i ?>">
                        <?= $variable[$i]->submission_week . ' (' . $variable[$i]->submission_year . ')'; ?>
                    </td>

                    <td class="archived_date" data-sort="<?= $variable[$i]->submission_date; ?>">
                        <?php if ($variable[$i]->submission_date) { ?>
                        <div><?= formatted_renewal_date($variable[$i]->submission_date); ?></div>
                        <?php } ?>
                    </td>

                    <td class="table_profile">
                        <?php $online_date = online_status_true($variable[$i]->userid); ?>
                        <span class="table-image" data-bs-toggle="tooltip" data-bs-placement="top"
                              title="<?= other_user_fullname($variable[$i]->userid) . ' (Currently: ' . $online_date[1] . ')'; ?>">
                            <?php if (other_user_profile_picture($variable[$i]->userid)) { ?>
                                <img height="22" width="22" class="profile-image-active-tiny"
                                     src="<?= other_user_profile_picture($variable[$i]->userid); ?>">
                            <?php } else {
                                ?><span class="table-name"><?php
                                echo other_user_firstname($variable[$i]->userid)[0] . other_user_lastname($variable[$i]->userid)[0];
                                ?></span><?php
                            } ?>
                            <span style="font-size:0px;visbility:hidden;"><?= other_user_fullname($variable[$i]->userid); ?></span>
                        </span>
                    </td>

                    <td>
                        <?= $previous_week . ' Hrs'?>
                    </td>


                    <td>
                        <?php

                            if ($variable[$i]->odo_reading && $i != 0) {
                                echo $variable[$i]->odo_reading . ' Hrs';
                                $current_value = $variable[$i]->odo_reading;
                            } else {
                                echo $previous_week . ' Hrs';
                                $current_value = $previous_week;
                            }

                       ?>
                    </td>

                    <td>
                        <span class="positive_number"><?= $current_value - $previous_week . ' Hrs'?></span>
                    </td>

                    <td>
                        <?php
                        switch ($variable[$i]->type) {

                            case "1":
                                echo 'Service Complete (First Service)';
                                break;

                            case "2":
                                echo 'Service Complete';
                                break;

                            case "7":
                                echo 'Service Scheduled';
                                break;
                                
                            case "8":
                                echo 'Service Scheduled (Deleted)';
                                break;

                            default:
                                echo '-';
                                break;

                        }
                        ?>
                    </td>

                    <td>
                       <?php if ($variable[$i]->typedata) { echo $variable[$i]->typedata; } else { echo '-'; }?>
                    </td>

                    <td class="form_name creation_date" data-sort="<?= $variable[$i]->creation_date; ?>">
                        <span><?= formatted_renewal_date($variable[$i]->creation_date); ?></span>
                    </td>

                    <?php if ( current_user_can('administrator') ) { ?>
                        <td class="form_actions" style="text-align: right;">

                            <?php $j = $i - 1; //previous history log ?>
                            <?php $k = $i + 1; //next history log ?>
                            <?php /*
                            <button id="history_edit_data_<?= $i ?>" min_date="<?= $variable[$j]->submission_date ?>" max_date="<?= $variable[$k]->submission_date ?>" min_hours="<?= $variable[$j]->odo_reading ?>" max_hours="<?= $variable[$k]->odo_reading ?>"  data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="btn btn-edit waves-effect waves-light" type="submit">
                                <i class="mdi mdi-pencil d-block font-size-16"></i>
                            </button>
                            */ ?>

                            <?php if ($variable[$i]->type == 0 ) { ?>
                                <form method="post" class="form-inline">
                                    <button id="history_delete_data_<?= $i ?>" class="btn btn-danger waves-effect waves-light" type="submit" name="service_hours_bin" value="<?= $variable[$i]->displayid; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                        <i class="mdi mdi-trash-can d-block font-size-16"></i>
                                    </button>
                                    <?php if (count($variable) == $k) { ?>
                                        <input type="hidden" name="history_delete_previousdate" value="<?= $variable[$j]->submission_date ?>">
                                        <input type="hidden" name="history_delete_previoushours" value="<?= $variable[$j]->odo_reading ?>">
                                    <?php } ?>
                                </form>
                            <?php } else { ?>
                                <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Cannot Delete Service Log">
                                    <button class="btn btn-danger waves-effect waves-light" type="submit" name="service_hours_bin_disabled" value="<?= $variable[$i]->displayid; ?>" style="background-color: #9e9e9e;" disabled>
                                        <i class="mdi mdi-trash-can d-block font-size-16"></i>
                                    </button>
                                </div>
                            <?php } ?>

                        </td>
                    <?php } ?>

                    <?php
                    if ($variable[$i]->odo_reading) {
                        $previous_week = $variable[$i]->odo_reading;
                    }
                    ?>

                </tr>

            <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- SCROLLING TABLE HEAD JS -->
    <script src="assets/js/pages/scrolling_thead.js"></script>
    <script>document.addEventListener('DOMContentLoaded', setupStickyHeader('datatable-buttons-service-hours'));</script>
<?php } ?>