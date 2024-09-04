<?php

function team_activestatus($print) {

    // VARIABLES
    global $wpdb;

    if (isset($_POST['team_activestatus'])) {

        query_adminonly();

        // ASSIGN VARIABLES
        $this_displayid = $_POST['team_activestatus'];
        $this_userid = other_convert_displayid($this_displayid);
        $this_activestatus = other_active_status($this_userid);
        $redirect = safestring($_POST['redirect']);

        // RESULT
        if ($this_activestatus == 1) {
            $metas = array(
                'active_status' => 0
            );
            foreach($metas as $key => $value) {
                update_user_meta( $this_userid, $key, $value );
            }
        } elseif ($this_activestatus == 0) {
            $metas = array(
                'active_status' => 1
            );
            foreach($metas as $key => $value) {
                update_user_meta( $this_userid, $key, $value );
            }
        }

        // SESSION
        $_SESSION["message"] = 'Account status updated.';
        ?><script>window.location.href = "profile<?php if ($redirect) { echo '?tab=' . $redirect; } ?>";</script><?php

    }

    // DEBUGGING
    if ($print == true) {
        print_r($this_activestatus);
    }

}
