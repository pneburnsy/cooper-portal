<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");

// SECURITY
include 'layouts/security.php';

// HEADER
$page = 'Your Holidays';
include 'layouts/header.php';
include 'layouts/page_title.php';

// IMPORT QUERIES
doif_cooperonly(true);

?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<?php

include 'layouts/includes/holidays/holidays_apicall.php';

?><style><?php
    include 'bootstrap.css';
?></style><?php

// Get current user email
$current_user = wp_get_current_user();
?><div class="row"><?php
    // Create blank emails array
    $emails = [];
    $doesnotexist = array();

    for ($x = 0; $x < count($resultfinal); $x++) {
        // Display only current users data
        if ($current_user->user_email == $resultfinal[$x]['email']) {

            // If archived
            if ($resultfinal[$x]['isArchived']) {
                ?><div class="disabled">This account has been archived in Timetastic. Please contact <?= $adminall ?> for this to be resolved.</div><?php
            }
            // If not archived
            else {
                ?>

                <?php
                if ( isset($_POST['submit']) ) {
                    // --- API START ---

                    // Pull form values
                    $from = $_POST['from'];
                    $to = $_POST['to'];
                    $fromtime = $_POST['fromtime'];
                    $totime = $_POST['totime'];
                    $reason = $_POST['message'];

                    // Request a holiday
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "https://app.timetastic.co.uk/api/holidays");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

                    $headerspost = [
                        "Authorization: Bearer d82ed028-0b6f-4715-8c07-0d880a961a9d",
                        "Content-Type: application/json"
                    ];
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headerspost);

                    $fields = array (
                        "from" => date('Y-m-d', strtotime($from)),
                        "to" => date('Y-m-d', strtotime($to)),
                        "fromTime" => $fromtime,
                        "toTime" => $totime,
                        "leaveTypeId" => 371516,
                        "reason" => $reason,
                        "userOrDepartmentId" => $resultfinal[$x]['id'],
                        "bookFor" => 0,
                        "suppressEmails" => false,
                        "override" => true,
                        "bookAsRequestee" => true,
                        "overrideLockedDays" => true
                    );
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

                    $request = curl_exec($ch);

                    //var_dump(json_decode($request));

                    curl_close($ch);

                    // --- API END ---

                    /*
                    "from": "2018-12-20",
                    "to": "2018-12-20",
                    "fromTime": "AM",
                    "toTime": "PM",
                    "leaveTypeId": 57942,
                    "reason": "Testing the API",
                    "userOrDepartmentId": 146599,
                    "bookFor": 0,
                    "suppressEmails": false,
                    "override": true,
                    "bookAsRequestee": true,
                    "overrideLockedDays": true}'
                    );
                    */

                    $array = (array) json_decode($request);
                    if ($array['response']) {
                        ?><div class="col-md-12 mb-3">
                            <span class="form_submitted"><?php echo 'Holiday Request Submitted (' . $array['response'] . ').';  ?></span>
                        </div><?php
                    }

                }
                ?>

                <div class="col-xl-4 col-md-12">

                    <div class="card card-form-size profile">
                        <div class="team-body">
                            <div class="team_icon"><?php echo $resultfinal[$x]['userInitials']; ?></div>
                            <div class="team_member">
                                <?php
                                echo '<p class="name">' . '<span class="top">Welcome back...</span> ' . '<span class="bottom">' . $resultfinal[$x]['firstname'] . ' ' . $resultfinal[$x]['surname'] . '</span>' . '</p>';
                                echo '<p class="department">' . '<strong class="top">Department:</strong> ' . '<span class="bottom">' . $resultfinal[$x]['departmentName'] . '</span>' . '</p>';
                                $date = $resultfinal[$x]['startDate'];
                                echo '<p class="startdate">' . '<strong class="top">Started:</strong> '; if ($resultfinal[$x]['startDate']) { echo date('d/m/Y', strtotime($date)); } else { echo '<span style="opacity:0.4;">Unknown</span>'; } echo '</p>';
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="card card-form-size days <?php if ($resultfinal[$x]['allowanceRemaining'] < 7) { echo 'orange'; } elseif ($resultfinal[$x]['allowanceRemaining'] == 0) { echo 'red'; } ?>">
                        <div class="team-body">
                            <div>
                                <?php
                                echo '<span class="top">' . $resultfinal[$x]['allowanceRemaining'] . ' / ' . $resultfinal[$x]['currentYearAllowance'] . '</span>' . '<span class="bottom">Days Remaining</span>';
                                ?>
                            </div>
                        </div>
                    </div>
                    <p class="disclaimer">If your allocation of holidays is incorrect for <?php echo date('Y'); ?>, please contact your department manager. All holidays reset in January.</p>
                </div>
                <?php

                ?>
                <div class="col-xl-8 col-md-12">

                    <div class="card  holidays">
                        <div class="card-header">
                            <strong>Your Holidays</strong>
                        </div>
                        <div class="card-body">
                            <?php

                            // --- API START ---

                            include 'layouts/includes/holidays/holidays_list_apicall.php';

                            // --- API END ---

                            /*
                              ?><pre><?php
                              print_r( $holidaysfinal );
                              ?></pre><?php
                            */

                            ?>

                            <?php // Future ?>
                            <p class="past_title"><strong>Holidays Planned</strong></p>
                            <table>
                                <thead>
                                <tr class="head">
                                    <th class="hol-1" scope="col">Status</th>
                                    <th class="hol-2" scope="col">Start Date</th>
                                    <th class="hol-3" scope="col">End Date</th>
                                    <th class="hol-4" scope="col">Working Days</th>
                                </tr>
                                </thead>
                                <?php
                                $shownodata = true;
                                foreach($holidaysfinal['holidays'] as $theresult) {
                                    $datenow = date("Y-m-d");
                                    $dateresult = (date('Y-m-d', strtotime($theresult['startDate'])));
                                    if ($resultfinal[$x]['id'] == $theresult['userId']  && $datenow <= $dateresult) {
                                        ?>
                                        <tr class="holiday_<?php echo $x; ?>">
                                            <td class="hol-1">
                                                <span class="status <?php if ($theresult['leaveType'] == 'Holiday' && $theresult['status'] == 'Approved') { echo 'approved'; } elseif ($theresult['leaveType'] !== 'Holiday' || $theresult['leaveType'] !== 'Pending') { echo 'misc'; } ?>"><?php echo $theresult['leaveType'] . ' (' . $theresult['status'] . ')'; ?></span>
                                            </td>
                                            <td class="hol-2">
                                                <?php echo date('D d F Y', strtotime($theresult['startDate'])); if ($theresult['startType']) { echo ' ('. $theresult['startType'] . ')'; } ?>
                                            </td>
                                            <td class="hol-3">
                                                <?php echo date('D d F Y', strtotime($theresult['endDate'])); if ($theresult['startType']) { echo ' (' . $theresult['endType'] . ')'; }?>
                                            </td>
                                            <td class="hol-4">
                                                <?php if ($theresult['deduction'] != 0) {
                                                    echo $theresult['deduction'] . ' Days';
                                                } else {
                                                    echo '- Days';
                                                } ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $shownodata = false;
                                    }
                                }
                                if ($shownodata) {
                                    ?><tr><td colspan="4" style="text-align:center;">You haven't planed any holidays this year yet.</td></tr><?php
                                }
                                ?>
                            </table>

                            <?php // Past ?>
                            <p class="past_title"><strong>Holidays Taken</strong></p>
                            <table>
                                <thead>
                                <tr class="head">
                                    <th class="hol-1" scope="col">Status</th>
                                    <th class="hol-2" scope="col">Start Date</th>
                                    <th class="hol-3" scope="col">End Date</th>
                                    <th class="hol-4" scope="col">Working Days</th>
                                </tr>
                                </thead>
                                <?php
                                $shownodata = true;

                                /* ?><pre><?php print_r($holidaysfinal); ?></pre><?php */

                                $i = 0;

                                foreach($holidaysfinal['holidays'] as $theresult) {
                                    $datenow = date("Y-m-d");
                                    $dateresult = (date('Y-m-d', strtotime($theresult['startDate'])));
                                    $dateresultyear = (date('Y', strtotime($theresult['startDate'])));

                                    /*
                                    if ($i == 0) {
                                        echo date("Y");
                                        echo $dateresultyear;
                                    }
                                    */
                                    $i++;

                                    if (date("Y") == $dateresultyear) {
                                        if ($resultfinal[$x]['id'] == $theresult['userId'] && $datenow > $dateresult) {
                                            ?>
                                            <tr class="holiday_<?php echo $x; ?>">
                                                <td class="hol-1">
                                                    <span class="status <?php if ($theresult['leaveType'] == 'Holiday' && $theresult['status'] == 'Approved') { echo 'approved'; } elseif ($theresult['leaveType'] !== 'Holiday' || $theresult['leaveType'] !== 'Pending') { echo 'misc'; } ?>"><?php echo $theresult['leaveType'] . ' (' . $theresult['status'] . ')'; ?></span>
                                                </td>
                                                <td class="hol-2">
                                                    <?php echo date('d F Y (D)', strtotime($theresult['startDate'])); ?>
                                                </td>
                                                <td class="hol-3">
                                                    <?php echo date('d F Y (D)', strtotime($theresult['endDate'])); ?>
                                                </td>
                                                <td class="hol-4">
                                                    <?php if ($theresult['deduction'] != 0) {
                                                        echo $theresult['deduction'] . ' Days';
                                                    } else {
                                                        echo '- Days';
                                                    } ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $shownodata = false;
                                        }

                                    }
                                }
                                if ($shownodata) {
                                    ?><tr><td colspan="4" style="text-align:center;">You haven't taken any holidays this year yet.</td></tr><?php
                                }
                                ?>
                            </table>

                        </div>
                    </div>

                    <div class="card  request">
                        <div class="card-header">
                            <strong>Request Holidays</strong>
                        </div>
                        <div class="card-body">
                            <?php
                            if ( isset($_POST['submit']) ) {

                                if ($array['response']) {
                                    ?><span class="form_submitted"><?php echo 'Holiday Request Submitted (' . $array['response'] . ').';  ?></span><?php
                                }

                            }
                            ?>
                            <form class="row" method="post">

                                <div class="col-xl-6 col-md-12">
                                    <label for="from" class="modal_label" >Start Date *</label>
                                    <input name="from" type="date" class="modal_input" id="from">
                                    <select name="fromtime" id="fromtime">
                                        <option value="AM">Morning</option>
                                        <option value="PM">Afternoon</option>
                                    </select>
                                </div>
                                <div class="col-xl-6 col-md-12">
                                    <label for="to" class="modal_label" >End Date *</label>
                                    <input name="to" type="date" class="modal_input" id="to">
                                    <select name="totime" id="totime">
                                        <option value="PM">End of Day</option>
                                        <option value="AM">Lunch Time</option>
                                    </select>
                                </div>
                                <div class="col-xl-12 col-md-12">
                                    <label for="message" class="modal_label" >Message</label>
                                    <input name="message" type="textarea" maxlength="100" class="modal_input" id="message">
                                    <p class="disclaimer" style="text-align: left;">Once submitted, ensure the holiday is listed above under 'your holidays' with the status pending. Holidays will be marked as approved when your department manager has reviewed your holidays. Max 100 character.</p>

                                    <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">Submit Request</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card  calendar">
                        <div class="card-header">
                            <strong>Team Holiday Calendar</strong>
                        </div>
                        <div class="card-body">
                            <?php
                                // INCLUDE CAL JS, CSS AND CALL
                                include 'layouts/functions/calendar.php';
                                /* ?><pre><?php print_r($holidaysfinal['holidays']); ?></pre><?php */
                            ?>
                            <div id='calendar'></div>
                            <p class="disclaimer">This calendar can take some time to update, please check back later if any recent holiday requests aren't showing yet. For developer purposes, this calendar is maxed at 500 API calls, there is currently <?= count($holidaysfinal['holidays']); ?> in use.</p>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
    for ($j = 0; $j < count($resultfinal); $j++) {
        if ($current_user->user_email == $resultfinal[$j]['email']) {
            array_push($doesnotexist, 'true');
            //echo 'true';
        } else {
            array_push($doesnotexist, 'false');
            //echo 'false';
        }
    }
    if ( !in_array('true', $doesnotexist) ) {
        ?><div class="col-xl-12 col-md-12 cooper_access_denied" style="margin: 0 10px;width: calc(100% - 20px);">
            <span class="disabled text-center">There is currently no Timetastic account linked to this user. Please contact <?= $adminall ?> for this to be resolved.</span>
        </div><?php
    }

?>

<?php /* ---------------- END - PAGE ---------------- */ ?>

<?php

// FOOTER
include 'layouts/footer.php';

?>
