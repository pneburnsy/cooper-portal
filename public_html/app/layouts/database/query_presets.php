<?php

/* ---- START - GLOBAL DATABASE NAMES ---- */

// PREFIX
$prefix = $wpdb->prefix;

// TABLE NAMES
$table_name = array(
    application => $prefix . 'application',
    whitelabel => $prefix . 'whitelabel',
    accounts => $prefix . 'accounts',
    survey => $prefix . 'survey',
    admin => $prefix . 'admin_options',
    rentals => $prefix . 'rental_equipment',
    thorough_examinations => $prefix . 'thorough_examinations',
    maintenance => $prefix . 'maintenance',
    service => $prefix . 'service',
    service_hours => $prefix . 'service_hours',
    notes => $prefix . 'notes',
    permissions => $prefix . 'permissions',
    regions => $prefix . 'regions',
    pipeline => $prefix . 'pipeline'
);

/* ---- END - GLOBAL DATABASE NAMES ---- */



/* ---- START - GLOBAL DATABASE PREPARES ---- */

// ADD PREPARE QUERY
function prepare_add($data) {
    // Format Query and Value
    $insert_query = array();
    $insert_value = array();
    foreach ($data as $query => $value) {
        array_push($insert_query, $query);
        array_push($insert_value, $value);
    }
    // Prepare Query
    global $query;
    $query = "";
    for ($i = 0; $i < count($insert_query); $i++) {
        if ($i != count($insert_query) - 1) {
            $query .= $insert_query[$i] . ", ";
        } else {
            $query .= $insert_query[$i];
        }
    }
    // print_r($query);
    // Prepare Value
    global $value;
    $value = "";
    for ($x = 0; $x < count($insert_value); $x++) {
        if ($x != count($insert_value) - 1) {
            $value .=  "'" . $insert_value[$x] . "', ";
        } else {
            $value .=  "'" .$insert_value[$x] . "'";
        }
    }
    // print_r($value);
}

/* ---- END - GLOBAL DATABASE PREPARES ---- */



/* ---- START - GLOBAL DATABASE QUERIES ---- */

// TEAM
include 'team/team_view.php';
include 'team/team_add.php';
include 'team/team_delete.php';
include 'team/team_passwordreset.php';
include 'team/team_profileupdate.php';
include 'team/team_profilepictureupdate.php';
include 'team/team_activestatus.php';

// STATUS
include 'status/online_status.php';

// MENU
include 'menu/menu_applications_all.php';
include 'menu/menu_applications_add.php';
include 'menu/menu_applications_edit.php';
include 'menu/menu_applications_delete.php';

// CONTACTS
include 'contacts/contacts_add.php';
include 'contacts/contacts_view.php';
include 'contacts/contacts_edit.php';
include 'contacts/contacts_status.php';

// PIPELINE
include 'pipeline/pipeline_all.php';
include 'pipeline/pipeline_view.php';
include 'pipeline/pipeline_edit.php';
include 'pipeline/pipeline_move.php';
include 'pipeline/pipeline_add.php';
include 'pipeline/pipeline_delete.php';

// PERMISSIONS
include 'permissions/permissions_edit.php';
include 'permissions/permissions_regions_edit.php';
include 'permissions/permissions_all.php';
include 'permissions/permissions_regions_all.php';
include 'permissions/permissions_single.php';
include 'permissions/permissions_regions_single.php';

// ACCOUNTS
include 'accounts/accounts_team_all.php';
include 'accounts/accounts_team_view.php';
include 'accounts/accounts_team_add.php';
include 'accounts/accounts_team_edit.php';
include 'accounts/accounts_team_delete.php';

include 'accounts/widgets/accounts_team_count.php';
include 'accounts/widgets/accounts_team_single.php';
include 'accounts/widgets/accounts_team_distinct.php';
include 'accounts/widgets/accounts_team_surveys.php';
include 'accounts/widgets/accounts_team_maintenance.php';
include 'accounts/widgets/accounts_team_rentals.php';
include 'accounts/widgets/accounts_team_service_contracts.php';
include 'accounts/widgets/accounts_team_exam.php';
include 'accounts/widgets/accounts_team_user.php';

// SURVEY
include 'survey/survey_all.php';
include 'survey/survey_send.php';
include 'survey/survey_resend.php';
include 'survey/survey_single.php';

include 'survey/widgets/survey_count.php';

// MAINTENANCE
include 'maintenance/maintenance_all.php';
include 'maintenance/maintenance_view.php';
include 'maintenance/maintenance_add.php';
include 'maintenance/maintenance_edit.php';
include 'maintenance/maintenance_actions.php';

include 'maintenance/widgets/maintenance_count.php';

// RENTALS
include 'rentals/rentals_all.php';
include 'rentals/rentals_view.php';
include 'rentals/rentals_edit.php';
include 'rentals/rentals_reset.php';
include 'rentals/rentals_history.php';

include 'rentals/widgets/rentals_count.php';
include 'rentals/widgets/rentals_history_count.php';

// THOROUGH EXAMINATIONS
include 'thorough_examinations/exam_all.php';
include 'thorough_examinations/exam_view.php';
include 'thorough_examinations/exam_add.php';
include 'thorough_examinations/exam_edit.php';
include 'thorough_examinations/exam_actions.php';

include 'thorough_examinations/widgets/exam_count.php';

// SERVICES
include 'service/service_all.php';
include 'service/service_send.php';
include 'service/service_view.php';
include 'service/service_edit.php';
include 'service/service_add.php';
include 'service/service_actions.php';
include 'service/service_hour_submission_clientform.php';
include 'service/service_settings_edit.php';
include 'service/service_submissions.php';
include 'service/service_schedule.php';
include 'service/service_schedule_delete.php';

include 'service/widgets/service_hours.php';
include 'service/widgets/service_count.php';

// ADMIN
include 'admin/admin_edit.php';
include 'admin/admin_all_users.php';
include 'admin/admin_travel.php';

// OVERDUE COUNTS
include 'overdue/overdue_menu.php';

// WHITE LABEL
include 'whitelabel/whitelabel_edit.php';
include 'whitelabel/whitelabel_single.php';

// NOTES
include 'notes/notes_all.php';
include 'notes/notes_week.php';
include 'notes/notes_view.php';
include 'notes/notes_add.php';
include 'notes/notes_delete.php';
include 'notes/notes_complete.php';
include 'notes/notes_weekly_select.php';

/* ---- END - GLOBAL DATABASE QUERIES ---- */
