<?php

function team_profileupdate($print) {

    // VARIABLES
    global $wpdb;
    $userid = current_user_id();
    $userpassword = current_user_password();

    if (isset($_POST['team_profileupdate'])) {

        // ASSIGN VARIABLES
        $team_firstname = safestring($_POST['team_firstname']);
        $team_lastname = safestring($_POST['team_lastname']);
        $team_fullname = safestring($team_firstname) . ' ' . safestring($team_lastname);
        $current_password = safestring($_POST['team_current_password']);
        $team_new_password = safestring($_POST['team_new_password']);
        $team_new_password_confirm = safestring($_POST['team_new_password_confirm']);

        // UPDATE TEAM MEMBER
        $metas = array(
            'first_name' => $team_firstname,
            'last_name' => $team_lastname,
            'display_name' => $team_fullname
        );
        foreach($metas as $key => $value) {
            update_user_meta( $userid, $key, $value );
        }
        $_SESSION["Team"] = 'Profile Successfully Updated.';

        // PASSWORD UPDATE
        if ( $current_password && $team_new_password && $team_new_password_confirm ) {
            if ($team_new_password == $team_new_password_confirm) {
                if (wp_check_password($current_password, $userpassword, $userid)) {
                    $_SESSION["Team"] = 'Profile Successfully Updated.';
                    wp_set_password($team_new_password, $userid);
                } else {
                    $_SESSION["Team"] = 'Your current password is incorrect.';
                }
            } else {
                $_SESSION["Team"] = 'New passwords do not match.';
            }
        } elseif ( $current_password || $team_new_password || $team_new_password_confirm ) {
            $_SESSION["Team"] = 'Please fill in all password inputs.';
        } else {
            $error = 'Bug: Password Failure.';
        }

        // OUTPUT
        ?><script>window.location.reload();</script><?php

    }

    // DEBUGGING
    if ($print == true) {
        $_SESSION["Team"] = $error;
    }

}

//%d (integer)
//%f (float)
//%s (string)
