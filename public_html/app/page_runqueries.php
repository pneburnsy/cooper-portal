<?php

// LOAD WORDPRESS
require("../wp-load.php");
// SECURITY
include 'layouts/security.php';

if($_GET['passcode'] != 'sdfhv@CF5xc@ETxrc689BVC@h;HGrdcSW3£4d$@3vsxy7eh9sjT;P[shx6F5FdserSxteswtv76RVhew@7b') {
    echo 'No entry.';
    exit;
}

function create_custom_tables()
{
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    $table_name_proposals = $wpdb->prefix . 'pipeline_proposals';
    $sql_proposals = "CREATE TABLE IF NOT EXISTS `{$table_name_proposals}` (
      `id` INT AUTO_INCREMENT PRIMARY KEY,
      `displayid` VARCHAR(32) NOT NULL,
      `name` VARCHAR(255) NOT NULL,
      `desc` TEXT,
      `priority` INT DEFAULT 0,
      `percentage` INT DEFAULT 0,
      `category` VARCHAR(50),
      `user_id` INT NOT NULL,
      `clientaccount` VARCHAR(32) NOT NULL,
      `status` VARCHAR(50) DEFAULT 'Open',
      `status_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `creation_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_date` DATETIME ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) $charset_collate;";

    // 2) Proposal details table
    $table_name_details = $wpdb->prefix . 'pipeline_proposal_details';
    $sql_details = "CREATE TABLE IF NOT EXISTS `{$table_name_details}` (
      `id` INT AUTO_INCREMENT PRIMARY KEY,
      `parent_id` INT NOT NULL,
      `make` VARCHAR(100),
      `model` VARCHAR(100),
      `creation_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_date` DATETIME ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      FOREIGN KEY (`parent_id`) REFERENCES `{$table_name_proposals}`(`id`) ON DELETE CASCADE
    ) $charset_collate;";

    // 3) Sales pipelines table
    $table_name_pipelines = $wpdb->prefix . 'pipelines';
    $sql_pipelines = "CREATE TABLE IF NOT EXISTS `{$table_name_pipelines}` (
      `id` INT AUTO_INCREMENT PRIMARY KEY,
      `name` VARCHAR(255) NOT NULL,
      `creation_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_date` DATETIME ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) $charset_collate;";

    // 4) Pipeline columns table
    $table_name_columns = $wpdb->prefix . 'pipeline_columns';
    $sql_columns = "CREATE TABLE IF NOT EXISTS `{$table_name_columns}` (
      `id` INT AUTO_INCREMENT PRIMARY KEY,
      `pipeline_id` INT NOT NULL,
      `name` VARCHAR(100) NOT NULL,
      `position` INT DEFAULT 0,
      `creation_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_date` DATETIME ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      FOREIGN KEY (`pipeline_id`) REFERENCES `{$table_name_pipelines}`(`id`) ON DELETE CASCADE
    ) $charset_collate;";

    // 5) Pipeline cards table
    $table_name_cards = $wpdb->prefix . 'pipeline_cards';
    $sql_cards = "CREATE TABLE IF NOT EXISTS `{$table_name_cards}` (
      `id` INT AUTO_INCREMENT PRIMARY KEY,
      `column_id` INT NOT NULL,
      `proposal_id` INT NOT NULL,
      `creation_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_date` DATETIME ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      FOREIGN KEY (`column_id`) REFERENCES `{$table_name_columns}`(`id`) ON DELETE CASCADE,
      FOREIGN KEY (`proposal_id`) REFERENCES `{$table_name_proposals}`(`id`) ON DELETE CASCADE
    ) $charset_collate;";

    $tables = [
        $table_name_proposals => $sql_proposals,
        $table_name_details => $sql_details,
        $table_name_pipelines => $sql_pipelines,
        $table_name_columns => $sql_columns,
        $table_name_cards => $sql_cards,
    ];

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    foreach ($tables as $table_name => $create_sql) {
        $existing_table = $wpdb->get_var("SHOW TABLES LIKE '{$table_name}'");

        if ($existing_table != $table_name) {
            dbDelta($create_sql);
        }
    }

    echo 'Ran Function.';
}

echo 'Passed Auth.';

register_activation_hook(__FILE__, 'create_custom_tables');

create_custom_tables();

?>