<?php

function pipeline_move($print) {

    global $wpdb;

    if (isset($_POST['pipeline_move'])) {

        $card_id       = isset($_POST['card_id']) ? intval($_POST['card_id']) : 0;
        $target_column = isset($_POST['target_column']) ? intval($_POST['target_column']) : 0;
        if ($card_id && $target_column) {
            $table_cards = $wpdb->prefix . 'pipeline_cards';
            $pipeline_move = $wpdb->update(
                $table_cards,
                ['column_id' => $target_column],
                ['id' => $card_id],
                ['%d'],
                ['%d']
            );
        }

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($pipeline_move);
        }

    }

}