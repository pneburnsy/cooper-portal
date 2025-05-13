<?php

function pipeline_view($print) {

    global $wpdb;
    $table_cards = $wpdb->prefix . 'pipeline_proposals';

    // ------ POST/GET (SANITIZE) ------
    $displayid = isset($_GET['displayid']) ? sanitize_text_field($_GET['displayid']) : null;

    if (!$displayid) {
        if ($print) {
            echo "No displayid provided.";
        }
        return;
    }

    // ------ QUERY ------
    global $pipeline_view;
    $pipeline_view = $wpdb->get_results($wpdb->prepare("
            SELECT * FROM `$table_cards` 
            WHERE displayid = %s
        ",
        // ARGUMENTS
        $displayid
    ));

    // ------ BUG CHECKING ------
    if ($print) {
        print_r($pipeline_view);
    }

    // ------ MESSAGE/ACTION ------
    // NONE
}
?>
