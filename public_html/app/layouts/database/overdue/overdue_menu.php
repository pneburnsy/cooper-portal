<?php

function maintenance_overdue_count() {
    global $wpdb;
    global $maintenance_overdue_count;
    $maintenance = $wpdb->prefix . 'maintenance';
    $maintenance_overdue_count = $wpdb->get_results("SELECT COUNT(*) AS total FROM `$maintenance` WHERE main_end <= curdate() AND status = 0");
}

function rentals_overdue_count() {
    global $wpdb;
    global $rentals_overdue_count;
    $rentals =  $wpdb->prefix . 'rental_equipment';
    $rentals_overdue_count = $wpdb->get_results("SELECT COUNT(*) AS total FROM `$rentals` WHERE hire_end <= curdate() AND status = 0");
}

function exam_overdue_count() {
    global $wpdb;
    global $exam_overdue_count;
    $thorough_examinations =  $wpdb->prefix . 'thorough_examinations';
    $exam_overdue_count = $wpdb->get_results("SELECT COUNT(*) AS total FROM `$thorough_examinations` WHERE renewal_date <= curdate() AND status = 0");
}

function service_overdue_count() {
    global $wpdb;
    global $service_overdue_count;
    $service_table =  $wpdb->prefix . 'service';
    $service_overdue_count = $wpdb->get_results("SELECT COUNT(*) AS total FROM `$service_table` WHERE ( (last_odo_hours + serviceduein) <= lastest_odo_hours OR due_odo_date <= current_timestamp() ) AND status = 0");
}