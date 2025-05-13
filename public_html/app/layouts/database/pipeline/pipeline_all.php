<?php

function pipeline_all($print) {
    global $wpdb;
    global $pipeline_id;
    global $pipeline_data;
    global $pipeline_name;
    global $pipeline_count;

    $table_pipelines = $wpdb->prefix . 'pipelines';
    $table_cards     = $wpdb->prefix . 'pipeline_cards';
    $table_columns   = $wpdb->prefix . 'pipeline_columns';
    $table_proposals = $wpdb->prefix . 'pipeline_proposals';

    $pipeline_id = isset($_GET['pipeline_id']) ? intval($_GET['pipeline_id']) : 1;
    $created_from = isset($_GET['created_from']) ? $_GET['created_from'] : null;
    $created_to = isset($_GET['created_to']) ? $_GET['created_to'] : null;
    $account = isset($_GET['account']) ? sanitize_text_field($_GET['account']) : null;
    $make = isset($_GET['make']) ? sanitize_text_field($_GET['make']) : "";

    // Base query
    $query = "
        SELECT c.*, p.creation_date 
        FROM {$table_cards} c
        INNER JOIN {$table_columns} col ON c.column_id = col.id
        INNER JOIN {$table_proposals} p ON c.proposal_id = p.id
        WHERE col.pipeline_id = %d
    ";

    $query_params = [$pipeline_id];

    if ($created_from) {
        $query .= " AND DATE(p.creation_date) >= DATE(%s)";
        $query_params[] = $created_from;
    }

    if ($created_to) {
        $query .= " AND DATE(p.creation_date) <= DATE(%s)";
        $query_params[] = $created_to;
    }

    if ($account) {
        $query .= " AND p.clientaccount = %s";
        $query_params[] = $account;
    }
    
    // Execute query
    $pipeline_data = $wpdb->get_results($wpdb->prepare($query, ...$query_params));

    // Count results
    $pipeline_count = count($pipeline_data);

    // Debugging output if needed
    if ($print == true) {
        echo "<pre>";
        print_r($pipeline_data);
        print_r($pipeline_count);
        echo "</pre>";
    }
}
