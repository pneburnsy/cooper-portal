<?php

// --- API START ---
include 'layouts/includes/holidays/holidays_apicall.php';
// --- API END ---

// Get current user email
$current_user = wp_get_current_user();
$doesnotexist = array();

?>

<div class="col-xl-4 col-md-12">
    <div class="card card-form-size profile">
        <div class="team-body">
            <?php
            for ($x = 0; $x < count($resultfinal); $x++) {
                // Display only current users data
                if ($current_user->user_email == $resultfinal[$x]['email']) {

                    // If archived
                    if ($resultfinal[$x]['isArchived']) {
                        ?><div class="disabled">This account has been archived in Timetastic. Please contact your department manager for this to be resolved.</div><?php
                    }
                    // If not archived
                    else { ?>
                        <div class="team_icon"><?php echo $resultfinal[$x]['userInitials']; ?></div>
                        <div class="team_member">
                            <?php
                            echo '<p class="name">' . '<span class="top">Welcome back...</span> ' . '<span class="bottom">' . $resultfinal[$x]['firstname'] . ' ' . $resultfinal[$x]['surname'] . '</span>' . '</p>';
                            echo '<p class="department">' . '<strong class="top">Department:</strong> ' . '<span class="bottom">' . $resultfinal[$x]['departmentName'] . '</span>' . '</p>';
                            $date = $resultfinal[$x]['startDate'];
                            echo '<p class="startdate">' . '<strong class="top">Started:</strong> '; if ($resultfinal[$x]['startDate']) { echo date('d/m/Y', strtotime($date)); } else { echo '<span style="opacity:0.4;">Unknown</span>'; } echo '</p>';
                            ?>
                        </div>
                        <div class="card card-form-size days mt-4 mb-0 <?php if ($resultfinal[$x]['allowanceRemaining'] < 7) { echo 'orange'; } elseif ($resultfinal[$x]['allowanceRemaining'] == 0) { echo 'red'; } ?>">
                            <div class="team-body">
                                <div>
                                    <?php
                                    echo '<span class="top">' . $resultfinal[$x]['allowanceRemaining'] . ' / ' . $resultfinal[$x]['currentYearAllowance'] . '</span>' . '<span class="bottom">Days Remaining</span>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php }
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
                ?><div class="cooper_access_denied">
                    <div class="team_icon"><?php echo $current_user->first_name[0] . $current_user->last_name[0]; ?></div>
                    <p class="name">
                        <span class="top">Welcome back...</span>
                        <span class="bottom"><?= $current_user->first_name . ' ' . $current_user->last_name ?></span>
                    </p>
                    <span class="disabled text-center">There is currently no Timetastic account linked to this user. Please contact your department manager for this to be resolved.</span>
                </div><?php
            }
            ?>
        </div>
    </div>
</div>