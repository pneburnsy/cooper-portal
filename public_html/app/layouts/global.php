<?php

// VARIABLES
$site_title = 'Cooper Portal';
$userid = get_current_user_id();

// FUNCTIONS
include 'functions/sanitize.php';
include 'functions/tooltips.php';
include 'functions/guid.php';
include 'functions/date.php';
include 'functions/currency.php';
include 'functions/view_page_back.php';
include 'functions/form_clear_storage.php';
include 'functions/rand_color.php';
include 'functions/team_functions.php';
include 'functions/renewals_functions.php';
include 'functions/service_functions.php';
include 'functions/adjustbrightness.php';
include 'functions/feedback_class.php';
include 'functions/cleanwebsiteurl.php';
include 'functions/service_submissions.php';

// QUERIES
include 'database/query_presets.php';

// TABLES
include 'tables/accounts_table.php';
include 'tables/survey_table.php';
include 'tables/user_table.php';
include 'tables/maintenance_table.php';
include 'tables/rentals_table.php';
include 'tables/rentals_history_table.php';
include 'tables/thorough_examinations_table.php';
include 'tables/service_table.php';
include 'tables/service_table_hours.php';

// ADMIN CONTACTS
$admintable = $wpdb->prefix . 'admin_options';
$admincontact = $wpdb->get_results("SELECT * FROM $admintable WHERE uid = 1");
$adminname = $admincontact[0]->adminname;
$adminemail = $admincontact[0]->adminemail;
$adminall = $admincontact[0]->adminname . ' (<a href="mailto:' . $admincontact[0]->adminemail . '">' . $admincontact[0]->adminemail . '</a>)';

// ONLINE STATUS
online_status();

// ADMIN GENERATE DISPLAYIDS
if (current_user_can('administrator')) {
    $generate_displayid = get_users();
    foreach ($generate_displayid as $user) {
        $user_id = $user->ID;
        $displayid_value = get_user_meta($user_id, 'displayid', true);
        if (empty($displayid_value)) {
            $randomid = guid();
            update_user_meta($user_id, 'displayid', $randomid);
        }
    }
}