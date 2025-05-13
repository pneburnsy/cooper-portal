<?php
function pipeline_add($print) {
    if (isset($_POST['pipeline_add'])) {
        global $wpdb;

        // Table names
        $table_proposals = $wpdb->prefix . 'pipeline_proposals';
        $table_cards = $wpdb->prefix . 'pipeline_cards';

        $proposal_displayid = guid();

        // Sanitize POST data
        $data = array(
            'user_id'      => safeinteger(current_user_id()),
            'displayid'    => safestring($proposal_displayid),
            'make'         => safestring($_POST['make']),
            'region'       => safeinteger($_POST['region']),
            'assignee'     => safeinteger($_POST['assignee']),
            'clientaccount'=> safestring($_POST['your-company']),
            'name'         => safestring($_POST['name']),
            'desc'         => safestring($_POST['desc']),
            'priority'     => safeinteger($_POST['priority']),
            'percentage'   => safeinteger($_POST['percentage']),
            'total_quote'  => safefloat($_POST['total_quote']),
            'close_date'   => safestring($_POST['close_date']),
            'creation_date'=> current_time('mysql'),
            'updated_date' => current_time('mysql'),
        );

        $format = array(
            '%d',  // userid
            '%s',  // displayid
            '%s',  // make
            '%d',  // region
            '%d',  // assignee
            '%s',  // clientaccount
            '%s',  // name
            '%s',  // desc
            '%d',  // priority
            '%d',  // percentage
            '%f',  // total_quote
            '%s',  // close_date
            '%s',  // creation_date
            '%s',  // updated_date
        );

        $proposal_added = $wpdb->insert($table_proposals, $data, $format);

        if ($proposal_added === false) {
            if ($print == true) {
                echo "Error inserting into proposals table: " . $wpdb->last_error;
                echo "<br>Query: " . $wpdb->last_query;
            }
            return;
        }

        $proposal_id = $wpdb->insert_id;

        // Column ID
        $pipeline_id = isset($_GET['pipeline_id']) ? intval($_GET['pipeline_id']) : 1;
        $column_mapping = [
            1 => 1,
            2 => 20,
            3 => 40,
        ];
        $column_id = isset($column_mapping[$pipeline_id]) ? $column_mapping[$pipeline_id] : 1;

        $card_data = array(
            'proposal_id'  => $proposal_id,
            'column_id'    => $column_id,
            'creation_date'=> current_time('mysql'),
            'updated_date' => current_time('mysql'),
        );

        $card_format = array('%d', '%d', '%s', '%s');
        $card_added = $wpdb->insert($table_cards, $card_data, $card_format);

        if ($card_added === false) {
            if ($print == true) {
                echo "Error inserting into cards table: " . $wpdb->last_error;
                echo "<br>Query: " . $wpdb->last_query;
            }
            return;
        }

        // Debugging output if requested
        if ($print == true) {
            echo "Proposal Added: " . $proposal_added;
            echo "<br>Card Added: " . $card_added;
        }

        // Success message and reload
        $_SESSION["Pipeline"] = 'Deal added successfully.';
//        ?><!--<script>window.location.reload();</script>--><?php
    }
}
?>
