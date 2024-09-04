<?php

function team_passwordreset($print) {

    // VARIABLES
    global $wpdb;

    if (isset($_POST['team_passwordreset'])) {

        query_adminonly();

        // ASSIGN VARIABLES
        $this_newpassword = safestring($_POST['team_newpassword']);
        $this_displayid = $_POST['team_passwordreset'];
        $this_userid = other_convert_displayid($this_displayid);
        $redirect = safestring($_POST['redirect']);

        // RESULT
        if ( !in_array("administrator", $this_userid) ) {
            $password = wp_set_password($this_newpassword, $this_userid);
        }
        else {
            $_SESSION["Team"] = 'Error: This user is a site admin.';
            exit;
            ?><script>window.location.reload();</script><?php
        }
        if ($_POST['team_emailcheck'] || $_POST['team_emailcheck'] == 'checked') {
            include 'emails/team_passwordreset.php';
        }
        // SESSION
        $_SESSION["Team"] = 'Password Updated.';
        ?><script>window.location.href = "profile?tab=teammembers";</script><?php

    }

    // DEBUGGING
    if ($print == true) {
        print_r($password);
    }

}
