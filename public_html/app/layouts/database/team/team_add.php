<?php

function team_add($print) {

    // VARIABLES
    global $wpdb;
    $teamid = current_user_teamid();
    $displayid = guid();
    $date = get_date_time('Y-m-d H:i:s');

    if (isset($_POST['team_add'])) {

        query_adminonly();

        // ASSIGN VARIABLES
        $team_email = safeemail($_POST['team_email']);
        $team_firstname = safestring($_POST['team_firstname']);
        $team_lastname = safestring($_POST['team_lastname']);
        $team_fullname = safestring($team_firstname) . ' ' . safestring($team_lastname);
        $team_username = safestring($_POST['team_username']);
        $team_password = safestring($_POST['team_password']);
        $team_role = safeinteger($_POST['team_role']);
        if ($team_role >= 3) {
          $team_role = 0;
        }
        $redirect = safestring($_POST['redirect']);
        // CREATE TEAM MEMBER
        if (username_exists($team_username) == null && email_exists($team_email) == false) {
            $userdata = array(
                'user_login' => $team_username,
                'user_pass' => $team_password,
                'user_email' => $team_email,
                'first_name' => $team_firstname,
                'last_name' => $team_lastname,
                'display_name' => $team_fullname,
                'role' => 'subscriber'
            );
            $newuser = wp_insert_user( $userdata );
            if ( !is_wp_error( $newuser ) ) {
                $metas = array(
                    'teamid' => $teamid,
                    'teamrole' => $team_role,
                    'displayid' => $displayid,
                    'online_status' => '',
                    'active_status' => 1,
                    'profile_picture_url' => '',
                    'phone' => ''
                );
                foreach($metas as $key => $value) {
                    update_user_meta( $newuser, $key, $value );
                }
            }
            // OUTPUT
            if ($_POST['team_emailcheck'] || $_POST['team_emailcheck'] == 'checked') {
                include 'emails/team_newuser.php';
            }
            $_SESSION["Team"] = 'New team member added.';
        }
        elseif (username_exists($team_username) == true && email_exists($team_email) == true) {
            $_SESSION["Team"] = 'Error: Username and Email already in use.';
        }
        elseif (username_exists($team_username) == true) {
            $_SESSION["Team"] = 'Error: Username already in use.';
        }
        elseif (email_exists($team_email) == true) {
            $_SESSION["Team"] = 'Error: Email already in use.';
        }
        else {
            $_SESSION["Team"] = 'Error: Unknown, please contact support.';
        }
        ?><script>window.location.href = "profile<?php if ($redirect) { echo '?tab=' . $redirect; } ?>";</script><?php
    }

    // DEBUGGING
    if ($print == true) {
        print_r($newuser);
    }

}

//%d (integer)
//%f (float)
//%s (string)
