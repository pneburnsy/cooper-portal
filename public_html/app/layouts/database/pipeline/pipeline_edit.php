<?php

function pipeline_edit($print) {
    if (isset($_POST['pipeline_edit'])) {
        global $wpdb;

        $table_proposals = $wpdb->prefix . 'pipeline_proposals';

        $displayid = safestring($_GET['displayid']);

        $existing_proposal = $wpdb->get_row(
            $wpdb->prepare("
                SELECT * 
                FROM $table_proposals
                WHERE displayid = %s
            ",
                $displayid)
        );

        if (!$existing_proposal) {
            if ($print) {
                echo "No proposal found with displayid: " . esc_html($displayid);
            }
            return;
        }

        $data = array(
            'name'          => safestring($_POST['name']),
            'desc'          => safestring($_POST['desc']),
            'make'          => safestring($_POST['make']),
            'region'        => safeinteger($_POST['region']),
            'assignee'      => safeinteger($_POST['assignee']),
            'clientaccount' => safestring($_POST['your-company']),
            'priority'      => safeinteger($_POST['priority']),
            'percentage'    => safeinteger($_POST['percentage']),
            'total_quote'   => safefloat($_POST['total_quote']),
            'close_date'    => safestring($_POST['close_date']),
            'updated_date'  => current_time('mysql'),
        );

        $format = array(
            '%s', // Name
            '%s', // Desc
            '%s', // Make
            '%d', // Region
            '%d', // Assignee
            '%s', // Company
            '%d', // Priority
            '%d', // Percentage
            '%f', // Total Quote
            '%s', // Close Date
            '%s', // Updated Date
        );

        $where = array('id' => $existing_proposal->id);
        $where_format = array('%d');

        $proposal_updated = $wpdb->update(
            $table_proposals,
            $data,
            $where,
            $format,
            $where_format
        );

        // ERROR
        if ($proposal_updated === false) {
            if ($print) {
                echo "Error updating proposal: " . esc_html($wpdb->last_error);
                echo "<br>Query: " . esc_html($wpdb->last_query);
            }
            return;
        }


        // SUCCESS MESSAGE
        $_SESSION["Pipeline"] = 'Deal updated successfully.';

        ?><script>window.location.reload();</script><?php
    }
}
