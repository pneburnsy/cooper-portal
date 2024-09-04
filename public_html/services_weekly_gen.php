<?php

if ($_SERVER['REMOTE_ADDR'] != $_SERVER['SERVER_ADDR']) {
    exit("Unauthorized access.");
}

/*
 * -------------------------- CRON JOB --------------------------
 *
 * DESCRIPTIONS
 * Weekly CRON job for Service Contracts - handles creating and messaging users for all service contract entries.
 *
 * FUNCTIONS
 * - Email Fleet Manager weekly for all new ODO submissions.
 *
 */

// --------- SECURITY ---------
//$passcode = 'HSADC7HBJ3RE76SDVGYSFVGHSD64Q3G7364923U4GVRBWUESFC';
//if ($_GET['passcode'] != $passcode) {
//    exit;
//}

require_once( 'wp-load.php' );
global $wpdb;
include 'app/layouts/functions/team_functions.php';


// TABLES
$table_service = $wpdb->prefix . 'service';
$table_accounts = $wpdb->prefix . 'accounts';


// DATES
$currentWeekNumber = date('W');
$currentYear = date('Y');
$currentDate = date('Y-m-d H-i-s');


// GET UNIQUE ACCOUNTS
$get_service = $wpdb->get_results("
    SELECT DISTINCT clientaccount 
    FROM `$table_service`
    WHERE status = 0 
");
?><pre><?php print_r($get_service); ?></pre><?php
?><br><?php


// GET FLEET MANAGER FOR UNIQUE ACCOUNTS
if ($get_service) {
    $fleet_managers = array();
    $x = 0;
    for ($i = 0; $i < count($get_service); $i++) {
        $clientaccount = $get_service[$i]->clientaccount;
        $get_fleet_manager = $wpdb->get_results($wpdb->prepare("
            SELECT fleetmanager, fleetmanageradmin, accountname
            FROM `$table_accounts`
            WHERE displayid = %s
        ",
            $clientaccount
        ));
        if ($get_fleet_manager[0]->fleetmanager || $get_fleet_manager[0]->fleetmanageradmin) {
            $fleet_managers[$x]['accountname'] = $get_fleet_manager[0]->accountname;
            $fleet_managers[$x]['fleetmanageradmin'] = $get_fleet_manager[0]->fleetmanageradmin;
            if ($get_fleet_manager[0]->fleetmanager) {
                $fleet_managers[$x]['fleetmanager'] = other_convert_displayid($get_fleet_manager[0]->fleetmanager);
            } else {
                $fleet_managers[$x]['fleetmanager'] = '';
            }
            $x++;
        }
    }
    ?><pre><?php print_r($fleet_managers); ?></pre><?php

}

?><br><?php


// EMAIL ALL FLEET MANAGERS
include 'app/layouts/database/service/email/service_weekly_outstanding.php';
for ($x = 0; $x < count($fleet_managers); $x++) {
    if ($fleet_managers[$x]['fleetmanager']) {
        // Name
        $clientname = other_user_fullname($fleet_managers[$x]['fleetmanager']);
        // Email
        $clientemail = other_user_email($fleet_managers[$x]['fleetmanager']);
        // Account
        $clientaccount = $fleet_managers[$x]['accountname'];
        // CC
        $admincc = $fleet_managers[$x]['fleetmanageradmin'];
//        echo $clientname . '<br>';
//        echo $clientemail . '<br>';
//        echo $clientaccount . '<br>';
//        echo $admincc . '<br>';
    } else {
        // Name
        $clientname = 'User';
        // Email
        $emails = explode(",", $fleet_managers[$x]['fleetmanageradmin']);
        $clientemail = $emails[0];
        // Account
        $clientaccount = $fleet_managers[$x]['accountname'];
        // CC
        $firstCommaPos = strpos($fleet_managers[$x]['fleetmanageradmin'], ',');
        $newString = substr($fleet_managers[$x]['fleetmanageradmin'], $firstCommaPos + 1);
        $admincc = $newString;
//        echo $clientname . '<br>';
//        echo $clientemail . '<br>';
//        echo $clientaccount . '<br>';
//        echo $admincc . '<br>';
    }

    fleet_manager_outstanding($clientname, $clientemail, $clientaccount, $admincc);
}
