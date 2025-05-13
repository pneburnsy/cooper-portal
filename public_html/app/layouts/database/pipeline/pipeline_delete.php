<?php

function pipeline_delete($print) {
    if (isset($_POST['pipeline_delete'])) {
        global $wpdb;

        // Table names
        $table_cards = $wpdb->prefix . 'pipeline_cards';
        $table_proposals = $wpdb->prefix . 'pipeline_proposals';

        $card_id = intval($_POST['pipeline_delete']);
        $redirect_url = ''; // Initialize the redirect URL

        try {
            $pipeline_id = $wpdb->get_var(
                $wpdb->prepare("
                    SELECT col.pipeline_id 
                    FROM $table_cards c
                    INNER JOIN {$wpdb->prefix}pipeline_columns col 
                    ON c.column_id = col.id 
                    WHERE c.id = %d", $card_id)
            );

            $proposal_id = $wpdb->get_var(
                $wpdb->prepare("SELECT proposal_id FROM $table_cards WHERE id = %d", $card_id)
            );

            if ($proposal_id) {
                $deleted_proposal = $wpdb->delete($table_proposals, ['id' => $proposal_id], ['%d']);
                if ($deleted_proposal === false) {
                    throw new Exception('Failed to delete proposal from ae_pipeline_proposals');
                }
            }

            $deleted_card = $wpdb->delete($table_cards, ['id' => $card_id], ['%d']);
            if ($deleted_card === false) {
                throw new Exception('Failed to delete card from pipeline_cards');
            }

            if ($pipeline_id) {
                $redirect_url = "/app/page_pipeline.php?pipeline_id=" . $pipeline_id;
            }

            // Success message
            $_SESSION["Pipeline"] = 'Card and associated proposal deleted successfully.';

            if ($redirect_url) {
                echo "<script>window.location.href = '$redirect_url';</script>";
                exit;
            }
        } catch (Exception $e) {
            // Error message
            $_SESSION["Pipeline"] = 'Error: ' . $e->getMessage();
        }

        if ($print == true) {
            echo "<pre>";
            print_r($card_id);
            echo $wpdb->last_error;
            echo "</pre>";
        }
    }
}
