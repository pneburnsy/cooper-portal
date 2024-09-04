<?php

function notes_week($print) {

    if ( doif_cooperonly_query() ) {

        global $wpdb;
        global $table_name;
        $table = $table_name['notes'];

        $current_user_id = get_current_user_id();

        $today = current_time('Y-m-d');
        $one_week_later = date('Y-m-d', strtotime('+1 weeks'));

        // ------ QUERY ------
        global $notes_week;
        $notes_week = $wpdb->get_results($wpdb->prepare("
                SELECT * FROM `$table`
                WHERE userid = %d
                AND reminder_date BETWEEN %s AND %s
            ", $current_user_id, $today, $one_week_later)
        );

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($notes_week);
        }

        // ------ MESSAGE/ACTION ------
        // NONE
    }
}
?>