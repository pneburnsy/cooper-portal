<?php

// Load WordPress
require("../../wp-load.php");

header('Content-Type: application/json; charset=utf-8');

$card_id = isset($_POST['card_id']) ? intval($_POST['card_id']) : 0;

if (!$card_id) {
    echo json_encode(['success' => false, 'message' => 'Invalid card ID']);
    exit;
}

global $wpdb;

// Table names
$table_cards = $wpdb->prefix . 'pipeline_cards';
$table_proposals = $wpdb->prefix . 'pipeline_proposals';

try {
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

    // Success response
    echo json_encode(['success' => true, 'message' => 'Card and associated proposal deleted successfully']);
} catch (Exception $e) {
    // Error response
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

exit;

?>
