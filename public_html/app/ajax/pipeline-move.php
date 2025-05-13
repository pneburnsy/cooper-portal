<?php




// Load WordPress
require("../../wp-load.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

// JSON response header
header('Content-Type: application/json; charset=utf-8');

$card_id       = isset($_POST['card_id']) ? (int)$_POST['card_id'] : 0;
$target_column = isset($_POST['target_column']) ? (int)$_POST['target_column'] : 0;

$completed_date = isset($_POST['completed_date']) ? sanitize_text_field($_POST['completed_date']) : '';
if ($completed_date === '') {
    $completed_date = null;
}

if (!$card_id || !$target_column) {
    echo json_encode(['success' => false, 'message' => 'Missing parameters']);
    exit;
}

global $wpdb;

// Database Names
$table_cards = $wpdb->prefix . 'pipeline_cards';
$table_proposals = $wpdb->prefix . 'pipeline_proposals';
$table_columns = $wpdb->prefix . 'pipeline_columns';

try {
    $updatedCard = $wpdb->update(
        $table_cards,
        ['column_id' => $target_column],
        ['id' => $card_id],
        ['%d'],
        ['%d']
    );

    if ($updatedCard === false) {
        throw new Exception('Failed to update column_id in pipeline_cards');
    }

    $proposal_id = $wpdb->get_var(
        $wpdb->prepare("SELECT proposal_id FROM $table_cards WHERE id = %d", $card_id)
    );

    if (!$proposal_id) {
        throw new Exception('No proposal found for the given card_id');
    }

    $column_name = $wpdb->get_var(
        $wpdb->prepare("SELECT name FROM $table_columns WHERE id = %d", $target_column)
    );

    if (!$column_name) {
        throw new Exception('No column found for the given target_column');
    }

    $status = 0; // Default (Open)
    if (stripos($column_name, 'completed') !== false) {
        $status = 1; // Completed
    } elseif (stripos($column_name, 'lost') !== false) {
        $status = 2; // Lost
    }

    $updatedProposal = $wpdb->update(
        $table_proposals,
        [
            'status'         => $status,
            'status_date'    => current_time('mysql'),
            'completed_date' => $completed_date,
        ],
        ['id' => $proposal_id],
        ['%d', '%s', '%s'],
        ['%d']
    );
    
    if ($updatedProposal === false) {
        throw new Exception('Failed to update status in pipeline_proposals');
    }

    // Return success response
    echo json_encode(['success' => true, 'message' => 'Card and status updated successfully']);
} catch (Exception $e) {
    // Return error response
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
exit;
