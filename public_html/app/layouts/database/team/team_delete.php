<?php

function team_delete($print) {

    // VARIABLES
    global $wpdb;

    if (isset($_POST['team_delete'])) {

        query_adminonly();

        // ASSIGN VARRIABLES
        $this_displayid = $_POST['team_delete'];
        $this_userid = other_convert_displayid($this_displayid);
        $redirect = safestring($_POST['redirect']);

        // RESULT
        if ( !in_array("administrator", $this_userid) ) {
            // Delete User metadata
            $wpdb->delete($wpdb->usermeta, ['user_id' => $this_userid], ['%d']);
            // Delete User
            $wpdb->delete($wpdb->users, ['ID' => $this_userid], ['%d']);
        }
        else {
            $_SESSION["Team"] = 'Error: This user is a site admin.';
            exit;
            ?><script>window.location.reload();</script><?php
        }

        // SESSION
        $_SESSION["Team"] = 'Team member deleted.';
        ?><script>window.location.href = "profile<?php if ($redirect) { echo '?tab=' . $redirect; } ?>";</script><?php

    }

    // DEBUGGING
    if ($print == true) {
        print_r($value);
    }

}

//%d (integer)
//%f (float)
//%s (string)
