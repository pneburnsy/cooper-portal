<?php

function notes_weekly_select($print) {
    if ( doif_cooperonly_query() ) {

        global $wpdb;
        global $table_name;
        $table = $table_name['notes'];

        $current_user_id = get_current_user_id();

        $is_admin = current_user_can('administrator');

        $url_date = isset($_GET['date']) ? sanitize_text_field($_GET['date']) : current_time('Y-m-d');

        $url_date_converted = DateTime::createFromFormat('Y-m-d', $url_date);

        if (!$url_date_converted) {
            $url_date_converted = new DateTime(current_time('Y-m-d'));
        }

        $formatted_date = $url_date_converted->format('Y-m-d');

        $start_of_week = clone $url_date_converted;
        $start_of_week->modify('monday this week');
        $start_of_week = $start_of_week->format('Y-m-d');

        $end_of_week = clone $url_date_converted;
        $end_of_week->modify('sunday this week');
        $end_of_week = $end_of_week->format('Y-m-d');

        $sql = "
            SELECT * FROM `$table`
            WHERE status IN (0, 1)
              AND reminder_date BETWEEN %s AND %s
        ";

        $params = array($start_of_week, $end_of_week);

        if ($is_admin) {
            if (isset($_GET['user'])) {
                $user_param = sanitize_text_field($_GET['user']);

                if (strtolower($user_param) === 'all') {
                    // Admin wants to view all users' notes; no additional WHERE clause
                } elseif (is_numeric($user_param)) {
                    // Admin wants to view a specific user's notes
                    $specific_user_id = intval($user_param);

                    // Validate that the user ID exists
                    if (get_user_by('id', $specific_user_id)) {
                        $sql .= " AND userid = %d";
                        $params[] = $specific_user_id;
                    } else {
                        $sql .= " AND userid = %d";
                        $params[] = $current_user_id;
                    }
                } else {
                    $sql .= " AND userid = %d";
                    $params[] = $current_user_id;
                }
            } else {
                $sql .= " AND userid = %d";
                $params[] = $current_user_id;
            }
        } else {
            $sql .= " AND userid = %d";
            $params[] = $current_user_id;
        }

        $prepared_sql = $wpdb->prepare($sql, ...$params);

        global $notes_weekly_select;
        $notes_weekly_select = $wpdb->get_results($prepared_sql);

        if ($print == true) {
            echo '<pre>';
            print_r($notes_weekly_select);
            echo '</pre>';
        }
    }
}
