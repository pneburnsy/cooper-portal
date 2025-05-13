<?php
function notes_add($print){
    if (isset($_POST['notes_add'])) {
        global $wpdb;
        global $table_name;
        $table = $table_name['notes'];
        // ------ VARIABLES ------
        $displayid = isset($_GET['displayid']) ? sanitize_text_field($_GET['displayid']) : '';
        $allowed_html = array(
            'a' => array(
                'href' => array(),
                'title' => array()
            ),
            'b' => array(),
            'strong' => array(),
            'i' => array(),
            'em' => array(),
            'ul' => array(),
            'ol' => array(),
            'li' => array(),
            'p' => array(),
            'br' => array(),
        );
        $location = isset($_POST['location']) ? safeinteger($_POST['location']) : 1;

        // ------ POST/GET (SANITIZE) ------
        $data = array(
            // Column => Value
            'location' => safeinteger($location),
            'displayid' => safestring($displayid),
            'userid' => safeinteger(current_user_id()),
            'type' => safeinteger($_POST['note_type']),
            'note' => wp_kses($_POST['note'], $allowed_html),
        );
        $format = array(
            // Format
            '%d',
            '%s',
            '%d',
            '%d',
            '%s',
        );
        // ------ QUERY ------
        $notes_add = $wpdb->insert($table, $data, $format);
        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($notes_add);
        }
        // ------ MESSAGE/ACTION ------
        $_SESSION["Notes"] = 'Note Created.';
        ?><script>window.location.reload();</script><?php
    }
}

function notes_reminder_add($print){
    if (isset($_POST['notes_reminder_add'])) {
        global $wpdb;
        global $table_name;
        $table = $table_name['notes'];
        // ------ VARIABLES ------
        $displayid = isset($_GET['displayid']) ? sanitize_text_field($_GET['displayid']) : '';
        $allowed_html = array(
            'a' => array(
                'href' => array(),
                'title' => array()
            ),
            'b' => array(),
            'strong' => array(),
            'i' => array(),
            'em' => array(),
            'ul' => array(),
            'ol' => array(),
            'li' => array(),
            'p' => array(),
            'br' => array(),
        );
        $location = isset($_POST['location']) ? safeinteger($_POST['location']) : 1;

        // ------ POST/GET (SANITIZE) ------
        $data = array(
            // Column => Value
            'location' => safeinteger($location),
            'displayid' => safestring($displayid),
            'userid' => safeinteger($_POST['reminder_userid']),
            'creation_userid' => safeinteger(current_user_id()),
            'type' => safeinteger(9), //DEFAULT FOR REMINDER
            'reminder_type' => safeinteger($_POST['reminder_type']),
            'reminder_time' => safestring($_POST['reminder_time']),
            'reminder_date' => safestring($_POST['reminder_date']),
            'note' => wp_kses($_POST['reminder_note'], $allowed_html),
        );
        $format = array(
            // Format
            '%d',
            '%s',
            '%d',
            '%d',
            '%d',
            '%s',
            '%s',
            '%s',
            '%s',
        );
        // ------ QUERY ------
        $notes_reminder_add = $wpdb->insert($table, $data, $format);
        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($notes_reminder_add);
        }
        // ------ MESSAGE/ACTION ------
        $_SESSION["Notes"] = 'Reminder Created.';
        ?><script>window.location.reload();</script><?php
    }
}