<?php

//$currentrenewal = $wpdb->get_results( "SELECT * FROM `27_devlog_renewals` WHERE uid > 300" );
//print_r($currentrenewal[0]);
//
//for($i = 0; $i < count($currentrenewal); $i++) {
//    $renewaluid = $currentrenewal[$i]->uid;
//    $renewalaccount = $currentrenewal[$i]->renewalaccount;
//    $accountselect = $wpdb->get_results( "SELECT * FROM `27_devlog_accounts` WHERE accountname = '$renewalaccount'" );
//    $accountdisplayid = $accountselect[0]->displayid;
//    $wpdb->query( "UPDATE `27_devlog_renewals` SET renewalaccount = '$accountdisplayid' WHERE uid = '$renewaluid'" );
//}