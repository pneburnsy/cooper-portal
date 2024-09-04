<?php

function service_team_table_hours($print){
    global $wpdb;
    global $table_name;
    $table = $table_name['service_hours'];
    // ------ VARIABLES ------
    $servicedisplayid = safestring($_GET['displayid']);
    // ------ QUERY ------
    global $service_team_table_hours;
    $service_team_table_hours = $wpdb->get_results($wpdb->prepare("
        SELECT * FROM `$table` 
        WHERE servicedisplayid = %s AND status <> 1
        ORDER BY submission_year ASC, CAST(submission_week AS SIGNED);
    ",
    // ARGUMENTS
    $servicedisplayid
    ));
    // ------ BUG CHECKING ------
    if ($print == true) {
        print_r($service_team_table_hours);
    }
}

function service_team_table_hours_delete($print) {
    if (isset($_POST['service_hours_bin']) && isset($_POST['history_delete_previousdate']) && isset($_POST['history_delete_previoushours']) ) {

        global $wpdb;
        global $table_name;
        // ------------------ QUERY UPDATE HOURS ------------------
        $table = $table_name['service_hours'];
        $data = array(
            // Column => Value
            'status' => '1',
        );
        $format = array(
            // Format
            '%d',
        );
        $where = array(
            'displayid' => safestring($_POST['service_hours_bin']),
            'servicedisplayid' => safestring($_GET['displayid'])
        );
        // ------ QUERY ------
        $service_team_table_hours_delete = $wpdb->update($table, $data, $where, $format);
        // ------------------ QUERY UPDATE PARENT ------------------
        $table = $table_name['service'];
        $dataparent = array(
            // Column => Value
            'lastest_odo_date' => safestring($_POST['history_delete_previousdate']),
            'lastest_odo_hours' => safeinteger($_POST['history_delete_previoushours']),
        );
        $formatparent = array(
            // Format
            '%s',
            '%d',
        );
        $whereparent = array(
            'displayid' => safestring($_GET['displayid'])
        );
        // ------ QUERY ------
        $service_team_table_hours_update_parent = $wpdb->update($table, $dataparent, $whereparent, $formatparent);

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($service_team_table_hours_delete);
            print_r($service_team_table_hours_update_parent);
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Account"] = 'Service hours updated.';
        ?><script>window.location.href = "page_service_contract_view?tab=service_hours_history&displayid=<?= $_GET['displayid']?>";</script><?php

    } elseif (isset($_POST['service_hours_bin'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['service_hours'];
        // ------------------ QUERY ------------------
        $data = array(
            // Column => Value
            'status' => '1',
        );
        $format = array(
            // Format
            '%d',
        );
        $where = array(
            'displayid' => safestring($_POST['service_hours_bin']),
            'servicedisplayid' => safestring($_GET['displayid'])
        );
        // ------ QUERY ------
        $service_team_table_hours_delete = $wpdb->update($table, $data, $where, $format);
        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($service_team_table_hours_delete);
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Account"] = 'Service hours updated.';
        ?><script>window.location.href = "page_service_contract_view?tab=service_hours_history&displayid=<?= $_GET['displayid']?>";</script><?php

    }
}