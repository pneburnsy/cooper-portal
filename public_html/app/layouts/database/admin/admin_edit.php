<?php
function admin_edit($print){
    if (isset($_POST['admin_edit'])) {
        global $wpdb;
        global $table_name;
        $table = $table_name['admin'];
        // ------ VARIABLES ------
        if ($_POST['admin_maintenance'] == 'checked') {
            $admin_maintenance = 1;
        } else {
            $admin_maintenance = 0;
        }
        if ($_POST['admin_message'] == 'checked') {
            $admin_message = 1;
        } else {
            $admin_message = 0;
        }
        // ------ POST/GET (SANITIZE) ------
        $data = array(
            // Column => Value
            'maintenanceswitch' => $admin_maintenance,
            'message' => safestring($_POST['message']),
            'messageswitch' => $admin_message,
            'messageurl' => safeurl($_POST['messageurl']),
            'adminname' => safestring($_POST['adminname']),
            'adminemail' => safeemail($_POST['adminemail']),
            'portaladminemail' => safestring($_POST['portaladminemail']),
            'portaladminemployee' => safestring($_POST['portaladminemployee']),
        );
        $where = array(
            'uid' => safeinteger(1),
        );
        $format = array(
            // Format
            '%d',
            '%s',
            '%d',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
        );
        // ------ QUERY ------
        $admin_edit = $wpdb->update($table, $data, $where, $format);
        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($admin_edit);
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Admin Settings"] = 'Settings updated.';
        ?><script>window.location.reload();</script><?php
    }
}